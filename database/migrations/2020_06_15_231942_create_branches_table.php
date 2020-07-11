<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->enum('main_branch',
                [
                    'Hogar',
                    'Incendio y Líneas aliadas',
                    'Ingeniería',
                    'Inversión',
                    'Jurídica',
                    'Lucro Cesante',
                    'Manejo',
                    'Maquinaria y Equipo',
                    'Accidentes Personales',
                    'Agropecuario',
                    'Ahorro',
                    'ARL',
                    'Asistencia Médica',
                    'Autos/Vehiculos',
                    'Aviación',
                    'Bancos e Instituciones Financieras (BBB)',
                    'Buen Uso de Anticipo',
                    'Casco',
                    'Colectivo',
                    'Copropiedades',
                    'Crédito y caución',
                    'Cumplimiento',
                    'Cumplimiento de Contrato',
                    ''
                ]);
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
        Schema::dropIfExists('branches');
    }
}
