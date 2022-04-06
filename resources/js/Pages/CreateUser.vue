<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';



const form = useForm({
    name: '',
    gender: '',
    email: '',
    barangay:'',
    city:'',
    present_address:'',
    permanent_address:'',
    phone_number:'', 
    password: '',
    avatar:'',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('store_user'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });

};
</script>

<template>
  <BreezeAuthenticatedLayout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <h1 class="mt-5 font-bold bg-blue-800 rounded-xl p-3 text-white  ">Create User </h1>
      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <Head title="Create User " />
          <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
            </div>

        <BreezeValidationErrors class="mb-4" />

        
            <br>

        <form @submit.prevent="submit">

           
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="gender" value="gender" />

                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  v-model="form.gender" required autofocus autocomplete="gender">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>


            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4" >
                    <BreezeLabel for="City" value="City" />
                    <BreezeInput id="City" type="text" class="mt-1 block w-full" v-model="form.city" required autofocus autocomplete="city" />
                </div>

                <div class="mt-4" >
                    <BreezeLabel for="barangay" value="Barangay" />
                    <BreezeInput id="barangay" type="text" class="mt-1 block w-full" v-model="form.barangay" required autofocus autocomplete="barangay" />
                </div>
              
            </div>
           

            <div class="mt-4" >
                <BreezeLabel for="permanent" value="Permanent Address" />
                <BreezeInput id="permanent" type="text" class="mt-1 block w-full" v-model="form.permanent_address" required autofocus autocomplete="permanent_address" />
            </div>

                   <div class="mt-4" >
                <BreezeLabel for="present_address" value="Present Address " />
                <BreezeInput id="present_address" type="text" class="mt-1 block w-full" v-model="form.present_address" required autofocus autocomplete="present_address" />
            </div>

            <div class="mt-4" >
                <BreezeLabel for="number" value="Phone number" />
                <BreezeInput id="number" type="text" class="mt-1 block w-full" v-model="form.phone_number" required autofocus autocomplete="phone_number" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>



     

            
          



            <div class="flex items-center justify-end mt-4">
      

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    create
                </BreezeButton>
            </div>
        </form>
      </div>
      </div>
    </BreezeAuthenticatedLayout>
</template>
