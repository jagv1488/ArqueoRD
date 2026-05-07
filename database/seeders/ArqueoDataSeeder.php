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
        // 1. CREAR USUARIOS DE PRUEBA (Admin y Arqueólogos Históricos)
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

        // 2. LISTA DE 20 YACIMIENTOS CON DATOS REALES DE RD
        $historicalData = [
            [
                'user_id' => $arq1->id, 'name' => 'Ruinas de La Isabela', 'province' => 'Puerto Plata', 'period' => 'Colonial Temprano',
                'public_description' => 'Primer asentamiento europeo en el Nuevo Mundo (1493).',
                'technical_notes' => 'Estratigrafía alterada por erosión costera.', 'threat_level' => 'medium',
                'latitude' => 19.8864, 'longitude' => -71.0805, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Mayólica de Talavera', 'cat' => 'Cerámico', 'cons' => 'Fragmentado', 'ext' => true, 'depth' => 45.5],
                    ['name' => 'Moneda Maravedí', 'cat' => 'Metálico', 'cons' => 'Oxidado', 'ext' => true, 'depth' => 20.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Cueva del Pomier', 'province' => 'San Cristóbal', 'period' => 'Precolombino (Taíno)',
                'public_description' => 'Capital prehistórica de las Antillas con miles de pictografías.',
                'technical_notes' => 'Riesgo alto por actividad minera cercana.', 'threat_level' => 'high',
                'latitude' => 18.4722, 'longitude' => -70.1389, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Mortero Lítico', 'cat' => 'Lítico', 'cons' => 'Intacto', 'ext' => false, 'depth' => 10.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Manantial de la Aleta', 'province' => 'La Altagracia', 'period' => 'Precolombino',
                'public_description' => 'Cenote ceremonial con ofrendas taínas sumergidas.',
                'technical_notes' => 'Arqueología subacuática a 30 metros de profundidad.', 'threat_level' => 'low',
                'latitude' => 18.2341, 'longitude' => -68.6542, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Vasija Ceremonial Chicoide', 'cat' => 'Cerámico', 'cons' => 'Intacto', 'ext' => true, 'depth' => 3000.0],
                    ['name' => 'Hacha Petaloide', 'cat' => 'Lítico', 'cons' => 'Intacto', 'ext' => true, 'depth' => 2500.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Concepción de La Vega', 'province' => 'La Vega', 'period' => 'Colonial',
                'public_description' => 'Ciudad destruida por terremoto en 1562. Centro de fundición de oro.',
                'technical_notes' => 'Fuerte de ladrillos parcialmente excavado.', 'threat_level' => 'medium',
                'latitude' => 19.2970, 'longitude' => -70.5406, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Campana de Bronce', 'cat' => 'Metálico', 'cons' => 'Intacto', 'ext' => true, 'depth' => 120.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Chacuey', 'province' => 'Sánchez Ramírez', 'period' => 'Precolombino',
                'public_description' => 'Plaza ceremonial con monolitos grabados.',
                'technical_notes' => 'Presencia de petroglifos de gran tamaño.', 'threat_level' => 'high',
                'latitude' => 19.1234, 'longitude' => -70.0987, 'status' => 'pending',
                'discoveries' => [
                    ['name' => 'Punta de Flecha', 'cat' => 'Lítico', 'cons' => 'Fragmentado', 'ext' => true, 'depth' => 15.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Pueblo Viejo', 'province' => 'Azua', 'period' => 'Colonial',
                'public_description' => 'Asentamiento original de la ciudad de Azua de Compostela.',
                'technical_notes' => 'Restos de la iglesia antigua visibles.', 'threat_level' => 'low',
                'latitude' => 18.4231, 'longitude' => -70.7321, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Clavo de Forja', 'cat' => 'Metálico', 'cons' => 'Deteriorado', 'ext' => true, 'depth' => 40.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Cueva de las Maravillas', 'province' => 'San Pedro de Macorís', 'period' => 'Precolombino',
                'public_description' => 'Cueva con extenso panel de pictografías en rojo y negro.',
                'technical_notes' => 'Alteración antrópica por turismo.', 'threat_level' => 'medium',
                'latitude' => 18.4522, 'longitude' => -69.2641, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Restos Óseos (Fauna)', 'cat' => 'Óseo', 'cons' => 'Fragmentado', 'ext' => false, 'depth' => 5.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'El Cabo', 'province' => 'La Altagracia', 'period' => 'Precolombino Tardío',
                'public_description' => 'Poblado costero con evidencia de contacto europeo temprano.',
                'technical_notes' => 'Postes de bohíos circulares identificados.', 'threat_level' => 'medium',
                'latitude' => 18.3512, 'longitude' => -68.4521, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Cuenta de Vidrio Azul', 'cat' => 'Vidrio', 'cons' => 'Intacto', 'ext' => true, 'depth' => 12.0],
                    ['name' => 'Burén de Arcilla', 'cat' => 'Cerámico', 'cons' => 'Fragmentado', 'ext' => true, 'depth' => 25.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Naufragio Guadalupe', 'province' => 'Samaná', 'period' => 'Colonial (1724)',
                'public_description' => 'Navío español hundido con cargamento de mercurio.',
                'technical_notes' => 'Ubicado en la Bahía de Samaná.', 'threat_level' => 'high',
                'latitude' => 19.2012, 'longitude' => -69.3321, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Frasco de Vidrio', 'cat' => 'Vidrio', 'cons' => 'Intacto', 'ext' => true, 'depth' => 1500.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Loma Quita Espuela', 'province' => 'Duarte', 'period' => 'Precolombino',
                'public_description' => 'Asentamientos agroalfareros en zonas de alta montaña.',
                'technical_notes' => 'Excavación en terreno con mucha pendiente.', 'threat_level' => 'low',
                'latitude' => 19.3456, 'longitude' => -70.1456, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Espátula Vómica', 'cat' => 'Óseo', 'cons' => 'Intacto', 'ext' => true, 'depth' => 50.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Cueva de San Gabriel', 'province' => 'Hato Mayor', 'period' => 'Precolombino',
                'public_description' => 'Importante sitio con petroglifos en el Parque Los Haitises.',
                'technical_notes' => 'Acceso limitado por manglares.', 'threat_level' => 'low',
                'latitude' => 19.0521, 'longitude' => -69.4532, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Asa Antropomorfa', 'cat' => 'Cerámico', 'cons' => 'Intacto', 'ext' => true, 'depth' => 15.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Ingenio Engombe', 'province' => 'Santo Domingo', 'period' => 'Colonial',
                'public_description' => 'Ruinas de un ingenio azucarero del siglo XVI.',
                'technical_notes' => 'Estructura de mampostería en riesgo colapso.', 'threat_level' => 'medium',
                'latitude' => 18.4510, 'longitude' => -70.0021, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Horma de Azúcar', 'cat' => 'Cerámico', 'cons' => 'Fragmentado', 'ext' => true, 'depth' => 60.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Sitio Atajadizo', 'province' => 'La Altagracia', 'period' => 'Precolombino',
                'public_description' => 'Yacimiento tipo con secuencia estratigráfica completa.',
                'technical_notes' => 'Referencia para la cerámica de la zona este.', 'threat_level' => 'low',
                'latitude' => 18.3921, 'longitude' => -68.8012, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Cuenco Naviforme', 'cat' => 'Cerámico', 'cons' => 'Restaurado', 'ext' => true, 'depth' => 85.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Ruinas de Jacagua', 'province' => 'Santiago', 'period' => 'Colonial',
                'public_description' => 'Primer emplazamiento de Santiago de los Caballeros.',
                'technical_notes' => 'Destruido por terremoto en 1562.', 'threat_level' => 'medium',
                'latitude' => 19.5012, 'longitude' => -70.7123, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Azulejo Sevillano', 'cat' => 'Cerámico', 'cons' => 'Fragmentado', 'ext' => true, 'depth' => 35.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Cueva de Berna', 'province' => 'La Altagracia', 'period' => 'Precolombino',
                'public_description' => 'Cueva con petroglifos cerca de Boca de Yuma.',
                'technical_notes' => 'Suelo rocoso con poca sedimentación.', 'threat_level' => 'low',
                'latitude' => 18.3721, 'longitude' => -68.6123, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Percutor Lítico', 'cat' => 'Lítico', 'cons' => 'Intacto', 'ext' => false, 'depth' => 5.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Manantial del Toro', 'province' => 'Santo Domingo', 'period' => 'Precolombino',
                'public_description' => 'Sitio ceremonial acuático cerca del aeropuerto.',
                'technical_notes' => 'Riesgo por expansión urbana.', 'threat_level' => 'high',
                'latitude' => 18.4412, 'longitude' => -69.6543, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Zemí de Piedra', 'cat' => 'Lítico', 'cons' => 'Intacto', 'ext' => true, 'depth' => 200.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Ingenio Nigua', 'province' => 'San Cristóbal', 'period' => 'Colonial',
                'public_description' => 'Ingenio colonial asociado a rebeliones de esclavos.',
                'technical_notes' => 'Patrimonio industrial colonial.', 'threat_level' => 'medium',
                'latitude' => 18.3712, 'longitude' => -70.0821, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Cadena de Hierro', 'cat' => 'Metálico', 'cons' => 'Oxidado', 'ext' => true, 'depth' => 55.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Cerro de las Navajas', 'province' => 'La Romana', 'period' => 'Precolombino',
                'public_description' => 'Taller lítico de gran escala para producción de herramientas.',
                'technical_notes' => 'Gran densidad de lascas de sílex en superficie.', 'threat_level' => 'low',
                'latitude' => 18.4231, 'longitude' => -68.9123, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Núcleo de Sílex', 'cat' => 'Lítico', 'cons' => 'Intacto', 'ext' => true, 'depth' => 0.0]
                ]
            ],
            [
                'user_id' => $arq2->id, 'name' => 'Batey de Sabana Larga', 'province' => 'Elías Piña', 'period' => 'Precolombino',
                'public_description' => 'Plaza ceremonial en la zona fronteriza.',
                'technical_notes' => 'Poco documentado, requiere prospección.', 'threat_level' => 'medium',
                'latitude' => 18.8821, 'longitude' => -71.7231, 'status' => 'pending',
                'discoveries' => [
                    ['name' => 'Fragmento de Olla', 'cat' => 'Cerámico', 'cons' => 'Fragmentado', 'ext' => true, 'depth' => 30.0]
                ]
            ],
            [
                'user_id' => $arq1->id, 'name' => 'Ruinas de La Vega Vieja', 'province' => 'La Vega', 'period' => 'Colonial',
                'public_description' => 'Ciudad original fundada por Colón.',
                'technical_notes' => 'Área protegida por el Ministerio de Cultura.', 'threat_level' => 'low',
                'latitude' => 19.3121, 'longitude' => -70.5211, 'status' => 'approved',
                'discoveries' => [
                    ['name' => 'Daga Española', 'cat' => 'Metálico', 'cons' => 'Oxidado', 'ext' => true, 'depth' => 110.0]
                ]
            ]
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

            foreach ($data['discoveries'] as $item) {
                Discovery::create([
                    'site_id' => $site->id,
                    'user_id' => $data['user_id'],
                    'registration_code' => 'ARQ-' . date('Y') . '-' . strtoupper(Str::random(5)),
                    'name' => $item['name'],
                    'material_category' => $item['cat'],
                    'conservation_status' => $item['cons'],
                    'is_extracted' => $item['ext'],
                    'depth_cm' => $item['depth'],
                    'private_notes' => 'Hallazgo documentado en excavación estratigráfica.',
                    'is_public' => true,
                ]);
            }
        }
    }
}
