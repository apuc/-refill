<?php

use Illuminate\Database\Seeder;
use App\CellProvider;

class CellProviderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providers = ['MTC', 'Beeline', 'Megafon'];
        foreach ($providers as $provider){
            CellProvider::firstOrCreate([
                'name' => $provider
            ]);
        }
    }
}
