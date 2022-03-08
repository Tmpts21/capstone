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

        $barangays = ['Pantubig',
        'Pasong Bangkal',
        'Pasong Callos', 
        'Pason intsik',
        'Pinacpinacan',
        'Poblacion',
        'Pulo',
        'Pulong Bayabas',
        'Salapungan',
        'Sampaloc',
        'San Agustin',
        'San Roque',
        'Talacsan',
        'Tambubong',
        'Tukod',
        'Ulingao',
        'Sapang Pahalang'];


        $coordinates = [
            [15.026340,121.118430],
            [15.0024 ,121.0134],
            [14.9955, 120.9905],
            [15.0093 ,120.9676],
            [14.9911 , 120.9159 ],
            [14.9567 , 120.9633],
            [14.9756 , 121.0192 ],
            [15.0179 , 120.9102 ],
            [15.0216 , 120.9633 ],
            [14.9809 ,120.9231],
            [15.0294,120.9288],
            [15.0093,120.9331],
            [14.9652,120.9848],
            [14.9701,120.9260],
            [14.9964,121.0536],
            [14.9796,120.9145],
            [14.9938,121.0364],


        ];


        $b = rand(1 , count($barangays)) - 1 ;
    

              

        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'city' => $request->city,
            'barangay' => $barangays[$b],
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'latitude' => $coordinates[$b][0],
            'longitude' => $coordinates[$b][1],
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
