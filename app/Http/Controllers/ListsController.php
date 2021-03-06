<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListsController extends Controller
{

    public function main($list)
    {
        $data = [];
        switch ($list){
            case 'vehicleTypes':
                $data =  $this->vehicleTypes();
                break;
            case 'brands':
                $data =  $this->brands();
                break;
            case 'models':
                $data =  $this->models();
                break;
            case 'banks':
                $data =  $this->banks();
                break;
            case 'planTypes':
                $data =  $this->planTypes();
                break;
            case 'currencies':
                $data =  $this->currencies();
                break;
            case 'policyStatus':
                $data =  $this->policyStatus();
                break;
            case 'civilRisk':
                $data =  $this->civilRisk();
                break;
            case 'commercialActivity':
                $data =  $this->commercialActivity();
                break;
            default:
                $data = null;
        }

        if(!$data){
            return response()->json(['success' => false, 'message' =>'No existe una lista con este nombre']);
        }
        return response()->json(['success' =>true,'data' =>$data]);


    }
    public function commercialActivity()
    {
        return ['Finanzas','Ingenieria','Servicios','Salud','Comercio'];
    }

    public function civilRisk()
    {
        return ['Contractual','Extracontractual'];
    }
    public function policyStatus()
    {
        return ['Vencida','Vigente','No renovada','Expedición','Devengada','Cancelada'];
    }

    public function currencies()
    {
        return ['DOP', 'USD'];
    }

    public function vehicleTypes()
    {
        return ['JEEP', 'AUTOBUS', 'MINIBUS', 'AUTOMOVIL',];
    }

    public function brands()
    {
        $data = ['Mazda', 'Toyota', 'Honda', 'Mercedes Benz',];
        return $data;
    }

    public function models()
    {
       return  ['Demio', 'Hilux', 'Corolla', 'Civic',];
    }

    public function banks()
    {
        return ['Banco Popular', 'Banreservas', 'BHD Leon', 'Scotiabank',];
    }

    public function planTypes()
    {
        return ['COMPRENSIVO AL 100%','TODO RIESGO','CERO DEDUCIBLE','DAÑOS A TERCEROS','TU PLAN IDEAL'];
    }
}
