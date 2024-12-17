<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index'); // Asegúrate de tener esta vista creada
    }

    public function toAdmiLogin()
    {
        return view('admin.dashboard.index'); // Asegúrate de tener esta vista creada
    }
}
