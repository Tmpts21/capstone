<template>
<BreezeAuthenticatedLayout>

<section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
    <div class="flex flex-col justify-center h-full">

        <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
            </div>
        <!-- Table -->
        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">

            <header class="px-5 py-4 border-b border-gray-100">
              <div class="flex justify-between">
                <h1 class="font-semibold text-blue-800 text-lg mt-3">Students Status Report </h1>
                <input type="text" class="rounded" placeholder="Search..... " v-model="search">

              </div>

            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                                  <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="user in users.data" :key="user.id "> 
                                <td class="p-4 whitespace-nowrap ">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-800">{{user.name}}</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap ">
                                    <div :class="{
                                      'text-green-800' : user.status == 'normal', 
                                      'text-orange-800' : user.status == 'in_triage',
                                      'text-yellow-400 text-black' : user.status == 'in_quarantine',
                                      'text-indigo-800' : user.status == 'in_antigen',
                                      'text-red-800' : user.status == 'is_positive',
                                      }"  
                                      v-if="!statuses.includes(user.status)" class="text-left text-green-800 font-bold ">{{user.status}}</div>
                                    <div :class="{
                                      'text-green-800' : user.status == 'normal', 
                                      'text-orange-800' : user.status == 'in_triage',
                                      'text-yellow-400 text-black' : user.status == 'in_quarantine',
                                      'text-indigo-800' : user.status == 'in_antigen',
                                      'text-red-800' : user.status == 'is_positive',
                                      }" 
                                       v-else class="text-left text-red-800 font-bold ">{{user.status}}</div>

                                </td>
                              <td class="p-4 whitespace-nowrap  ">
                                    <div class="text-center">
                                      <Link :class="{
                                          'bg-green-800' : user.status == 'normal', 
                                          'bg-orange-800' : user.status == 'in_triage',
                                          'bg-yellow-400 text-black' : user.status == 'in_quarantine',
                                          'bg-indigo-800' : user.status == 'in_antigen',
                                          'bg-red-800' : user.status == 'is_positive',
                                          }"  
                                           v-if="!statuses.includes(user.status)" :href="route('student' , {id : user.id })" class="text-white font-bold py-2 px-4 rounded-full" v-html="'view'"
                                          
                                      />
                                       <Link :class="{
                                      'bg-green-800' : user.status == 'normal', 
                                      'bg-orange-800' : user.status == 'in_triage',
                                      'bg-yellow-400 text-black' : user.status == 'in_quarantine',
                                      'bg-indigo-800' : user.status == 'in_antigen',
                                      'bg-red-800' : user.status == 'is_positive',
                                      }" 
                                      v-else :href="route('student' , {id : user.id })" class=" text-white font-bold py-2 px-4 rounded-full" v-html="'view'"
                                                                    
                                      />
                                    </div>
                                </td>
                             
                        
                            </tr>
                         
                        </tbody>
                    </table>
                </div>
            </div>
    <component
    :is="link.url ? 'Link' : 'span' "
    v-for="link in users.links"
    :key = link.id 
    :href="link.url"
    v-html="link.label"
    class="mt-6 p-1 bg-white border-gray-300 text-blue-600 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium ml-2 mb-2 "
    :class="{'text-gray-800' : ! link.url , 'font-bold' : link.active }"
    />
     <!-- <Link 
        v-for="link in users.links" :key = link.id  :href="link.url" v-html="link.label" 
      
      /> -->
        </div>
         
    </div>

  
</section>



 
 
</BreezeAuthenticatedLayout>
</template>
       
 

<script>
import { Inertia } from '@inertiajs/inertia'
import {ref , watch } from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
export default {
  props : ['users','filters'],
  components : { 
      BreezeAuthenticatedLayout,
      Link
  },

  setup (props) { 
    let search = ref(props.filters.search);
    const statuses = ['in_triage' , 'in_quarantine','is_positive']
    watch(search , value => { 
      Inertia.get('/student_reports',{search : value } , { 
        preserveState : true 
      })
    })

    return {search , statuses}


  }

}
  
  

</script>