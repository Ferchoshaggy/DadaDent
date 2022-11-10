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
          'email'=>"dadadent.21@gmail.com",
          'password'=>bcrypt("01042022"),
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
            ['ubicacion'=>"Inferior"],
            ['ubicacion'=>"General"]
        ]);

        DB::table('perma_supers')->insert([
            ['pz_dental'=>"11-incisivo central superior","numero_asignado"=>1],
            ['pz_dental'=>"21-incisivo central superior","numero_asignado"=>2],
            ['pz_dental'=>"12-incisivo lateral superior","numero_asignado"=>3],
            ['pz_dental'=>"22-incisivo lateral superior","numero_asignado"=>4],
            ['pz_dental'=>"13-Canino Superior","numero_asignado"=>5],
            ['pz_dental'=>"23-Canino Superior","numero_asignado"=>6],
            ['pz_dental'=>"14-Primer premolar Superior","numero_asignado"=>7],
            ['pz_dental'=>"24-Primer premolar Superior","numero_asignado"=>8],
            ['pz_dental'=>"15-Segundo premolar Superior","numero_asignado"=>9],
            ['pz_dental'=>"25-Segundo premolar Superior","numero_asignado"=>10],
            ['pz_dental'=>"16-Primer molar Superior","numero_asignado"=>11],
            ['pz_dental'=>"26-Primer molar Superior","numero_asignado"=>12],
            ['pz_dental'=>"17-Segundo molar Superior","numero_asignado"=>13],
            ['pz_dental'=>"27-Segundo molar Superior","numero_asignado"=>14],
            ['pz_dental'=>"18-Tercer molar Superior","numero_asignado"=>15],
            ['pz_dental'=>"28-Tercer molar Superior","numero_asignado"=>16],
        ]);

        DB::table('perma_infers')->insert([
            ['pz_dental'=>"31-incisivo central Inferior","numero_asignado"=>17],
            ['pz_dental'=>"41-incisivo central Inferior","numero_asignado"=>18],
            ['pz_dental'=>"32 incisivo lateral Inferior","numero_asignado"=>19],
            ['pz_dental'=>"42-incisivo lateral Inferior","numero_asignado"=>20],
            ['pz_dental'=>"33-Canino Superior Inferior","numero_asignado"=>21],
            ['pz_dental'=>"43-Canino Inferior","numero_asignado"=>22],
            ['pz_dental'=>"34-Primer premolar Inferior","numero_asignado"=>23],
            ['pz_dental'=>"44-Primer premolar Inferior","numero_asignado"=>24],
            ['pz_dental'=>"35-Segundo premolar Inferior","numero_asignado"=>25],
            ['pz_dental'=>"45- Segundo premolar Inferior","numero_asignado"=>26],
            ['pz_dental'=>"36-Primer molar Inferior","numero_asignado"=>27],
            ['pz_dental'=>"46-Primer molar Inferior","numero_asignado"=>28],
            ['pz_dental'=>"37-Segundo molar Inferior","numero_asignado"=>29],
            ['pz_dental'=>"47-Segundo molar Inferior","numero_asignado"=>30],
            ['pz_dental'=>"38-Tercer molar Inferior","numero_asignado"=>31],
            ['pz_dental'=>"48-Tercer molar Inferior","numero_asignado"=>32],
        ]);

        DB::table('tempo_supers')->insert([
            ['pz_dental'=>"51-incisivo central superior","numero_asignado"=>33],
            ['pz_dental'=>"61-incisivo central superior","numero_asignado"=>34],
            ['pz_dental'=>"52 incisivo lateral superior","numero_asignado"=>35],
            ['pz_dental'=>"62-incisivo lateral superior","numero_asignado"=>36],
            ['pz_dental'=>"53-Canino Superior","numero_asignado"=>37],
            ['pz_dental'=>"63-Canino Superior","numero_asignado"=>38],
            ['pz_dental'=>"54-Primer molar Superior","numero_asignado"=>39],
            ['pz_dental'=>"64-Primer molar Superior","numero_asignado"=>40],
            ['pz_dental'=>"55-Segundo molar Superior","numero_asignado"=>41],
            ['pz_dental'=>"65-Segundo molar Superior","numero_asignado"=>42],
        ]);

        DB::table('tempo_infers')->insert([
            ['pz_dental'=>"71-incisivo central Inferior","numero_asignado"=>43],
            ['pz_dental'=>"81-incisivo central Inferior","numero_asignado"=>44],
            ['pz_dental'=>"72 incisivo lateral Inferior","numero_asignado"=>45],
            ['pz_dental'=>"82-incisivo lateral Inferior","numero_asignado"=>46],
            ['pz_dental'=>"73-Canino Inferior","numero_asignado"=>47],
            ['pz_dental'=>"83-Canino Inferior","numero_asignado"=>48],
            ['pz_dental'=>"74-Primer molar Inferior","numero_asignado"=>49],
            ['pz_dental'=>"84-Primer molar Inferior","numero_asignado"=>50],
            ['pz_dental'=>"75-Segundo molar Inferior","numero_asignado"=>51],
            ['pz_dental'=>"85-Segundo molar Inferior","numero_asignado"=>52],
        ]);

    }
}
