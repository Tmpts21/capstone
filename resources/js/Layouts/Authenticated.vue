<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                
                                    <BreezeApplicationLogo class="block h-9 w-auto" />
                                </Link>
                            </div>
           
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <i class="fa-solid fa-chart-area text-blue-800 mr-2 text-lg"></i>    Dashboard
                                </BreezeNavLink>
                                <BreezeNavLink :href="route('map')" :active="route().current('map')">
                                   <i class="fa-solid fa-map mr-2 text-lg text-blue-800 "></i>  Interactive map 
                                </BreezeNavLink>
                                <BreezeNavLink :href="route('health_check')" :active="route().current('health_check')">
                                   <i class="fa-solid fa-calendar-days mr-2 text-lg text-blue-800 "></i>
                                  Daily Health Check
                                </BreezeNavLink>
                                 <BreezeNavLink :href="route('healthStatus')" :active="route().current('healthStatus')">
                                   <i class="fa-solid fa-heart-pulse text-blue-800 mr-2 text-lg "></i>
                                  Health Status
                                </BreezeNavLink>

                                 <BreezeNavLink v-if="$page.props.auth.user.role =='admin'" :href="route('student_reports')" :active="route().current('student_reports')" >
                                     <i class="fa-solid fa-table text-blue-800 mr-2 text-lg "></i>             
                               Student/Employee Report 
                                </BreezeNavLink>

                                <BreezeNavLink v-if="$page.props.auth.user.role =='admin'" :href="route('users')" :active="route().current('users')" >
                                     <i class="fa-solid fa-users text-blue-800 mr-2 text-lg "></i>             
                                 User Management 
                                </BreezeNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <h5 class="mr-5 " :class="{
                                                    'bg-green-400 text-black  text-lg hover:bg-green-400 rounded-full p-2 ' : $page.props.auth.user.status == 'normal', 
                                                    'bg-orange-400 text-black hover:bg-blue-500 rounded-full p-2' : $page.props.auth.user.status == 'in_triage',
                                                    'bg-yellow-400 text-black hover:bg-yellow-500 rounded-full p-2 ' : $page.props.auth.user.status == 'in_quarantine',
                                                    'bg-indigo-500 text-black hover:bg-indigo-500 rounded-full p-2' : $page.props.auth.user.status == 'in_antigen',
                                                    'bg-red-400 text-black hover:bg-red-500 rounded-full p-2' : $page.props.auth.user.status == 'is_positive',
                                                    }" 
                                                    > {{$page.props.auth.user.status}}</h5>

                                                        {{ $page.props.auth.user.name }}

                                                

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('profile')" method="get" as="button">
                                           profile
                                        </BreezeDropdownLink>
                                      
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>

                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">

                       
                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink class="ml-3 bg-blue-800 text-white rounded-lg" :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </BreezeResponsiveNavLink>

                             <BreezeResponsiveNavLink class="ml-3 bg-blue-800 text-white rounded-lg" :href="route('profile')" method="get" as="button">
                                Profile
                            </BreezeResponsiveNavLink>
                            <BreezeResponsiveNavLink class="ml-3 bg-blue-800 text-white rounded-lg" :href="route('map')" method="get" as="button">
                                           Interactive Map
                            </BreezeResponsiveNavLink>
                            <BreezeResponsiveNavLink class="ml-3 bg-blue-800 text-white rounded-lg" :href="route('health_check')" method="get" as="button">
                                Daily Health Check
                            </BreezeResponsiveNavLink>
                                <BreezeResponsiveNavLink class="ml-3 bg-blue-800 text-white rounded-lg" :href="route('healthStatus')" method="get" as="button">
                                Health Status 
                            </BreezeResponsiveNavLink>
                                         
                            <BreezeResponsiveNavLink class="ml-3 bg-red-500 text-white rounded-lg" :href="route('logout')" method="post" as="button">
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
