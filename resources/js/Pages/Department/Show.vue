<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Pagination from '@/Components/Pagination.vue';
import { TrashIcon } from '@heroicons/vue/24/outline'
import { Head } from '@inertiajs/vue3';

const prop = defineProps({
    department: Object,
    properties: Object
})

const crumbs = [
    {
        name: 'Dashboard',
        url: '/dashboard',
        active: false,
    },
    {
        name: 'Department',
        url: '/departments',
        active: false,
    },
    {
        name: prop.department.name + "'s properties",
        url: null,
        active: true,
    },
]
</script>

<template>
    <Head :title="department.name" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h1 class="text-2xl text-gray-500 font-semibold">View Department</h1>
        </template> -->
        <div class="py-6">
            <div class="w-full sm:px-6 lg:px-8">

                    <h1 class="text-2xl text-gray-700 font-semibold mb-4">{{ department.name }}</h1>

                <Breadcrumb :crumbs="crumbs" class="mb-4" />


                <!-- <h4 class="text-lg font-medium text-gray-500">List of properties</h4>
                <p class="text-base font-medium text-gray-600 mb-2">Office Head: {{ prop.facility.user.fname }} {{ prop.facility.user.lname }}</p> -->
                
                <div class="relative overflow-x-auto bg-white shadow rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center justify-between bg-white mb-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input 
                                    v-model="search"
                                    type="text" 
                                    id="table-search-users" 
                                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Search for facilities">
                                    <span v-show="search" class="absolute right-2 top-3" @click="clearSearch">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                          </svg>                                      
                                    </span>
                            </div>
                        </div>

                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="w-32 px-6 py-3">
                                        Tag No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Acquisition Date
                                    </th>
                                    <!-- <th scope="col" class="w-56 px-6 py-3 text-center">
                                        Remarks
                                    </th> -->
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b hover:bg-gray-50" v-for="(item, index) in properties" :key="index">
                                    <td class="flex items-center px-6 py-4 text-gray-700 whitespace-nowrap">
                                        <div class="text-sm font-medium">#{{ item.tag_no }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-700 font-medium">
                                            {{ item.name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                            {{ item.description }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                            {{ item.date_acquired }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                            {{ item.status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <Link :href="'/facilities/remove-facility/' + item.id" as="button" method="DELETE" class="inline-flex items-center text-xs font-semibold text-red-600 uppercase rounded-sm px-2 py-1.5 hover:bg-red-100 duration-300 ease-in-out">
                                                <TrashIcon class="w-[14px] h-[14px] mr-1" />
                                                Delete
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination 
                        class="mt-4"
                        :links="properties.links"
                        :current_page="properties.current_page"
                        :prev_page_url="properties.prev_page_url"
                        :next_page_url="properties.next_page_url"
                        :last_page="properties.last_page"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>