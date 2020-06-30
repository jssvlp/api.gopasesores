<?php

namespace App\Http\Controllers;

use App\EconomicActivity;
use Illuminate\Http\Request;

class EconomicActivityController extends Controller
{
    public function index()
    {
        $EconomicActivity = EconomicActivity::all();
        return response()->json(['success'=> true, 'data' => $EconomicActivity]);
    }
}
