<template>
<BreezeAuthenticatedLayout>
<br> <br>
<div class=" bg-gray-100 text-gray-600 px-4 mt-5 ">

    <div class="flex flex-col justify-center h-full">
            <div v-if="$page.props.flash.message" class="alert">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
            </div>
    <br>
        <!-- Table -->
        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <div>
                <small> <Link  :href="route('create_user')" class="mr-4 float-right mt-2   text-white bg-blue-800 hover:bg-blue-400 font-bold py-2 px-4 rounded-full" v-html="'Create User'"/></small> 

            </div>
             <br> <br>
            <header class="px-5 py-4 border-b border-gray-100">

              <div class="flex justify-between">
                <h1 class="font-semibold text-blue-800 text-lg mt-3">Users Management </h1>

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
                                    <div class="font-semibold text-left">Role</div>
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
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-800">{{user.role}}</div>
                                    </div>
                                </td>

                              <td class="p-4 whitespace-nowrap  ">
                                    <div class="text-center">
                                      <div v-if="user.account_status == 1  ">
                                        <button  class="bg-gray-500 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded-full" @click="disable(user.id)" > Disable </button>
                                      </div>
                                      <div v-if="user.account_status == 0  ">
                                        <button  class="bg-green-500 hover:bg-green-300 text-black font-bold py-2 px-4 rounded-full" @click="enable(user.id)" > Enable </button>
                                      </div>
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

  
</div>



 
 
 
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
    watch(search , value => { 
      Inertia.get('/users',{search : value } , { 
        preserveState : true 
      })
    })

    function disable(id) {
      Inertia.post('disable_user/' +  id  ) ;
    }

    function enable(id) {
      Inertia.post('enable_user/' +  id  ) ;
    }
    return {search , disable , enable }


  }

}
  
  

</script>