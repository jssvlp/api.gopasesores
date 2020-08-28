<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function vehicleTypes()
    {
        $data = ['JEEP', 'AUTOBUS', 'MINIBUS', 'AUTOMOVIL',];
        return response()->json(['success' =>true, 'data' =>$data]);
    }

    public function brands()
    {
        $data = ['Mazda', 'Toyota', 'Honda', 'Mercedes Benz',];
        return response()->json(['success' =>true, 'data' =>$data]);
    }

    public function models()
    {
        $data = ['Demio', 'Hilux', 'Corolla', 'Civic',];
        return response()->json(['success' =>true, 'data' =>$data]);
    }

    public function banks()
    {
        $data = ['Banco Popular', 'Banreservas', 'BHD Leon', 'Scotiabank',];
        return response()->json(['success' =>true, 'data' =>$data]);
    }

    public function planTypes()
    {
        $data = ['COMPRENSIVO AL 100%','TODO RIESGO','CERO DEDUCIBLE','DAÑOS A TERCEROS','TU PLAN IDEAL'];
        return response()->json(['success' =>true, 'data' =>$data]);
    }
}
