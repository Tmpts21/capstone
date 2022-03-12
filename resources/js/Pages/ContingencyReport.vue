<template>
<BreezeAuthenticatedLayout>



 <div class="min-h-full mx-12 flex flex-col sm:justify-center  pt-6 sm:pt-0 bg-gray-100">
<br> <br>
<div class="grid grid-row mx-auto items-center ">
          <div  class="bg-gray-800 text-white font-bold py-2 px-4 rounded-md mb-12 "  > 
            <p> <i class="fas fa-info-circle text-md mr-2 "></i>  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores nihil, tempora dolore ipsam quis consequatur, reiciendis vero similique blanditiis id, dignissimos rerum. Earum id voluptate velit vel commodi, mollitia doloremque.</p>
          </div>
          <br>

</div>
    <div class="grid grid-cols-4 mx-auto text-center  gap-4">
      
        <div  class="col col-span-4 p-5 ">
          <a :class="{'p-5 bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ': status == 'normal'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > Normal </a>
              <i class="fas fa-arrow-right mx-5 text-lg  "></i>
          <a :class="{'p-5 bg-orange-800 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full ': status == 'in_triage'}"  class="text-lg font-bold bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > In Triage Area </a>
              <i class="fas fa-arrow-right mx-5 text-lg  "></i>
          <a :class="{'p-5 bg-yellow-800 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full ': status == 'in_quarantine'}"  class=" bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > In Quarantine </a>
              <i class="fas fa-arrow-right mx-5 text-lg "></i>
          <a :class="{'p-5 bg-indigo-800 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full ': status == 'in_antigen'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > Antigen Testing  </a>
              <i class="fas fa-arrow-right mx-5 text-lg  "></i>
          <a :class="{'p-5 bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full ': status == 'is_positive'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > Positive  </a>

        </div>
          <br>
          <br>
          <br>

    </div>

</div>


 
 
</BreezeAuthenticatedLayout>
</template>
       
 

<script>
import {ref , watch } from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  props : ['status' , 'name'],
  components : { 
      BreezeAuthenticatedLayout,
  },

  setup (props) { 
      
  }

}
  
</script>