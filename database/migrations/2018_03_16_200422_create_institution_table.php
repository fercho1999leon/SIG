<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('institution', function (Blueprint $table) {
        $table->increments('id');

        /* Anuncio */
        $table->text('lema');

        /* Informacion */
        $table->string('nombre', 255);
        $table->string('ciudad', 100)->nullable();
        $table->string('direccion', 100)->nullable();
        $table->string('correo', 100)->nullable();
        $table->string('telefonos', 100)->nullable();
        $table->string('jornada', 100)->nullable();
        $table->text('horariosDeAtencion')->nullable();

        /* Mision-Vision */
        $table->text('mision')->nullable();
        $table->text('vision')->nullable();

        /* Historia-Antecedentes */
        $table->text('antecedentes')->nullable();
        $table->text('historia')->nullable();

        /* Secciones */
        $table->text('ei')->nullable();
        $table->text('egb')->nullable();
        $table->text('bgu')->nullable();

        /* Directiva */
        $table->text('directiva')->nullable();

        /* Sitio Oficial */
        $table->text('sitioWeb')->nullable();

        /* Redes Sociales */
        $table->string('facebook', 100)->nullable();
        $table->string('twitter', 100)->nullable();
        $table->string('youtube', 100)->nullable();
        $table->string('google', 100)->nullable();
        $table->string('instagram', 100)->nullable();

        /* Reportes */
        $table->string('representante1', 255)->nullable();
        $table->string('cargo1', 255)->nullable();
        $table->string('representante2', 255)->nullable();
        $table->string('cargo2', 255)->nullable();

        /* Libreta de calificaciones */
        //Area del representante
        $table->string('areaDelRepresentante', 255)->nullable();
        //Area de Firma
        $table->string('areaDeFirma', 255)->nullable();

        /* Hoja de actualizacion de datos */
        //Nombre
        $table->string('etiqueta', 255)->nullable();

        /* Certificados */
        //Cabecera1
        $table->string('cabecera1', 255)->nullable();
        //Cabecera2
        $table->string('cabecera2', 255)->nullable();
        //Fecha certificado Matricula
        $table->string('fechaCertificadoMatricula')->nullable();
        //Fecha certificado Promocion
        $table->string('fechaCertificadoPromocion')->nullable();


        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution');
    }
}
