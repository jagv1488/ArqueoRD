<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte ArqueoRD - {{ $site->name }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #C56A3D; padding-bottom: 10px; margin-bottom: 20px; }
        .title { color: #8B5A2B; font-size: 24px; margin: 0; }
        .section-title { background: #F7EFE2; color: #1F4E6E; padding: 5px 10px; font-size: 16px; font-weight: bold; margin-top: 20px; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .info-table td { padding: 8px; border: 1px solid #EEE; font-size: 12px; }
        .label { font-weight: bold; color: #666; width: 30%; }
        .discovery-card { border: 1px solid #E6DBCB; padding: 10px; margin-top: 10px; border-radius: 5px; }
        .sensitive { color: #D32F2F; font-weight: bold; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">ARQUEORD: REPORTE TÉCNICO</h1>
        <p style="font-size: 12px; margin: 5px 0;">Bitácora Digital del Patrimonio Dominicano</p>
    </div>

    <div class="section-title">DATOS DEL YACIMIENTO</div>
    <table class="info-table">
        <tr>
            <td class="label">Nombre:</td>
            <td>{{ $site->name }}</td>
            <td class="label">ID Registro:</td>
            <td>ARQ-S-{{ str_pad($site->id, 4, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td class="label">Provincia:</td>
            <td>{{ $site->province }}</td>
            <td class="label">Arqueólogo:</td>
            <td>{{ $site->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Período:</td>
            <td>{{ $site->period }}</td>
            <td class="label">Fecha Registro:</td>
            <td>{{ $site->created_at->format('d/m/Y') }}</td>
        </tr>
    </table>

    @if($hasFullAccess)
    <div class="section-title" style="background: #FFEBEE;">UBICACIÓN SENSIBLE (COORDENADAS)</div>
    <table class="info-table">
        <tr>
            <td class="label sensitive">Latitud:</td>
            <td class="sensitive">{{ $site->latitude }}</td>
            <td class="label sensitive">Longitud:</td>
            <td class="sensitive">{{ $site->longitude }}</td>
        </tr>
        <tr>
            <td class="label">Amenaza:</td>
            <td colspan="3">{{ strtoupper($site->threat_level) }}</td>
        </tr>
    </table>
    @endif

    <div class="section-title">DESCRIPCIÓN TÉCNICA</div>
    <p style="font-size: 12px; text-align: justify;">{{ $site->public_description }}</p>

    <div class="section-title">INVENTARIO DE PIEZAS</div>
    @foreach($site->discoveries as $item)
        <div class="discovery-card">
            <table class="info-table" style="border: none;">
                <tr>
                    <td style="font-weight: bold; font-size: 14px; color: #8B5A2B;">{{ $item->name }}</td>
                    <td style="text-align: right;">Código: {{ $item->registration_code }}</td>
                </tr>
            </table>
            <p style="font-size: 11px; margin: 5px 0;">
                <strong>Categoría:</strong> {{ $item->material_category }} |
                <strong>Estado:</strong> {{ $item->conservation_status }} |
                <strong>Condición:</strong> {{ $item->is_extracted ? 'Extraída' : 'In Situ' }}
            </p>
            @if($hasFullAccess && $item->private_notes)
                <p style="font-size: 10px; color: #666; border-top: 1px dashed #CCC; padding-top: 5px;">
                    <strong>Notas de Campo:</strong> {{ $item->private_notes }}
                </p>
            @endif
        </div>
    @endforeach

    <div class="footer">
        Documento generado automáticamente por ArqueoRD - Sistema de Bitácora Digital.
    </div>
</body>
</html>
