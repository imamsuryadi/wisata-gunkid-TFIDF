<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class WisatawanController extends Controller
{
    public function index()
    {
        $wisatawan = User::where('is_admin' , 0)->get();
        return view('admin.wisatawan.index',compact ('wisatawan'));
    }
}
