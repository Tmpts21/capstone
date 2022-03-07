<script setup>
import {Link } from '@inertiajs/inertia-vue3';

</script>

<template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h5 class='font-bold' > Data Privacy Statement </h5>
                           

                            Thank you for using (Webapp’s name), a web app developed by the (Capstone researchers)(‘we’ or ‘us’). Your privacy is important to us, 
                            that is why we provide this privacy policy explaining our online data collection practices and the choices you can make about the way 
                            your information is collected and used by this platform. ‘Users’ refer to the persons that use this web application.

                            By using (Webapp’s name), submitting personal information through the platform, and by entering (Webapp’s name) establishments, 
                            the User expressly consents to the collection, use, and disclosure of the user’s personal information in accordance with this privacy 
                            policy, moreover, this information that the users give consent may be use as a reference for the future researchers and the school.

<br> 
<br>

<h5 class="font-bold">User’s Consent</h5> 


                            I have read the Data Privacy Statement and express my consent for the St. Paul College San Rafael through the (Webapp’s name) 
                            Application to collect, record, organize, update or modify, retrieve, block, erase, or destruct my personal data as part of my 
                            information.

                            I hereby affirm my right to be informed, object to processing, access and rectify, suspend or withdraw my personal data, and be 
                            indemnified in case of damages pursuant to the provisions of Republic Act No. 10173 of the Philippines otherwise known as the 
                            Data Privacy Act of 2012 and its corresponding implementing Rules and Regulations.
<br> <br> 
                            <Link :href="'/register'" class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Agree and Continue 
                            </Link>
             
                    </div>
                </div>
            </div>
        </div>
</template>
