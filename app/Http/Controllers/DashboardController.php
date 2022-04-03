<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Auth ;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index() { 
        return Inertia::render('Dashboard' , ['student' => Auth::user()]);
    }

    public function studentReports() { 
        return Inertia::render('StudentReport',[
            'users' =>  User::query()
            ->when(\Request::input('search') , function ($query , $search) { 
                $query
                ->where('name' , 'like' , "%{$search}%" )
                ->orWhere('status' , 'like' , "%{$search}%" )
                 ;
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


        if ($student->medical_assesment) { 
            $medical_assesment = Storage::disk('s3')->url($student->medical_assesment); 
        }else {$medical_assesment = null ; }

        
        return Inertia::render('Student' , [
            'student' => $student,
            'avatar' => $avatar ,
            'vax_image' => $vax_image,
            'tracing_log' => $tracing_log,
            'medical_assesment' => $medical_assesment

        ]);

    }


    public function contingencyReport($id) { 

        $student = User::findorfail($id); 
        
        if($student->rem_days) { 
            $rem_days = Carbon::now()->diffInDays($student->rem_days);
        }else { $rem_days = null ; }
        

        return Inertia::render('ContingencyReport' , [
            'status' => $student->status ,
            'name' => $student->name ,
            'id' => $student->id ,
            'rem_days' => $rem_days
        ]);


        

    }

    public function changeStudentStatus(Request $request) {
        $student = User::findorfail($request->id) ; 

        if ($request->status == 'normal') { 
            $student->rem_days = null ;
        }

        if ($request->status == 'in_quarantine') { 
            $newDateTime = Carbon::now()->addDays(intval($request->rem_days));
            $student->rem_days = $newDateTime->toDateTimeString();
        }

        
        if ($request->status == 'is_positive') { 
            $newDateTime = Carbon::now()->addDays(intval(30));
            $student->rem_days = $newDateTime->toDateTimeString();
        }
        
        $student->status = $request->status ;
        $student->save(); 

        return redirect('student_reports')->with('message','Successfully Updated');

    }

    public function users() { 
        return Inertia::render('Users',[
            'users' =>  User::query()
            ->when(\Request::input('search') , function ($query , $search) { 
                $query
                ->where('name' , 'like' , "%{$search}%" )
                ->orWhere('status' , 'like' , "%{$search}%" )
                 ;
            })
            ->paginate(10)
            ->withQueryString(),
            'filters' => \Request::only(['search'])
        ]);
    }

    public function disable_user($id) { 
        $user = User::findorfail($id); 
        $user->account_status = 0 ; 
        $user->save(); 

        return redirect('users')->with('message','Successfully Disabled');


    }

    public function enable_user($id) { 

        $user = User::findorfail($id); 
        $user->account_status = 0 ; 
        $user->save(); 

        return redirect('users')->with('message','Successfully Enabled');


    }

    public function create_user() { 
        return Inertia::render('CreateUser');
    }
}
