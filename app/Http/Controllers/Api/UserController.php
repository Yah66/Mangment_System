<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __constructor(){
        return $this->middleware('auth:api');
    }
    public function index(){
        
    }
}