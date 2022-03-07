<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DailyHealthCheckController extends Controller
{
    public function index() { 
        return Inertia::render('DailyHealthCheck');
    }
}
