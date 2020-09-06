<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\StatisticsRepositoryInterface;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function __construct(StatisticsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public  function index()
    {
        return response()->json(['success'=> true, 'statistics' =>  $this->repository->all()]);
    }


}
