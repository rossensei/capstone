<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { ChartPieIcon, UserGroupIcon, BuildingOfficeIcon, CubeIcon, Square3Stack3DIcon, ChevronUpIcon } from '@heroicons/vue/24/solid';
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
  } from '@headlessui/vue'
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import GlobalSearchComponent from '@/Components/GlobalSearchComponent.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, useRemember } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

let isCollapsed = ref(localStorage.getItem("isCollapsed") === "true");
const hidden = ref(false);

const props = defineProps({
    flash: Object,
})

const collapseSidebar = () => {
    
    isCollapsed.value = !isCollapsed.value;
    localStorage.setItem("isCollapsed", isCollapsed.value);
}

const clearLocalStorage = () => {
    localStorage.clear();
}

const getScreenWidth = () => {
    return window.innerWidth;
}

const screenWidth = ref(getScreenWidth())

const handleResize = () => {
    screenWidth.value = getScreenWidth();

    if(screenWidth.value <= 768) {
        isCollapsed.value = true;
    }
    else {
        isCollapsed.value = false;
    }
}

onMounted(() => {
    window.addEventListener('resize', handleResize)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
})

// const navItems = [
//     { href: '/dashboard', label: 'Dashboard', children: [], icon: null },
//     { href: '#', label: 'Purchases', children: [
//         { href: '/purchased-items', label: 'Items', children: [], icon: null },
//         { href: '/purchased-property', label: 'Property', children: [], icon: null }
//     ], icon: null },
// ]

const openPurchaseDisclosure = ref(false)
</script>

<template>
    <div>
        <div class="flex items-start min-h-screen bg-gray-50">
            <nav class="hidden sm:block sticky top-0 z-10 bg-[#4e73df] min-h-screen duration-300" :class="[ !isCollapsed ? 'w-64' : 'w-16' ]">
                <div class="relative p-4">
                    <div class="flex mb-4" :class="[ !isCollapsed ? 'justify-between items-center' : 'justify-center']">
                        <!-- Logo branding -->
                        <Link :href="route('dashboard')" class="w-full flex items-center space-x-2">
                            <img src="../Components/images/mdc-logo.png" alt="mdc-logo" class="w-[40px]">
                            <h1 v-show="!isCollapsed" class="text-md text-white font-semibold text-center">MDC-IMS</h1>
                        </Link>
    
                    </div>
                    <span class="absolute -right-8 top-5 bg-gray-400 bg-opacity-75 text-gray-50 rounded-lg p-1.5 text-center text-sm cursor-pointer peer" @click="collapseSidebar">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[15px] h-[15px] duration-75" :class="[ isCollapsed ? 'rotate-180 peer-hover:translate-x-2' : 'rotate-0 peer-hover:-translate-x-2']">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                          </svg>                     
                    </span> 
    
    
                    <span class="text-[10px] mb-2 text-gray-200 select-none font-bold uppercase" :class="[ isCollapsed ? 'mt-24 text-center' : '']">Menu</span>
                    <ul class="space-y-2 font-medium" :class="[ isCollapsed ? 'flex flex-col' : '']">
                        <li>
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="inline-flex items-center">
                                <ChartPieIcon class="w-5 h-5" />
                                <span class="ml-2" v-show="!isCollapsed">Dashboard</span>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('department.index')" :active="route().current('department.index')" class="flex items-center">
                                <BuildingOfficeIcon class="w-5 h-5" />
                                <span class="ml-2" v-show="!isCollapsed">Departments</span>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('users.index')" :active="route().current('users.index')" class="inline-flex items-center">
                                <UserGroupIcon class="w-5 h-5" />
                                <span class="ml-2" v-show="!isCollapsed">Users</span>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('item.index')" :active="route().current('item.index')" class="flex items-center">
                                <CubeIcon class="w-5 h-5" />
                                <span class="ml-2" v-show="!isCollapsed">Items</span>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('property.index')" :active="route().current('property.index')" class="flex items-center">
                                <Square3Stack3DIcon class="w-5 h-5" />
                                <span class="ml-2" v-show="!isCollapsed">Properties</span>
                            </NavLink>
                        </li>
                        <li>
                            <Disclosure v-slot="{ open }">
                                <DisclosureButton class="flex items-center justify-between">
                                    <span>Purchases</span>
                                    <ChevronUpIcon
                                        :class="open ? 'rotate-180 transform' : ''"
                                        class="h-5 w-5 text-purple-500"
                                    />
                                </DisclosureButton>
                                <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
                                    If you're unhappy with your purchase for any reason, email us within
                                    90 days and we'll refund you in full, no questions asked.
                                  </DisclosurePanel>
                            </Disclosure>
                        </li>
                        <!-- <li>
                            <NavLink :href="route('requests.index')" :active="route().current('requests.index')" class="flex items-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clipboard2" viewBox="0 0 16 16">
                                    <path d="M3.5 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H12a.5.5 0 0 1 0-1h.5A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1H4a.5.5 0 0 1 0 1h-.5Z"/>
                                    <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                                  </svg>
                                <span class="ml-3" v-show="!isCollapsed">Item Requests</span>
                            </NavLink>
                        </li> -->
                        <!-- <li>
                            <NavLink :href="route('requests.index')" :active="route().current('requests.index')" class="flex items-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                                  </svg>
                                <span class="ml-3" v-show="!isCollapsed">Roles and Permissions</span>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('requests.index')" :active="route().current('requests.index')" class="flex items-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[20px] h-[20px]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>                                  
                                <span class="ml-3" v-show="!isCollapsed">Find Property</span>
                            </NavLink>
                        </li> -->
                    </ul>
                </div>
            </nav>
            <div class="flex-1 min-h-screen overflow-hidden">
                <div class="w-full p-4">
                    <div class="flex justify-between items-center">
                        <!-- Search -->
                        <GlobalSearchComponent />
                        
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            <!-- {{ $page.props.auth.user.name }} -->
                                            
                                            <img v-if="$page.props.auth.user.profile_photo" :src="$page.props.auth.user.profile_photo_url" class="ml-2 h-7 w-7 rounded-full" alt="">
                                            <img v-else src="../Components/images/user-icon.png" class="ml-2 h-7 w-7 rounded-full" alt="">
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <span class="block w-full px-4 py-2 leading-5 text-sm font-medium border-b text-gray-600 text-center">{{ $page.props.auth.user.name }}</span>
                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button" @click="clearLocalStorage">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                    
                </div>
                  
                <main>
                    <transition
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <slot />
                    </transition>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slide-enter-active {
    transition: all 0.1s ease-out;
}

.slide-leave-active {
    transition: all 0.1s ease-in;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateY(-20px);
}
</style>