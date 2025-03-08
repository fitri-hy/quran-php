<?php
namespace App\Models;

use Core\Model;

class ExampleData extends Model {
    public function getData() {
        return [
            ['id' => 1, 'name' => 'Jakarta', 'province' => 'DKI Jakarta', 'population' => 10800000],
            ['id' => 2, 'name' => 'Surabaya', 'province' => 'Jawa Timur', 'population' => 3100000],
            ['id' => 3, 'name' => 'Bandung', 'province' => 'Jawa Barat', 'population' => 2600000],
            ['id' => 4, 'name' => 'Medan', 'province' => 'Sumatera Utara', 'population' => 2400000],
            ['id' => 5, 'name' => 'Semarang', 'province' => 'Jawa Tengah', 'population' => 1700000],
            ['id' => 6, 'name' => 'Makassar', 'province' => 'Sulawesi Selatan', 'population' => 1500000],
        ];
    }
}
