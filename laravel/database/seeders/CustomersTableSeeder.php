<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = json_decode(file_get_contents(database_path('seeders/example-data/customers.json')), true);

        foreach ($customers as $customer) {
            Customer::create([
                'id' => $customer['id'],
                'name' => $customer['name'],
                'since' => $customer['since'],
                'revenue' => $customer['revenue']
            ]);
        }
    }
}
