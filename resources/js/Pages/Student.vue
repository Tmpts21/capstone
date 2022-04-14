<template>
    <Head title="Student/Employee " />

<BreezeAuthenticatedLayout>
 <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
     <br><br>

       <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
        </div>
      
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md  sm:rounded-lg">
          

                    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
                        
                   
                    <Link           :class="{
                                    'bg-green-800' : student.status == 'normal', 
                                    'bg-orange-800' : student.status == 'in_triage',
                                    'bg-yellow-400 text-black' : student.status == 'in_quarantine',
                                    'bg-indigo-800' : student.status == 'in_antigen',
                                    'bg-red-800' : student.status == 'is_positive',
                                    }"  
                                    v-if="statuses.includes(student.status)" :href="route('contingency_report' , {id : student.id })" class="text-white font-bold py-2 px-4 rounded-full" v-html="'View Student Report'"
                        />

                        <div  :class="{
                                          'bg-green-800' : student.status == 'normal', 
                                          'bg-orange-800' : student.status == 'in_triage',
                                          'bg-yellow-400 text-black' : student.status == 'in_quarantine',
                                          'bg-indigo-800' : student.status == 'in_antigen',
                                          'bg-red-800' : student.status == 'is_positive',
                                          }"   
                                          v-else-if="student.status == 'normal' " class="ml-5 text-white font-bold py-2 px-4 rounded-full" target="_blank" alt=""> Healthy Condition <i class="fa-solid fa-face-smile"></i>  </div>
                     
                        <br>
                        <img v-if="avatar" class="inline-block h-24 w-24 rounded-full ring-2 ring-white" :src="avatar"  alt="">
                        <span v-else>No avatar </span>
  <div class="mt-4">
                <label for="image" value="Update 2x2 Picture" />
              
            
            <br> 

           
                          
            <h4 class="font-bold">Basic Info</h4>
            <div>
                <label for="name" >Name  </label> 
                <input id="name" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.name"  autofocus autocomplete="name" disabled/>
            </div>

            <div>
                <label for="status" >Status  </label> 
                <input id="status" v-if="statuses.includes(student.status)" type="text" class="block appearance-none w-full text-red-800 bg-gray-200 border border-gray-200 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  :value="student.status"  autofocus autocomplete="name" disabled/>
                <input id="status" v-else type="text" class="block text-green-800 appearance-none w-full text-red-800 bg-gray-200 border border-gray-200 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  :value="student.status"  autofocus autocomplete="name" disabled/>

            </div>

            <div class="mt-4">
                <label for="gender" > Gender </label> 
                <input id="gender" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.gender"  disabled autofocus autocomplete="gender" />
            </div>


            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4" >
                <label for="City" > City </label> 
                    <input id="City" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.city"  disabled autofocus autocomplete="city" />
                </div>

                <div class="mt-4" >
                <label for="barangay" > Barangay </label> 
                    <input id="barangay" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.barangay" disabled  autofocus autocomplete="barangay" />
                </div>
              
            </div>
           

            <div class="mt-4" >
                <label for="permanent " >Permanent Address</label> 
                <input id="permanent" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.permanent_address" disabled  autofocus autocomplete="permanent_address" />
            </div>

                   <div class="mt-4" >
                <label for="present_address" >Present Address</label> 
                <input id="present_address" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.present_address"  disabled autofocus autocomplete="present_address" />
            </div>

            <div class="mt-4" >
                <label for="number" >Phone Number </label> 
                <input id="number" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.phone_number" disabled  autofocus autocomplete="phone_number" />
            </div>

            <div class="mt-4">
                <label for="email" >Email</label> 
                <input id="email" type="email" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="student.email" disabled autocomplete="username" />
            </div>

            <div class="mt-4">
                <label >Vacciantion Card </label> 
                    <a  v-if="vax_image" class="ml-5 bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" :href="vax_image" target="_blank" alt=""> View Vacciantion Card </a>
                    <span v-else> : No vaccination Image available</span>
        </div>

    <br>
    
            <div class="mt-4">
                        <label >Contract Tracing Log </label> 
                        <a  v-if="tracing_log" class="ml-5 bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" :href="tracing_log" target="_blank"  alt=""> View tracing Log </a>
                        <span v-else > :  Not Available </span>
            </div>

         <div class="mt-4">
                <label >Medical Assesment  </label> 
                    <a  v-if="medical_assesment" class="ml-5 bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" :href="medical_assesment" target="_blank" alt=""> View Medical Assesment </a>
                    <span v-else> : Not Available </span>
        </div>
            <div class="mt-6">
                 <form @submit.prevent="submit(student.id)">
                <div class="flex flex-col pt-6 sm:pt-0 ">
                    <div class="mt-4">
                        <label for="tracing_log" > Add/update Medical assesment </label>
                        <input id="tracing_log" type="file" class="mt-1 block w-full  block
                                                                    w-full
                                                                    px-3
                                                                    py-1.5
                                                                    text-base
                                                                    font-normal
                                                                    text-gray-700
                                                                    bg-white bg-clip-padding
                                                                    border border-solid border-gray-300
                                                                    rounded
                                                                    transition
                                                                    ease-in-out
                                                                    m-0
                                                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                                                    @input="form.medical_assesment = $event.target.files[0]" enctype="multipart/form-data"  />
                </div>

                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <i class="fas fa-save"> Save</i>  
                        </BreezeButton>
                    </div>


                    </div>

                </form>
                    </div>

        <br>

            


            
                
                        </div>

                </div>

         </div>

         
</div>
</BreezeAuthenticatedLayout>
</template>
       
 

<script>
import { Inertia } from '@inertiajs/inertia'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';

export default {
  props : ['student','avatar' ,'tracing_log' ,'vax_image' ,'medical_assesment'],
  components : { 
    Link,
    BreezeAuthenticatedLayout,
    BreezeButton,
    Head
    
  },
  setup (props) {
    const form = useForm({
        'medical_assesment': null ,
        'student_id' : null 
    });

    const statuses = ['in_triage','in_quarantine' ,'is_positive','in_antigen']

    function submit(id) {
      form.student_id = id 
      Inertia.post('/add_medical_assesment', form)
    }

   return {statuses , form , submit} 
  },
}
</script>