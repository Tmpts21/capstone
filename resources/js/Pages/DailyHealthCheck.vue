<template>
<Head title="Daily Health Check " />

<BreezeAuthenticatedLayout>
 
 <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
  
            
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
             <div v-if="$page.props.flash.status" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.status  }}</p>
                </div>
            </div>
          <div>
            <BreezeValidationErrors class="mb-4" />

  <form @submit.prevent="submit">
            <h2 class="font-bold text-center">Health Declaration Form </h2>
            <br>
            <p>1. Are you experiencing or did you have any of the following in the last 14 days? lkaw ba ay may nararanasan o nakaranas 
               ng mga sumusunod na sintomas sa nakaraang 14 na araw?</p>
               <br>
            <div>
                <label class='mt-2'>a. Fever <i>(Lagnat)</i>  </label>
                <select class="mt-2 mb-2  block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.a" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
            <div>
                <label class='mt-2'>b. Cough and/or Colds <i>(Ubo at/o Sipon)</i> </label>
                <select class="mt-2 mb-2  block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.b" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
              <div>
                <label class='mt-2'>c. Body pains <i>(Pananakit ng katawan)</i> </label>
                <select class="block mt-2 mb-2   appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.c" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
              <div>
                <label class='mt-2'>d. Sore Throat <i>(Pananakit o pamamaga ng lalamunan)</i>  </label>
                <select class="block mb-2 mt-2   appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.d" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
              <div>
                <label class='mt-2'>e. Fatigue/Tiredness <i>(Pagkapagod)</i>  </label>
                <select class="block mb-2 mt-2  appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.e" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
            <div>
                <label class='mt-2'>f. Headache <i>(Pananakit ng ulo)</i>  </label>
                <select class="block mb-2  mt-2  appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.f" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>

            <div>
                <label class='mt-2'>g. Diarrhea <i>(Pagtatae)</i>  </label>
                <select class="block mb-2  mt-2  appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.g" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
            <div>
                <label class='mt-2'>h. Loss of taste or smell <i>(Nawalan ng panlasa o pang-amoy)</i>  </label>
                <select class="block mt-2 mb-2  appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.h" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>
             <div>
                <label class='mt-2'>i. Difficulty of breathing <i>(Pagkahapo o hirap sa pag hinga)</i>  </label>
                <select class="block mt-2 mb-2 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.i" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>

       

              <div>
                <label class='mt-2'>2. Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes for the past 14 days? <i>(May nakasalamuha ka ba na maaaring o kumpirmadong pasyente na may COV/D-19 mu/a sa isang metrong 
                  distansya or mas malapit pa at tumagal ng mahigit 15 minuto sa nakalipas na 14 araw?) </i></label>
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.one" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>

                <div>
                <label class='mt-2'>3. Have you provided direct care for a patient with probable or confirmed COVI-19 case without using proper "Personal Protective Equipment (PPE)" for the past 14 days? <i>(Nagalaga ka ba ng maaring o kumpirmadong pasyente na may COV/D-19 ng 
                  hindi nakasuot ng tamang PPE (Personal Protective Equipment) sa nakalipas na 14 araw?)</i></label>
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.two" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>

                 <div>
                <label class='mt-2'>4. Have you traveled outside the Philippines in the last 14 days? <i>(lkaw ba ay nagbiyahe sa labas ng Pilipinas sa nakalipas na 14 na araw?)</i> </label>
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.three" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>

                 <div>
                <label class='mt-2'>5. Have you traveled outside the current city/municipality where you reside? <i>(Ikaw ba ay bumyahe sa labas ng iyong lungsod o munisipalidad)</i></label>
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.four" required autofocus autocomplete="gender">
                    <option>yes </option>
                    <option>no</option>
                </select>        
            </div>

            <br>
            <div class="flex items-center justify-end mt-4">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                 <i class="fas fa-save"> Save</i>  
                </BreezeButton>
            </div>

         
        </form>

          </div>

         </div>
                    </div>


</BreezeAuthenticatedLayout>
</template>
       
 

<script>
import { Inertia } from '@inertiajs/inertia'
import BreezeButton from '@/Components/Button.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  props : [],
  components : { 
    BreezeButton,
    Link,
    BreezeAuthenticatedLayout,
    BreezeValidationErrors,
    Head
  },
  setup (props) {
   const form = useForm({
    a : '',
    b: '',
    c: '',
    d: '',
    e: '',
    f: '',
    g: '',
    h: '',
    one: '',
    two: '',
    three: '',
    four : '',

    

});

    function submit() {
      Inertia.post('check_health_form', form)
    }
    return { form, submit }
  },
}
</script>