<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() { 
    
        if (Auth::user()->avatar) { 
            $avatar = Storage::disk('s3')->url(Auth::user()->avatar); 
        }else { $avatar = null ;}

        if (Auth::user()->vaccination_card) { 
            $vax_image = Storage::disk('s3')->url(Auth::user()->vaccination_card); 
        }else {$vax_image = null ; }

        

        return Inertia::render('Profile',[
            'user'=>Auth::user(),
            'avatar' => $avatar,
            'vax_image' => $vax_image,

        ]);
    }

    public function update(Request $request) { 

        $validated = $request->validate([
            'name' => 'string|max:255',
            'gender' => 'string|max:7',
            'city' => 'string|max:255',
            'barangay' => 'string|max:255',
            'present_address' => 'string|max:255',
            'permanent_address' => 'string|max:255',
            'phone_number' => 'string|max:11',
           
        ]);
        $user = User::find(Auth::user()->id); 

        $user->name = $request->name;

        $user->present_address = $request->present_address;

        $user->permanent_address =$request->permanent_address;

        $user->phone_number =$request->phone_number;

        $user->city = $request->city;

        $user->barangay = $request->barangay;

        $user->email  = $request->email ;

        if ($request->hasFile('vaccination_card')) { 
            $path = $request->file('vaccination_card')->store('vax' , 's3');
            $user->vaccination_card = $path;
        }

        if ($request->hasFile('avatar') ) { 
            $path = $request->file('avatar')->store('avatar' , 's3');
            $user->avatar = $path;
        }

        $user->save();

        


        return redirect('profile')->with('message','Successfully Updated');


    }

    public function addTracingLog(Request $request) { 


        $validated = $request->validate([
            'tracing_log' => 'mimes:pdf'
        ]);

        $user = User::findorfail(Auth::user()->id) ;
        if ($request->hasFile('tracing_log')) { 
            $path = $request->file('tracing_log')->store('tracing_log' , 's3');
            $user->tracing_log = $path ;
        }
        

        $user->save();

        return redirect('health_status')->with('message','Successfully Updated');

    }

    public function addMedicalAssesment(Request $request) { 

        $validated = $request->validate([
            'medical_assesment' => 'mimes:pdf',
            'student_id' => 'required'
        ]);

        $student = User::findorfail($request->student_id);

        if($request->hasFile('medical_assesment')) { 
            $path = $request->file('medical_assesment')->store('medical_assesment' , 's3') ; 
            $student->medical_assesment = $path ; 
        }
      

        $student->save();

        return redirect("/student". "/". $request->student_id)->with('message','Successfully Updated');

    }

    
}
