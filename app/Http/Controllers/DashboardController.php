<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Auth ;

use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index() { 
        return Inertia::render('Dashboard');
    }

    public function studentReports() { 

       
        return Inertia::render('StudentReport',[
            'users' =>  User::query()
            ->when(\Request::input('search') , function ($query , $search) { 
                $query->where('name' , 'like' , "%{$search}%" ) ;
            })
            ->paginate(10)
            ->withQueryString(),
            'filters' => \Request::only(['search'])
        ]);
 
    }


    public function show($id) { 
        $student = User::findorfail($id) ;
        if ($student->avatar) { 
            $avatar = Storage::disk('s3')->url($student->avatar); 
        }else { $avatar = null ;}

        if ($student->vaccination_card) { 
            $vax_image = Storage::disk('s3')->url($student->vaccination_card); 
        }else {$vax_image = null ; }

        if ($student->tracing_log) { 
            $tracing_log = Storage::disk('s3')->url($student->tracing_log); 
        }else {$tracing_log = null ; }


        
        return Inertia::render('Student' , [
            'student' => $student,
            'avatar' => $avatar ,
            'vax_image' => $vax_image,
            'tracing_log' => $tracing_log
        ]);

    }
}
