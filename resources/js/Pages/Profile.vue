<template>
<BreezeAuthenticatedLayout>
 <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
     <br><br>
            <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
            </div>
              <BreezeValidationErrors class="mb-4" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
                
                        <img v-if="avatar" class="inline-block h-24 w-24 rounded-full ring-2 ring-white" :src="avatar" alt="">

  <div class="mt-4">
                <BreezeLabel for="image" value="Add/Update Profile Picture" />
                <BreezeInput id="profile_image" name="profile_image" type="file" class="mt-1 block w-full  block
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
                                                            @input="form.avatar = $event.target.files[0]" enctype="multipart/form-data"   autocomplete="profile_image" />
            </div>
                    </div>
            <br> 

           
                          
            <h4 class="font-bold">Basic Info</h4>
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="gender" value="gender" />

                <select class="block  w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.gender" required>
                    <option>male</option>
                    <option>female</option>
                    <option>other</option>
                </select>
            </div>


            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4" >
                    <BreezeLabel for="City" value="City" />
                    <BreezeInput id="City" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.city"  autofocus autocomplete="city" />
                </div>

                <div class="mt-4" >
                    <BreezeLabel for="barangay" value="Barangay" />
                    <BreezeInput id="barangay" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.barangay"  autofocus autocomplete="barangay" />
                </div>
              
            </div>
           

            <div class="mt-4" >
                <BreezeLabel for="permanent" value="Permanent Address" />
                <BreezeInput id="permanent" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.permanent_address"  autofocus autocomplete="permanent_address" />
            </div>

                   <div class="mt-4" >
                <BreezeLabel for="present_address" value="Present Address " />
                <BreezeInput id="present_address" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.present_address"  autofocus autocomplete="present_address" />
            </div>

            <div class="mt-4" >
                <BreezeLabel for="number" value="Phone number" />
                <BreezeInput id="number" type="text" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.phone_number"  autofocus autocomplete="phone_number" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="form.email"  autocomplete="username" />
            </div>

              <div class="mt-4 mb-4 text-center">
                    <a  v-if="medical_assesment" class="ml-5 bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" :href="medical_assesment" target="_blank" alt=""> View Medical Assesment </a>
        </div>

   <br>

            <div class="mt-4 mb-2 text-center ">
                     <a  v-if="vax_image" class="ml-5 bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" :href="vax_image" target="_blank" alt=""> View Vaccination Card  </a>
            </div>
            
            <div class="mt-4">
                <BreezeLabel for="vax_image" value="Add/Update Vaccination card" />
                <BreezeInput id="vax_image" type="file" class="mt-1 block w-full  block
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
                                                             @input="form.vaccination_card = $event.target.files[0]" enctype="multipart/form-data" autocomplete="vax_image" />
            </div>



            <div class="flex items-center justify-end mt-4">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                 <i class="fas fa-save"> Save</i>  
                </BreezeButton>
            </div>
        </form>
   </div>
</div>
</BreezeAuthenticatedLayout>
</template>
       
 

<script>
import { Inertia } from '@inertiajs/inertia'
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  props : ['user','avatar','vax_image','medical_assesment'],
  components : { 
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    Link,
    BreezeAuthenticatedLayout,
    BreezeValidationErrors,
  },
  setup (props) {
   const form = useForm({
    name: props.user.name,
    gender: props.user.gender,
    email: props.user.email,
    barangay:props.user.barangay,
    city:props.user.city,
    present_address:props.user.present_address,
    permanent_address:props.user.permanent_address,
    phone_number:props.user.phone_number, 
    vaccination_card : null,
    avatar : null,
    terms: false,
    test : props.avatar
});

    function submit() {
      Inertia.post('/update/profile', form)
    }

    return { form, submit }
  },
}
</script>