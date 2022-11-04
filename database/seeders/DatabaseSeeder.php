<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Scholarity::factory()->create([
            [
                'title' => 'Ensino fundamental incompleto',
                'value' => 'fundamental_incompleto'
            ],
            [
                'title' => 'Ensino fundamental completo',
                'value' => 'fundamental_completo'
            ],
            [
                'title' => 'Ensino médio incompleto',
                'value' => 'medio_incompleto'
            ],
            [
                'title' => 'Ensino médio completo',
                'value' => 'medio_completo'
            ],
            [
                'title' => 'Ensino superior incompleto',
                'value' => 'superio_completo'
            ],
            [
                'title' => 'Ensino superior completo',
                'value' => 'superior_completo'
            ],
        ]);
    }
}
