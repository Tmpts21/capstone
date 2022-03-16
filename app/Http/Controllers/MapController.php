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

      
        $brgys = array();
        $c = array(); 

        $studentStatuses = array() ;
        foreach($students as $student) {
            array_push($brgys , $student->barangay  );
            array_push($c , [$student->latitude , $student->longitude] );
            array_push($studentStatuses , [$student->status , $student->barangay]);
        }



        $map_data = array(); 
        $brgys_count = array_count_values($brgys);


        foreach($brgys_count as $key => $value ){
            $normal= 0 ;
            $in_triage = 0 ;
            $in_quarantine = 0 ; 
            $positive = 0 ;
            $antigen = 0 ;

            foreach($studentStatuses as $x=> $y ){
                
                // statuses on each barangays
                if($y[1] ==  $key && $y[0] == 'normal' ){ 
                    $normal++ ; 
                }else if($y[1] == $key && $y[0] == 'in_triage') { 
                    $in_triage++;
                }else if($y[1] == $key && $y[0] == 'is_positive') { 
                    $positive++;
                }else if($y[1] == $key && $y[0] == 'in_quarantine') { 
                    $in_quarantine++;
                }else if($y[1] == $key && $y[0] == 'in_antigen') { 
                    $antigen++;
                }
            }

            
            $mapObject = (object)['barangay' => $key , 
                                    'student_count' => $value , 
                                    'lat' => floatval($c[array_search($key , $brgys)][0]) ,
                                    'long' =>  floatval($c[array_search($key , $brgys)][1]),
                                    'normalCount' => $normal,
                                    'in_triage' => $in_triage,
                                    'in_quarantine' => $in_quarantine , 
                                    'in_antigen' => $antigen , 
                                    'positive' => $positive];

            array_push($map_data , $mapObject);
        }

        return $map_data;
    
    }


  
}



