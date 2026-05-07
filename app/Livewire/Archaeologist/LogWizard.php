<?php

namespace App\Livewire\Archaeologist;

use App\Models\Site;
use App\Models\Discovery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LogWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;

    // --- Paso 1: Datos del Sitio ---
    public $site_name, $province, $period, $site_public_description;

    // --- Paso 2: Datos Técnicos ---
    public $latitude, $longitude, $elevation, $threat_level = 'low', $site_technical_notes;

    // --- Paso 3: Inventario de Múltiples Piezas ---
    public $discoveries = [];

    // --- Paso 4: Multimedia ---
    public $attachments = [];

    public function mount()
    {
        $this->addDiscovery();
    }

    public function addDiscovery()
    {
        $this->discoveries[] = [
            'name' => '',
            'material_category' => '',
            'conservation_status' => 'Intacto',
            'is_extracted' => true,
            'stratigraphic_layer' => '',
            'depth_cm' => '',
            'private_notes' => '',
            'public_description' => '',
            'is_public' => true
        ];
    }

    public function removeDiscovery($index)
    {
        unset($this->discoveries[$index]);
        $this->discoveries = array_values($this->discoveries);
        if (empty($this->discoveries)) $this->addDiscovery();
    }

    protected function rules()
    {
        if ($this->currentStep == 1) {
            return [
                'site_name' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'site_public_description' => 'required|string',
            ];
        } elseif ($this->currentStep == 2) {
            return [
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'threat_level' => 'required|in:low,medium,high',
            ];
        } elseif ($this->currentStep == 3) {
            // Se agregaron validaciones específicas para cada ítem del arreglo
            return [
                'discoveries.*.name' => 'required|string|max:255',
                'discoveries.*.material_category' => 'required|string',
                'discoveries.*.conservation_status' => 'required|string',
                'discoveries.*.depth_cm' => 'nullable|numeric',
            ];
        }
        return ['attachments.*' => 'file|max:20480'];
    }

    public function nextStep()
    {
        $this->validate();
        $this->currentStep++;
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) $this->currentStep--;
    }

    public function submit()
    {
        $this->validate();
        DB::beginTransaction();

        try {
            // 1. Crear el Sitio con sanitización decimal
            $site = Site::create([
                'user_id' => auth()->id(),
                'name' => $this->site_name,
                'province' => $this->province,
                'period' => $this->period ?: null,
                'public_description' => $this->site_public_description,
                'latitude' => ($this->latitude !== '' && $this->latitude !== null) ? (float)$this->latitude : null,
                'longitude' => ($this->longitude !== '' && $this->longitude !== null) ? (float)$this->longitude : null,
                'elevation' => $this->elevation ?: null,
                'threat_level' => $this->threat_level ?: 'low',
                'technical_notes' => $this->site_technical_notes ?: null,
                'status' => 'pending',
            ]);

            // 2. Crear múltiples hallazgos mapeando las notas técnicas individuales
            foreach ($this->discoveries as $discoveryData) {
                Discovery::create([
                    'site_id' => $site->id,
                    'user_id' => auth()->id(),
                    'registration_code' => 'ARQ-' . date('Y') . '-' . strtoupper(Str::random(5)),
                    'name' => $discoveryData['name'],
                    'material_category' => $discoveryData['material_category'],
                    'conservation_status' => $discoveryData['conservation_status'],
                    'is_extracted' => $discoveryData['is_extracted'],
                    'stratigraphic_layer' => $discoveryData['stratigraphic_layer'] ?: null,
                    'depth_cm' => ($discoveryData['depth_cm'] !== '' && $discoveryData['depth_cm'] !== null) ? (float)$discoveryData['depth_cm'] : null,
                    'private_notes' => $discoveryData['private_notes'] ?: null,
                    'public_description' => $discoveryData['public_description'] ?: 'Pieza documentada.',
                    'is_public' => $discoveryData['is_public'],
                ]);
            }

            // 3. Procesar Multimedia
            if (!empty($this->attachments)) {
                foreach ($this->attachments as $file) {
                    $path = $file->store('discoveries', 'public');
                    $mimeType = $file->getMimeType();
                    $type = str_contains($mimeType, 'image') ? 'image' : (str_contains($mimeType, 'video') ? 'video' : 'document');

                    $site->media()->create([
                        'user_id' => auth()->id(),
                        'file_path' => $path,
                        'file_type' => $type,
                        'is_public' => true,
                    ]);
                }
            }

            DB::commit();
            session()->flash('message', 'Bitácora y todas las piezas registradas con éxito.');
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function render() { return view('livewire.archaeologist.log-wizard'); }
}
