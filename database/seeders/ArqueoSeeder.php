<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Site;
use App\Models\Discovery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArqueoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREAR USUARIOS (Arqueólogos Históricos/Simulados y un Admin)
        $admin = User::firstOrCreate(
            ['email' => 'admin@arqueord.gob.do'],
            [
                'name' => 'Dirección Nacional de Patrimonio',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_verified' => true,
            ]
        );

        $arq1 = User::firstOrCreate(
            ['email' => 'fluna@uasd.edu.do'],
            [
                'name' => 'Dr. Fernando Luna Calderón',
                'password' => Hash::make('password123'),
                'role' => 'archaeologist',
                'is_verified' => true,
                'license_number' => 'ARQ-001',
                'institution' => 'Museo del Hombre Dominicano'
            ]
        );

        $arq2 = User::firstOrCreate(
            ['email' => 'kboyrie@cultura.gob.do'],
            [
                'name' => 'Emile De Boyrie Moya',
                'password' => Hash::make('password123'),
                'role' => 'archaeologist',
                'is_verified' => true,
                'license_number' => 'ARQ-002',
                'institution' => 'Instituto Antropológico'
            ]
        );

        // 2. LISTA DE YACIMIENTOS Y HALLAZGOS REALES (DR)
        $historicalData = [
            [
                'user_id' => $arq1->id,
                'name' => 'Ruinas de La Isabela',
                'province' => 'Puerto Plata',
                'period' => 'Colonial (1493-1500)',
                'public_description' => 'Primer asentamiento europeo en el Nuevo Mundo, fundado por Cristóbal Colón en su segundo viaje.',
                'technical_notes' => 'Estratigrafía alterada por erosión costera. Cimientos de piedra de la casa de Colón visibles.',
                'threat_level' => 'medium',
                'latitude' => '19.8864', 'longitude' => '-71.0805',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Mayólica de Talavera', 'category' => 'Cerámico', 'status' => 'Fragmentado', 'extracted' => true, 'desc' => 'Fragmentos de platos esmaltados traídos desde España.'],
                    ['name' => 'Moneda Maravedí', 'category' => 'Metálico', 'status' => 'Oxidado', 'extracted' => true, 'desc' => 'Moneda de cobre de la época de los Reyes Católicos.'],
                ]
            ],
            [
                'user_id' => $arq2->id,
                'name' => 'Cueva del Pomier',
                'province' => 'San Cristóbal',
                'period' => 'Precolombino (Taíno/Igneri)',
                'public_description' => 'Capital prehistórica de las Antillas. Sistema de cuevas con más de 6,000 pictografías y petroglifos indígenas.',
                'technical_notes' => 'Riesgo alto por actividad minera cercana. Componente de humedad daña los pigmentos de carbón.',
                'threat_level' => 'high',
                'latitude' => '18.4722', 'longitude' => '-70.1389',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Mortero Lítico', 'category' => 'Lítico', 'status' => 'Íntegro', 'extracted' => false, 'desc' => 'Mortero de piedra utilizado para moler raíces y semillas (cooba).'],
                ]
            ],
            [
                'user_id' => $arq1->id,
                'name' => 'Manantial de la Aleta',
                'province' => 'La Altagracia',
                'period' => 'Precolombino (Cacicazgo Higüey)',
                'public_description' => 'Cenote ceremonial en el Parque Nacional Cotubanamá donde los taínos arrojaban ofrendas a sus deidades.',
                'technical_notes' => 'Arqueología subacuática. Profundidad de 30 metros. Condiciones anóxicas preservan madera.',
                'threat_level' => 'low',
                'latitude' => '18.2341', 'longitude' => '-68.6542',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Vasija Ceremonial Chicoide', 'category' => 'Cerámico', 'status' => 'Íntegro', 'extracted' => true, 'desc' => 'Vasija decorada con rostros antropomorfos (murciélagos).'],
                    ['name' => 'Hacha Petaloide', 'category' => 'Lítico', 'status' => 'Íntegro', 'extracted' => true, 'desc' => 'Hacha de piedra verde pulida, ofrenda intacta en el fondo del cenote.'],
                ]
            ],
            [
                'user_id' => $arq2->id,
                'name' => 'Concepción de La Vega',
                'province' => 'La Vega',
                'period' => 'Colonial (1495-1562)',
                'public_description' => 'Ciudad colonial destruida por un terremoto en 1562. Fue el centro de fundición de oro más importante de las Américas.',
                'technical_notes' => 'Las ruinas del fuerte están expuestas. Área del monasterio franciscano parcialmente excavada.',
                'threat_level' => 'medium',
                'latitude' => '19.2970', 'longitude' => '-70.5406',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Campana Franciscana', 'category' => 'Metálico', 'status' => 'Íntegro', 'extracted' => true, 'desc' => 'Campana de bronce perteneciente al primer monasterio franciscano.'],
                ]
            ],
            [
                'user_id' => $arq1->id,
                'name' => 'Plaza Ceremonial de Chacuey',
                'province' => 'Sánchez Ramírez',
                'period' => 'Precolombino',
                'public_description' => 'Batey o plaza ceremonial indígena rodeada de monolitos de piedra con petroglifos grabados.',
                'technical_notes' => 'Invasión agrícola en los bordes de la plaza. Los petroglifos muestran desgaste por intemperismo.',
                'threat_level' => 'high',
                'latitude' => '19.1234', 'longitude' => '-70.0987',
                'status' => 'pending', // Pendiente de revisión
                'discoveries' => [
                    ['name' => 'Monolito Antropomorfo', 'category' => 'Lítico', 'status' => 'Fragmentado', 'extracted' => false, 'desc' => 'Piedra de contención del batey con grabado de rostro humano.'],
                ]
            ],
            [
                'user_id' => $arq1->id,
                'name' => 'Asentamiento El Cabo',
                'province' => 'La Altagracia',
                'period' => 'Precolombino Tardío',
                'public_description' => 'Gran poblado indígena costero que muestra evidencia de contacto temprano con los europeos.',
                'technical_notes' => 'Zanjas de postes de grandes bohíos circulares claramente definidas en el subsuelo calcáreo.',
                'threat_level' => 'medium',
                'latitude' => '18.3512', 'longitude' => '-68.4521',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Zemí de Algodón (Réplica)', 'category' => 'Orgánico', 'status' => 'Deteriorado', 'extracted' => true, 'desc' => 'Restos orgánicos asociados a un ídolo de reverencia.'],
                    ['name' => 'Cuentas de Collar Europeas', 'category' => 'Vidrio', 'status' => 'Íntegro', 'extracted' => true, 'desc' => 'Cuentas de vidrio azul traídas por españoles e intercambiadas con los indígenas.'],
                ]
            ],
            [
                'user_id' => $arq2->id,
                'name' => 'Naufragio de Monte Cristi',
                'province' => 'Monte Cristi',
                'period' => 'Colonial (Siglo XVII)',
                'public_description' => 'Restos de un galeón español hundido en la costa norte, con importante cargamento de pipas.',
                'technical_notes' => 'A 15 metros de profundidad. Saqueo subacuático reportado en los años 80.',
                'threat_level' => 'high',
                'latitude' => '19.8654', 'longitude' => '-71.6543',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Pipas de Arcilla', 'category' => 'Cerámico', 'status' => 'Íntegro', 'extracted' => true, 'desc' => 'Cargamento holandés de pipas de fumar intactas.'],
                ]
            ],
            [
                'user_id' => $arq1->id,
                'name' => 'Loma Quita Espuela',
                'province' => 'Duarte',
                'period' => 'Precolombino',
                'public_description' => 'Evidencia de asentamientos de grupos agroalfareros en la ribera de los ríos que nacen en la reserva.',
                'technical_notes' => 'Excavación de rescate. Presencia de concheros terrestres mezclados con cerámica.',
                'threat_level' => 'low',
                'latitude' => '19.3456', 'longitude' => '-70.1456',
                'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Burén de Arcilla', 'category' => 'Cerámico', 'status' => 'Fragmentado', 'extracted' => true, 'desc' => 'Plancha gruesa de arcilla utilizada para cocinar el casabe.'],
                ]
            ],
        ];

        // 3. INSERTAR DATOS EN LA BASE DE DATOS
        foreach ($historicalData as $data) {
            $site = Site::create([
                'user_id' => $data['user_id'],
                'name' => $data['name'],
                'province' => $data['province'],
                'period' => $data['period'],
                'public_description' => $data['public_description'],
                'technical_notes' => $data['technical_notes'],
                'threat_level' => $data['threat_level'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'status' => $data['status'],
            ]);

            foreach ($data['discoveries'] as $idx => $item) {
                $discovery = $site->discoveries()->create([
                    'user_id' => $data['user_id'],
                    'name' => $item['name'],
                    'registration_code' => 'ARQ-' . date('Y') . '-' . strtoupper(Str::random(5)),
                    'material_category' => $item['category'],
                    'conservation_status' => $item['status'],
                    'is_extracted' => $item['extracted'],
                    'public_description' => $item['desc'],
                    'private_notes' => 'Hallazgo documentado en la cuadrícula A' . ($idx + 1) . ' a 30cm de profundidad.',
                    'is_public' => true,
                ]);

                // Crear un registro de imagen "dummy" para que la galería no esté vacía
                // En producción, aquí iría la ruta real a la foto subida.
                $discovery->media()->create([
                    'user_id' => $data['user_id'],
                    'file_path' => 'dummies/artefacto.jpg', // Requiere que pongas una foto en storage/app/public/dummies/artefacto.jpg
                    'file_type' => 'image',
                    'is_public' => true,
                ]);
            }
        }
    }
}
