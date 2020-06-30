<?php

use Illuminate\Database\Seeder;
use App\Models\Places\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marioDeMari = [
            'name' => 'Aud. Mário de Mari',
            'capacity' => '792',
            'size' => '500',
            'outletVoltage' => '1',
            'hasProjector' => '1',
            'howManyProjectors' => '3',
            'hasTranslationBooth' => '1',
            'howManyBooths' => '2',
            'hasSound' => '1',
            'hasLighting' => '1',
            'hasWifi' => '1',
            'hasAccessibility' => '1', 
            'hasFreeParking' => '1'
        ];

        $caioAmaralGruber = [
            'name' => 'Aud. Caio Amaral Gruber',
            'capacity' => '230',
            'size' => '300',
            'outletVoltage' => '1',
            'hasProjector' => '1',
            'howManyProjectors' => '1',
            'hasTranslationBooth' => '1',
            'howManyBooths' => '1',
            'hasSound' => '1',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '1', 
            'hasFreeParking' => '1'
        ];

        $atriosI = [
            'name' => 'Átrios I e II - Coquetéis',
            'capacity' => '1200',
            'size' => '1000',
            'outletVoltage' => '1',
            'hasProjector' => '',
            'howManyProjectors' => '',
            'hasTranslationBooth' => '',
            'howManyBooths' => '',
            'hasSound' => '',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '1', 
            'hasFreeParking' => '1'
        ];

        $atriosII = [
            'name' => 'Átrios I e II - Jantares',
            'capacity' => '1200',
            'size' => '1000',
            'outletVoltage' => '1',
            'hasProjector' => '',
            'howManyProjectors' => '',
            'hasTranslationBooth' => '',
            'howManyBooths' => '',
            'hasSound' => '',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '1', 
            'hasFreeParking' => '1'
        ];

        $centroDeExposicoes = [
            'name' => 'Horácio Sabino Coimbra',
            'capacity' => '5000',
            'size' => '4200',
            'outletVoltage' => '1',
            'hasProjector' => '',
            'howManyProjectors' => '',
            'hasTranslationBooth' => '',
            'howManyBooths' => '',
            'hasSound' => '',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '', 
            'hasFreeParking' => '1'
        ];

        $salaConvencoesI = [
            'name' => 'Sala de Convencoes I - Formato U',
            'capacity' => '40',
            'size' => '50',
            'outletVoltage' => '1',
            'hasProjector' => '',
            'howManyProjectors' => '',
            'hasTranslationBooth' => '',
            'howManyBooths' => '',
            'hasSound' => '',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '', 
            'hasFreeParking' => ''
        ];

        $salaConvencoesII = [
            'name' => 'Sala de Convencoes II - Formato Auditório',
            'capacity' => '140',
            'size' => '50',
            'outletVoltage' => '1',
            'hasProjector' => '',
            'howManyProjectors' => '',
            'hasTranslationBooth' => '',
            'howManyBooths' => '',
            'hasSound' => '',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '', 
            'hasFreeParking' => ''
        ];

        $espacoAraucaria = [
            'name' => 'Espaço Araucária',
            'capacity' => '60',
            'size' => '50',
            'outletVoltage' => '1',
            'hasProjector' => '1',
            'howManyProjectors' => '1',
            'hasTranslationBooth' => '',
            'howManyBooths' => '',
            'hasSound' => '1',
            'hasLighting' => '',
            'hasWifi' => '1',
            'hasAccessibility' => '1', 
            'hasFreeParking' => '1'
        ];

        DB::table('places')->insert($marioDeMari);
        DB::table('places')->insert($caioAmaralGruber);
        DB::table('places')->insert($atriosI);
        DB::table('places')->insert($atriosII);
        DB::table('places')->insert($centroDeExposicoes);
        DB::table('places')->insert($salaConvencoesI);
        DB::table('places')->insert($salaConvencoesII);
        DB::table('places')->insert($espacoAraucaria);
    }
}
