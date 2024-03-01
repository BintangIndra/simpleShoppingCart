<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\master_data;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $masterDataModel = new master_data;
        $masterDataModel = $masterDataModel->getId();
        $i = 0;
        $masterData=[];
        foreach($masterDataModel as $value){
            $masterData[$i] = $value->id;
            $i++;
        }

        return [
            'idTransaksi' => 'TRS'.$this->faker->randomNumber(4, true),
            'master_data_id' => $this->faker->randomElement($masterData),
            'jumlah' => $this->faker->randomNumber(2, true),
        ];
    }
}
