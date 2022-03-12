<template>
<BreezeAuthenticatedLayout>



 <div class="min-h-full mx-12 flex flex-col sm:justify-center  pt-6 sm:pt-0 bg-gray-100">
<br> <br>
  <img class="object-cover mx-auto" width="800" height="600" src="https://st-paul-capstone.s3.ap-southeast-1.amazonaws.com/contingency_flowchart.PNG">
<br>
<div class="grid grid-row mx-auto items-center ">
          <div  :class="{
            'bg-green-800' : student_status == 'normal', 
            'bg-orange-800' : student_status == 'in_triage',
            'bg-yellow-400 text-black' : student_status == 'in_quarantine',
            'bg-indigo-800' : student_status == 'in_antigen',
            'bg-red-800' : student_status == 'is_positive',
            }" 
             class="bg-gray-800 text-white font-bold py-2 px-4 rounded-md mb-12 mx-12 "  > 
            <p class='p-5 text-lg'> <i class="fas fa-info-circle text-md mr-2 "></i>  
           {{info}}</p>
          </div>
          <br>
</div>




    <div class="grid grid-cols-4 mx-auto text-center  gap-4">
        <div  class="col col-span-4 p-5 ">
          <button @click="changeStatus('normal')" :class="{'text-lg  p-5 bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full ': student_status == 'normal'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > <i class="fa-solid fa-face-grin-stars mr-2 "></i> Normal </button>
              <i class="fas fa-arrow-right mx-5 text-lg  "></i>
          <button @click="changeStatus('in_triage')" :class="{'text-lg  p-5 bg-orange-800 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full ': student_status == 'in_triage'}"  class="font-bold bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  ><i class="fa-solid fa-face-meh mr-2 "></i>  In Triage Area </button>
              <i class="fas fa-arrow-right mx-5 text-lg  "></i>
          <button @click="changeStatus('in_quarantine')" :class="{'text-lg text-black p-5 bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded-full ': student_status == 'in_quarantine'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > <i class="fa-solid fa-face-rolling-eyes mr-2 "></i>  In Quarantine </button>
              <i class="fas fa-arrow-right mx-5 text-lg "></i>
          <button @click="changeStatus('in_antigen')" :class="{'text-lg  p-5 bg-indigo-800 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full ': student_status == 'in_antigen'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  ><i class="fa-solid fa-face-surprise mr-2 "></i>  Antigen Testing  </button>
              <i class="fas fa-arrow-right mx-5 text-lg  "></i>
          <button @click="changeStatus('is_positive')" :class="{'text-lg p-5 bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full ': student_status == 'is_positive'}"  class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full "  > <i class="fa-solid fa-face-sad-tear mr-2 "></i>Positive  </button>
      
        <br><br>
      <div class="text-center ">
        <button @click="save()"
            :class="{
            'bg-green-800' : student_status == 'normal', 
            'bg-orange-800' : student_status == 'in_triage',
            'bg-yellow-400 text-black' : student_status == 'in_quarantine',
            'bg-indigo-800' : student_status == 'in_antigen',
            'bg-red-800' : student_status == 'is_positive',
            }" class="text-cemter text-white font-bold py-2 px-4 rounded-full "  > <i class="fa-solid fa-floppy-disk mr-2 "></i> Save  </button>
      </div>
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
import { Inertia } from '@inertiajs/inertia'

export default {
  props : ['status' , 'name' ,'id'],
  components : { 
      BreezeAuthenticatedLayout,
  },

  setup (props) { 

    let student_status = ref(props.status)

    let statuses = ['normal','in_triage','in_quarantine','in_antigen','is_positive']
    let index = statuses.indexOf(student_status.value)
    let statusInfo = ref([
          'Looks like this student is in normal and health conditiot. No sympotoms of covid 19 is found . He/She can now go to their respective classrooms.' ,     
          'This student is in triage area. He/She should proceed in triage area for health interview by the school nurse ' , 
          'This student is in Quarantine. Learners and/or employee/s will be advised to go home for 1 -2 days of home quarantine before performing the Antigen test or referring to the LGU for RT-PCR Test',
          'This student is required for Antigen Testing. The school nurse will perform Antigen testing (learners with signed parent’s/guardian’s consent)',
          'This student is Positive. the learners and/or employee will be advised to go home for a 10-day home quarantine. REPORT to Barangay Health Worker, Municipal ESU, and DepEd Regional Health Personnel for further instruction and medical intervention if needed '
      ])
    let info = ref(statusInfo.value[index])


    const changeStatus = (new_status) => { 
      student_status.value = new_status
      let index = statuses.indexOf(student_status.value)
      info.value = statusInfo.value[index]
    }


    function save() { 

       Inertia.get('/change_student_status',{id :props.id , status: student_status.value  } , { 
         preserveState : true 
       })

    }
   

     return {changeStatus , student_status , info , save}
    }

   
  }


  
</script>