<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Inertia } from '@inertiajs/inertia'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

import {  Head , useForm} from '@inertiajs/inertia-vue3';


export default {
    props :['tracing_log' , 'rem_days'] , 
    components : {
        BreezeAuthenticatedLayout,
        Head ,
        BreezeButton,
        BreezeValidationErrors
    },
  setup () {
   const form = useForm({
    'tracing_log': null ,
});

    function submit() {
      Inertia.post('/add_tracing_log', form)
    }

    return { form, submit }
  },
}
</script>


<template>

    <Head title="Health Status " />

    <BreezeAuthenticatedLayout>
      <template #header>
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
                    Your Current Status 
            </h1>

            
        </template>
    <br>
     <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
          <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
            </div>


            <BreezeValidationErrors class="mb-4" />
  
     <div href="#" :class="{
            'bg-green-100 text-black' : $page.props.auth.user.status == 'normal', 
            'bg-orange-400 text-black' : $page.props.auth.user.status == 'in_triage',
            'bg-yellow-400 text-black' : $page.props.auth.user.status == 'in_quarantine',
            'bg-indigo-800 text-black' : $page.props.auth.user.status == 'in_antigen',
            'bg-red-800 text-black' : $page.props.auth.user.status == 'is_positive',
            }" 
            
             class="block p-6 max-w-sm  rounded-lg border border-gray-200 ">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-dark dark:text-white">Health Status : 
        <span v-if =" $page.props.auth.user.status == 'in_triage'" class="text-black-800">
                in triage area 
        </span>
        <span v-if =" $page.props.auth.user.status == 'in_quarantine'" class="text-black-800">
                Quarantine <small class="text-gray-500">{{rem_days}} days remaining</small> 
        </span>
        <span v-if =" $page.props.auth.user.status == 'is_positive'" class="text-black-800">        
                Positive <small class="text-gray-500"> Quarantine {{rem_days}} days remaining</small> 
        </span>
        <span v-if =" $page.props.auth.user.status == 'in_antigen'" class="text-black-800">        
                 Antigen/RT-PCR testing 
        </span>
        <span v-if =" $page.props.auth.user.status == 'normal'" class="text-black-800">
                Normal
        </span>
        
    </h5>
    
    <div v-if="$page.props.auth.user.status == 'in_triage' ">
        <p class="font-normal text-black-800 dark:text-gray-400">Looks like you are in Triage Area. You need to proceed to the triage area for health interview by the nurse </p>
    </div>
     <div v-if="$page.props.auth.user.status == 'in_quarantine' ">
        <p class="font-normal text-black-800 dark:text-gray-400">Looks like you are in Quarantine. Please stay at home and coordinate with your local government unit and school nurse about your quarantine status. stay safe </p>
    </div>
     <div v-if="$page.props.auth.user.status == 'is_positive' ">
        <p class="font-normal text-black-800 dark:text-gray-400">Looks like you are Positive of Covid 19. Please quarantine yourself and coordinate with your local government unit. Stay safe. St.Paul College is here with you.</p>
    </div>
       <div v-if="$page.props.auth.user.status == 'in_antigen' ">
        <p class="font-normal text-black-800 dark:text-gray-400">This student is required for Antigen Testing. The school nurse will perform Antigen testing (learners with signed parent’s/guardian’s consent)</p>
    </div>
     <div v-if="$page.props.auth.user.status == 'normal' ">
        <p class="font-normal text-black-800 dark:text-gray-400">Looks like you are in health is normal. Thank you for keeping youself healthy in this difficult times.</p>
    </div>
        </div>

    </div>
  <div v-if="tracing_log"  class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <br>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Contract Tracing log </h5>
        <br>
            <iframe class="w-9/12 h-screen" :src="tracing_log"></iframe>
    </div>


 <form @submit.prevent="submit">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
            <div class="mt-4">
                <label for="tracing_log" > Update/Insert Contract Tracing log </label>
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
                                                             @input="form.tracing_log = $event.target.files[0]" required enctype="multipart/form-data"  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                 <i class="fas fa-save"> Save</i>  
                </BreezeButton>
            </div>


            </div>

        </form>
 
           
    </BreezeAuthenticatedLayout>
</template>
