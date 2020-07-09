<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();

        if(count($positions) == 0)
        {
            throw new ModelNotFoundException();
        }
        return response()->json(['success'=>true,'positions'=>$positions]);
    }
}
