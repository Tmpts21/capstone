<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
export default {
  props : ['student'],
  components : { 
    BreezeAuthenticatedLayout,
    Head
  },
  setup (props) {

    let isFilled = ""
    
    if (props.student.dailyHealthCheckDate) { 
      var today = new Date();
      isFilled = (today.toDateString() == new Date(props.student.dailyHealthCheckDate).toDateString());
    }else {
      isFilled = false  
    }



    const url = "https://api.qrserver.com/v1/create-qr-code/?data=Name : " + props.student.name + "%0A" + "Status : " + props.student.status +"%0A"+ "Daily Health Check Form : "+ isFilled + "&amp;size=100x100" 

    
   return {url}

  },
}
</script>


<template>
<div v-if="$page.props.auth.user.account_status != 0 ">

    <Head title="Dashboard" />


    <BreezeAuthenticatedLayout>

        <template #header>
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
                        St.Paul COVID-19 Bulletin 
            </h1>

            
        </template>





            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
<br>
                    <img class="h-65 w-65 rounded-full ring-2 ring-white" src="https://st-paul-capstone.s3.ap-southeast-1.amazonaws.com/logo/download.png" alt="">

                   <br>
                   <h3>My Qr Code </h3>
                    <img  :src="url" alt="" title="" />
                    <br>
                      <a href="https://doh.gov.ph/covid19tracker" target="_blank" class="mt-5 mb-5 text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-7 py-4 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                            <i class="float-left mr-2 fa-solid fa-hospital-user"></i>  View COVID-19 Tracker 
                    </a>
                </div>

                
                  
            </div>
            
    </BreezeAuthenticatedLayout>
    </div>
    <div v-else >
      <div class="bg-gradient-to-r from-purple-300 to-blue-200">
        <div class="w-9/12 m-auto py-16 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg pb-8">
        <div class="border-t border-gray-200 text-center pt-8">
        <h1 class="text-9xl font-bold text-purple-400">403</h1>
        <p class="text-2xl pb-8 px-12 font-medium">Oops! Looks like your Account has been Disabled Pls contact your Administrator </p>

        </div>
        </div>
        </div>
      </div>
    
    </div>

</template>
