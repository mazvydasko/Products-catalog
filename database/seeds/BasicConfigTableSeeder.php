<?php

use App\BasicConfig;
use Illuminate\Database\Seeder;

class BasicConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = new BasicConfig();
        $params->tax_rate = 21;
        $params->tax_flag = 0;
        $params->global_discount = 0;
        $params->global_discount_type = 'percentage';
        $params->save();

    }
}
