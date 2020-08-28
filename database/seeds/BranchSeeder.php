<?php

use App\Branch;
use App\MainBranch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$branches = ["Accidentes Personales","Agropecuario","Ahorro","ARL","Arrendamiento","Asistencia Médica","Autos/Vehículos","Aviación","Bancos e Instituciones Financieras (BBB)","Buen Uso de Anticipo","Casco","Colectivo","Copropiedades","Crédito y caución","Cumplimiento","Cumplimiento de Contrato","Daños materiales","Dinero y Valores","Educativo","Ejecución de Obra y Buena Calidad de Materiales","Equipo Eléctrico","Equipo y Maquinaria de Contratista","Estudiantil","Exequias","Fianzas/Robo/Sustracción","Fidelidad","Financiacion de Primas","Garantías Aduaneras","Hogar","Incendio y Líneas Aliadas","Ingeniería","Inversión","juridica","Lucro Cesante","Manejo","Maquinaria y Equipo/Rotura Maquinaria","Marítimo","Mascotas","Medicina Prepagada","Microseguro","Montaje de Maquinaria","Multirriesgos","Obras Civiles Terminadas","Otros","Pérdida de Beneficio por Rotura de Maquinaria","Plan Complementario","POS","Pyme","Ramo prueba","Renta Pensional","Responsabilidad Civil","Responsabilidad civil directores y administradores","Responsabilidad civil para parqueaderos","Responsabilidad civil para profesionales médicos","Riesgos diversos","Riesgos Especiales","Riesgos financieros","Riesgos financieros --","Robo/o Asalto","Rotura de Maquinaria","Salud","Seguro de Credito","Seguros de Accidentes","Seriedad de Oferta","Soat","Terremoto","Titulo capitalización","Todo Riesgo","Todo riesgo Construcción","Todo riesgo contratista","Transporte","Venta de vehículo","Viajes/Turismo","Vida","Vida Deudores","Vida grupo","Vida individual"];

        $branches = ['Vida','Cumplimiento','Hogar','SOAT','Vehiculos de motor'];
        foreach ($branches as $key => $branch)
        {
            $main =  MainBranch::create(['name' =>$branch]);
            $sub = Branch::create(['name' =>$branch,'main_branch_id' => $key +1]);
        }
    }
}
