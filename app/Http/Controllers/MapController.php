<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Auth; 

class MapController extends Controller
{
    public function index () { 

        $data = $this->handleMapData(User::all()); 

        return Inertia::render('Map',[
            'mapData' => $data ,
            'user' => Auth::user(),
        ]);
    }

    private function handleMapData($students) { 

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
            [15.045960,121.316850],
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

        $brgys = array();
        $c = array(); 

        foreach($students as $student) {
            array_push($brgys , $student->barangay  );
            array_push($c , [$student->latitude , $student->longitude] );

        }






        $map_data = array(); 
        $brgys_count = array_count_values($brgys);



    
        
        foreach($brgys_count as $key => $value ){
            
            $mapObject = (object)['barangay' => $key , 
                                    'student_count' => $value , 
                                    'lat' => floatval($c[array_search($key , $brgys)][0]) ,
                                    'long' =>  floatval($c[array_search($key , $brgys)][1])];
            array_push($map_data , $mapObject);
        }

        return $map_data;
    
    }


  
}



