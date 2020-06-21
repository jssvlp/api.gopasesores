<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;
    public function __construct()
    {
        $this->repository(new User());
    }
}
