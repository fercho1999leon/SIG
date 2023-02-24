<?php

use Illuminate\Database\Seeder;

class ParcialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracionesparcial')->insert([
            'p1q1FI' => null,
            'p1q1FF' => null,
            'p2q1FI' => null,
            'p2q1FF' => null,
            'p3q1FI' => null,
            'p3q1FF' => null,

            'p1q2FI' => null,
            'p1q2FF' => null,
            'p2q2FI' => null,
            'p2q2FF' => null,
            'p3q2FI' => null,
            'p3q2FF' => null,
        ]);
    }
}
