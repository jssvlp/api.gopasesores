<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IStatisticsRepository;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function __construct(IStatisticsRepository $repository)
    {
        $this->repository = $repository;
    }

    public  function index()
    {
        return response()->json(['success'=> true, 'statistics' =>  $this->repository->all()]);
    }


}
