<template>
    <Head title="Interactive Map " />

<BreezeAuthenticatedLayout>
  <template #header>    
               <div class="mx-20 h-50 w-50 bg-green-100  border-green-500 text-green-700 p-5" role="alert" >
                    <p> <i class="fa-solid fa-circle-info text-lg "></i> In this interactive map you can locate if there is a high risk level of covid 19. 
                        In this map it is show the number of students in each barangay. The map also shows the covid 19 data of the barangay </p>
                </div>

            
    </template>


<div>
  <div>
    <br>

             
                <br>
  </div>
               

<div class="col-span-2">
  
  
 <GMapMap
      :center="{lat: 14.9660, lng: 120.9550}"
      :zoom="7"
      map-type-id="terrain"
      class="h-screen"
  >

    <GMapMarker
      :key="index"
      v-for="(data, index) in mapData"
      :position="{lat : data.lat , lng : data.long }"
      :clickable="true"
    >
     <GMapInfoWindow
             :opened="true"
     >
        <div> 
          <h5 class="font-bold">
            Brgy.{{data.barangay}}
          </h5> 
           </div>
        <div class='text-green-500'>
          Number of students residing: <span class="text-green-800 font-bold">{{data.student_count}}</span>
        </div>
        <hr class="mt-2">
        <br>
        <div>
          <span class="font-bold">Student Tracker <i class="fa-solid fa-magnifying-glass-location "></i> </span>
           <div class='text-green-500'>
              Healthy : <span class="text-red-800 font-bold">{{data.normalCount}}</span>
          </div>
           <div class='text-red-500'>
              Positive   : <span class="text-orange-800 font-bold">{{data.positive}}</span>
          </div>
           <div class='text-yellow-500'>
              In triage Area  : <span class="text-yellow-800 font-bold">{{data.in_triage}}</span>
          </div>

           <div class='text-orange-300'>
              In quarantine: <span class="text-yellow-800 font-bold">{{data.in_quarantine}}</span>
          </div>

          <div class='text-indigo-500'>
              Undergoing Antigen Testing : <span class="text-yellow-800 font-bold">{{data.in_antigen}}</span>
          </div>

          <div class='text-blue-500'>
             Distance :  <span class="text-blue-800 font-bold">{{parseInt(calcCrow(data.lat , data.long , 14.966904 , 120.95518))}}km away from St.Paul College</span>
          </div>

        </div>
               
      </GMapInfoWindow>
    </GMapMarker>

  
  </GMapMap>
</div>




</div>


 
 
</BreezeAuthenticatedLayout>
</template>
       
 

<script>
import { Inertia } from '@inertiajs/inertia'
import {ref} from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  props : ['mapData' ,'user'],
  components : { 
      BreezeAuthenticatedLayout,
      Head
  },

  setup (props) { 

    const ops = {
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    }

      function calcCrow(lat1, lon1, lat2, lon2) 
    {
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      return d;
    }

    // Converts numeric degrees to radians
    function toRad(Value) 
    {
        return Value * Math.PI / 180;
    }

    return { calcCrow , ops}
  }

}
  
  

</script>