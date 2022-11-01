<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('users')->insert([
          'name'=>"Dentista Daniela",
          'email'=>"consultorio@gmail.com",
          'password'=>bcrypt("12345678"),
        ]);


        DB::table('generos')->insert([
            ['sexo'=>"Masculino"],
            ['sexo'=>"Femenino"]
        ]);

        DB::table('tipos')->insert([
            ['tipo'=>"Permanentes"],
            ['tipo'=>"Temporales"],
            ['tipo'=>"Mixta"]
        ]);

        DB::table('ubicacions')->insert([
            ['ubicacion'=>"Superior"],
            ['ubicacion'=>"Inferior"]
        ]);

        DB::table('perma_supers')->insert([
            ['pz_dental'=>"11-incisivo central superior"],
            ['pz_dental'=>"21-incisivo central superior"],
            ['pz_dental'=>"12-incisivo lateral superior"],
            ['pz_dental'=>"22-incisivo lateral superior"],
            ['pz_dental'=>"13-Canino Superior"],
            ['pz_dental'=>"23-Canino Superior"],
            ['pz_dental'=>"14-Primer premolar Superior"],
            ['pz_dental'=>"24-Primer premolar Superior"],
            ['pz_dental'=>"15-Segundo premolar Superior"],
            ['pz_dental'=>"25-Segundo premolar Superior"],
            ['pz_dental'=>"16-Primer molar Superior"],
            ['pz_dental'=>"26-Primer molar Superior"],
            ['pz_dental'=>"17-Segundo molar Superior"],
            ['pz_dental'=>"27-Segundo molar Superior"],
            ['pz_dental'=>"18-Tercer molar Superior"],
            ['pz_dental'=>"28-Tercer molar Superior"],
            ['pz_dental'=>"General"],
        ]);

        DB::table('perma_infers')->insert([
            ['pz_dental'=>"31-incisivo central Inferior"],
            ['pz_dental'=>"41- incisivo central Inferior"],
            ['pz_dental'=>"32 incisivo lateral Inferior"],
            ['pz_dental'=>"42- incisivo lateral Inferior"],
            ['pz_dental'=>"33-Canino Superior Inferior"],
            ['pz_dental'=>"43-Canino Inferior"],
            ['pz_dental'=>"34-Primer premolar Inferior"],
            ['pz_dental'=>"44-Primer premolar Inferior"],
            ['pz_dental'=>"35-Segundo premolar Inferior"],
            ['pz_dental'=>"45- Segundo premolar Inferior"],
            ['pz_dental'=>"36-Primer molar Inferior"],
            ['pz_dental'=>"46-Primer molar Inferior"],
            ['pz_dental'=>"37-Segundo molar Inferior"],
            ['pz_dental'=>"47-Segundo molar Inferior"],
            ['pz_dental'=>"38-Tercer molar Inferior"],
            ['pz_dental'=>"48-Tercer molar Inferior"],
            ['pz_dental'=>"General"],
        ]);

        DB::table('tempo_supers')->insert([
            ['pz_dental'=>"51-incisivo central superior"],
            ['pz_dental'=>"61- incisivo central superior"],
            ['pz_dental'=>"52 incisivo lateral superior"],
            ['pz_dental'=>"62- incisivo lateral superior"],
            ['pz_dental'=>"53-Canino Superior"],
            ['pz_dental'=>"63-Canino Superior"],
            ['pz_dental'=>"54-Primer molar Superior"],
            ['pz_dental'=>"64-Primer molar Superior"],
            ['pz_dental'=>"55-Segundo molar Superior"],
            ['pz_dental'=>"65-Segundo molar Superior"],
            ['pz_dental'=>"General"],
        ]);

        DB::table('tempo_infers')->insert([
            ['pz_dental'=>"71-incisivo central Inferior"],
            ['pz_dental'=>"81- incisivo central Inferior"],
            ['pz_dental'=>"72 incisivo lateral Inferior"],
            ['pz_dental'=>"82- incisivo lateral Inferior"],
            ['pz_dental'=>"73-Canino Inferior"],
            ['pz_dental'=>"83-Canino Inferior"],
            ['pz_dental'=>"74-Primer molar Inferior"],
            ['pz_dental'=>"84-Primer molar Inferior"],
            ['pz_dental'=>"75-Segundo molar Inferior"],
            ['pz_dental'=>"85-Segundo molar Inferior"],
            ['pz_dental'=>"General"],
        ]);

    }
}
