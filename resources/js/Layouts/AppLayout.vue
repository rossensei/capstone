<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const navItems = ref({
    name: 'Dashboard',
    active: route().current('test'),
})

console.log(navItems.value)

</script>

<template>
    <div>
        <div class="flex items-start min-h-screen bg-gray-100">
            <div class="hidden sm:block sticky top-0 z-10 bg-[#4e73df] min-h-screen border-r duration-300 py-4" :class="[ !isCollapsed ? 'w-64' : 'w-16' ]">
                <div class="px-4 mb-4">
                    <Link :href="route('dashboard')" class="w-full flex items-center space-x-2">
                        <img src="../Components/images/mdc-logo.png" alt="mdc-logo" class="w-[40px]">
                        <span class="text-lg text-white font-extrabold text-center">MDC-IMS</span>
                    </Link>
                </div>

                <nav class="">
                    <span class="text-xs font-semibold text-gray-100 uppercase tracking-wide ml-2">Main</span>
                    <div>
                        <ul>
                            <li>
                                <Link href="/test" class="border-l-4 py-3 inline-flex items-center w-full px-2 font-medium" :class="[ route().current('test') ? 'border-white text-white bg-[#7290e8]' : 'border-[#4e73df]']">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-1">
                                        <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                                      </svg>                                      
                                    Dashboard
                                </Link>
                            </li>
                            <li>
                                <Link href="/users" class="border-l-4 py-3 inline-flex items-center w-full px-2 font-medium" :class="[ route().current('users.index') ? 'border-white text-white' : 'border-[#4e73df]']">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-1">
                                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                                        <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                      </svg>                                      
                                    User
                                </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="flex-1 min-h-screen overflow-hidden">
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>