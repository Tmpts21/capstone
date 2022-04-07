<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Auth ;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;



class UserController extends Controller
{
 
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
        $user->account_status = 1 ; 
        $user->save(); 

        return redirect('users')->with('message','Successfully Enabled');


    }

    public function create_user() { 
        return Inertia::render('CreateUser');
    }

    public function store_user(Request $request) { 

$request->validate([
    'name' => 'required|string|max:255',
    'gender' => 'required|string|max:7',
    'city' => 'required|string|max:255',
    'barangay' => 'required|string|max:255',
    'present_address' => 'required|string|max:255',
    'permanent_address' => 'required|string|max:255',
    'phone_number' => 'required|string|max:11',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);

        
    $coordinates = Http::get('https://maps.googleapis.com/maps/api/geocode/json?address='.$request->city.'+'.$request->barangay.'&key=AIzaSyB1qd_-4A10jIuNomSf4hb5ATOLqgLr6SY');


    if($coordinates['results'] == []) { 
        return redirect()->back()->with('message' , 'Pls input a valid City or Barangay');
    }

    $user = User::create([
        'name' => $request->name,
        'gender' => $request->gender,
        'role' => $request->role,
        'city' => $request->city,
        'barangay' => $request->barangay,
        'present_address' => $request->present_address,
        'permanent_address' => $request->permanent_address,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'latitude' => $coordinates['results'][0]['geometry']['location']['lat'] ,
        'longitude' => $coordinates['results'][0]['geometry']['location']['lng'],
        'password' => Hash::make($request->password),
    ]);


    return redirect('create_user')->with('message','User Successfully Created ');
    }

}
