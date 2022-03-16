<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

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
    profile_image:'',
    password_confirmation: '',
    vaccination_card : null,
    avatar : null,
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <BreezeValidationErrors class="mb-4" />

          <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
            </div>
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

              <div class="mt-4">
                <BreezeLabel for="vax_image" value="Insert Vacciantion card" />
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
                                                            @input="form.vaccination_card = $event.target.files[0]" enctype="multipart/form-data"  autocomplete="vax_image" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="image" value="2x2 picture softcopy" />
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
                                                            @input="form.avatar = $event.target.files[0]" enctype="multipart/form-data"  autocomplete="profile_image" />
            </div>

            
          



            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
" type="file" id="formFile">