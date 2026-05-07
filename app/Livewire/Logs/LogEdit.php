<?php

namespace App\Livewire\Logs;

use App\Models\Site;
use App\Models\Discovery;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class LogEdit extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public Site $site;
    public $name, $province, $period, $public_description;
    public $latitude, $longitude, $elevation, $threat_level, $technical_notes;
    public $discoveries = [];
    public $new_attachments = [];

    public function mount(Site $site)
    {
        $this->authorize('update', $site);
        $this->site = $site->load('discoveries');

        $this->fill($site->only(['name', 'province', 'period', 'public_description', 'latitude', 'longitude', 'elevation', 'threat_level', 'technical_notes']));

        foreach ($this->site->discoveries as $discovery) {
            $this->discoveries[] = [
                'id' => $discovery->id,
                'name' => $discovery->name,
                'material_category' => $discovery->material_category,
                'conservation_status' => $discovery->conservation_status,
                'depth_cm' => $discovery->depth_cm,
                'private_notes' => $discovery->private_notes,
            ];
        }
    }

    public function addDiscovery()
    {
        $this->discoveries[] = [
            'id' => null,
            'name' => '',
            'material_category' => '',
            'conservation_status' => '',
            'depth_cm' => '',
            'private_notes' => '',
        ];
    }

    public function removeDiscovery($index)
    {
        if (isset($this->discoveries[$index]['id'])) {
            Discovery::find($this->discoveries[$index]['id'])->delete();
        }
        unset($this->discoveries[$index]);
        $this->discoveries = array_values($this->discoveries);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'threat_level' => 'required|in:low,medium,high',
            'discoveries.*.name' => 'required|string|max:255',
            'discoveries.*.depth_cm' => 'nullable|numeric',
        ]);

        try {
            $this->site->update([
                'name' => $this->name,
                'province' => $this->province,
                'period' => $this->period ?: null,
                'public_description' => $this->public_description,
                'latitude' => $this->latitude !== '' ? (float) $this->latitude : null,
                'longitude' => $this->longitude !== '' ? (float) $this->longitude : null,
                'elevation' => $this->elevation ?: null,
                'threat_level' => $this->threat_level,
                'technical_notes' => $this->technical_notes ?: null,
            ]);

            foreach ($this->discoveries as $data) {
                $this->site->discoveries()->updateOrCreate(
                    ['id' => $data['id']],
                    [
                        'user_id' => auth()->id(),
                        'name' => $data['name'],
                        'material_category' => $data['material_category'] ?: 'Otro',
                        'conservation_status' => $data['conservation_status'] ?: 'ND',
                        'depth_cm' => $data['depth_cm'] !== '' && $data['depth_cm'] !== null ? (float) $data['depth_cm'] : null,
                        'private_notes' => $data['private_notes'] ?: null,
                        'registration_code' => $data['id'] ? Discovery::find($data['id'])->registration_code : 'ARQ-' . strtoupper(Str::random(5)),
                    ],
                );
            }

            foreach ($this->new_attachments as $file) {
                $path = $file->store('discoveries', 'public');
                $type = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';
                $this->site->media()->create([
                    'user_id' => auth()->id(),
                    'file_path' => $path,
                    'file_type' => $type,
                    'is_public' => true,
                ]);
            }

            session()->flash('message', 'Bitácora actualizada.');
            return redirect()->route('logs.show', $this->site);
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteMedia($mediaId)
    {
        $media = $this->site->media()->findOrFail($mediaId);
        Storage::disk('public')->delete($media->file_path);
        $media->delete();
    }

    public function render()
    {
        return view('livewire.logs.log-edit');
    }
}
