<?php

namespace App\Http\Controllers;

use App\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    public function index()
    {
        $occupations = Occupation::all();
        return response()->json(['success'=> true, 'data' => $occupations]);
    }
}
