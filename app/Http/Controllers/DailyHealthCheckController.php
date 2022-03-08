<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\HealthCheck;
use Auth; 
use App\Models\User;
use Carbon\Carbon;

class DailyHealthCheckController extends Controller
{
    public function index() { 
     

        return Inertia::render('DailyHealthCheck');

    }

    public function checkHealthForm(Request $request) { 
        $forbiden_status = ['in_triage','in_quarantine','is_positive'];
        $a = User::find(Auth::user()->id)->dailyHealthCheck->first() ;
        if($a){
            $date =  Carbon::parse(User::find(Auth::user()->id)->dailyHealthCheck->first()->created_at) ; 
            if (in_array(Auth::user()->status , $forbiden_status )){ 
                return redirect('health_check')->with('status' ,"You're current status is prohibiting you to submit this form. Please contact your admin regarding this matter.  " );
            }
            if ($date->isToday()) { 
                return redirect('health_check')->with('status' ,'Thanks for answering but you already submitted your daily health form ');
            }
        }        
        

        $form_data = $request->only('a','b','c','d','e','f','g','h','i','one','two','three','four');

        foreach($form_data as $key => $val) { 
            if($val == 'yes') { 
                $user = User::find(Auth::user()->id); 
                $user->status = 'in_triage' ; 
                $user->save(); 
            }
        }

        $health = HealthCheck::create([
            'user_id' => Auth::user()->id ,
            'form_data' => json_encode($form_data),
        ]);

        return redirect('health_status')->with('status' ,Auth::user()->status);
 
    }

    public function healthStatus() { 

       if ( (Auth::user()->tracing_log) ) { 
            $tracing_log = Storage::disk('s3')->url(Auth::user()->tracing_log);
       }else { $tracing_log = null; }
       
        return Inertia::render('HealthStatus',[
            'tracing_log' => $tracing_log  ,
        ]);
    }

}
