<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(){
        //Not working:
        header('Location: /auth/login');
    }
    public function home(){
        //Only authenticated users may enter...
        return view('home');
    }
}
