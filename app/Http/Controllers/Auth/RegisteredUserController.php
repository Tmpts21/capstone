<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)

    {        

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

        // dd($request->city , $request->barangay , 'https://maps.googleapis.com/maps/api/geocode/json?address='.$request->city.'+'.$request->barangay.'&key=AIzaSyB1qd_-4A10jIuNomSf4hb5ATOLqgLr6SY');


        
        $coordinates = Http::get('https://maps.googleapis.com/maps/api/geocode/json?address='.$request->city.'+'.$request->barangay.'&key=AIzaSyB1qd_-4A10jIuNomSf4hb5ATOLqgLr6SY');
              
        if($coordinates['results'] == []) { 
            return redirect()->back()->with('message' , 'Pls input a valid City or Barangay');
        }
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
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

        

        if ($request->hasFile('avatar')) { 
            $avatar = $request->file('avatar')->store('profiles' , 's3');
            $user->avatar = $avatar;
        }
       

        if ($request->hasFile('vaccination_card')) { 
            $vax = $request->file('vaccination_card')->store('vaccination_card' , 's3');
            $user->vaccination_card = $vax ;
        }

    

        $user->save();

        
      

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
