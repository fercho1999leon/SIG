<?php

use Illuminate\Database\Seeder;

class InstitucionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Jean Piaget
        DB::table('institution')->insert([
        	//INVESCIENCIAS
            //Anuncio
            'lema' => '',
            //Informacion
            'nombre' => '"Nueva Institucion"',
            'ciudad' => 'Guayaquil',
            'direccion' => '',
            'correo' => 'nuevainstitucion@gmail.com',
            'telefonos' => '(04) 999-9999',
            'jornada' => 'Matutina',
            'horariosDeAtencion' => '',
            //Mision-Vision
            'mision' => '',
            'vision' => '',
            //Historia-Antecedentes
            'antecedentes' => '',
            //Secciones
            'ei' => 'Educación inicial',
            'egb' => 'Educación Básica General',
            'bgu' => 'Bachillerato General Unificado',
            //Directiva
            'directiva' => '',
            //Sitio Web
            'sitioWeb' => '',
            //Redes Sociales
            'facebook' => '',
            'twitter' => '',
            'youtube' => '',
            'google' => '',
            'instagram' => '',
			'lema' => '',
			'periodoLectivo' => null
        ]);

    }
}
