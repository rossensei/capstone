<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { PlusIcon, PencilIcon, ChevronDownIcon, ArrowRightIcon, TrashIcon } from '@heroicons/vue/24/solid';
import { MagnifyingGlassIcon, EyeIcon } from '@heroicons/vue/24/outline';
import Alert from '@/Components/Alert.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';
import { ref, watch, computed, onMounted } from 'vue';

const props = defineProps({
    departments: Object,
    filters: Object,
});

const search = ref(props.filters.search);

const clearSearch = () => {
    search.value = '';
}

watch(search, debounce( function (newSearchVal) {

    let params = {
        search: newSearchVal,
        // perPage: newPerPageVal,
    }

    // Object.keys(params).forEach(key => {
    //     if(params[key] == '' || params[key] == null) {
    //         delete params[key];
    //     }
    // });

    // console.log(params)

    router.get('/departments', params, {
        preserveState: true,
        replace: true
    });

}, 300))

const page = usePage();

const response = computed(() => page.props.flash)
</script>

<template>
    <Head title="All Departments" />

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                
                <div class="flex items-center justify-between mb-4">
                    <h1 class="font-semibold text-3xl text-gray-700 leading-tight">All Departments</h1>
                    <Link href="/departments/create" class="flex items-center justify-start px-3 py-2 rounded-lg bg-[#4e73df] hover:bg-[#7e99eb] text-white font-semibold text-sm duration-150 ease-in">
                        <PlusIcon class="w-4 h-4 stroke-white" />                                  
                        <span class="text-sm ml-1">Add Department</span>
                    </Link>
                </div>

                <Alert class="mb-4" />

                <div class="relative mb-4">
                    <MagnifyingGlassIcon class="absolute left-2 top-2 w-5 h-5 text-gray-400" />
                    <input 
                        v-model="search"
                        type="search" 
                        id="table-search-users" 
                        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Search for departments"
                    >
                </div>

                <div class="relative overflow-x-auto bg-white rounded-lg">
                        

                        <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    Facility Name
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Head
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Date Added
                                </th>
                                <th scope="col" class="px-4 py-3 text-center">
                                    Properties
                                </th>
                                <!-- <th scope="col" class="px-4 py-3 text-center">
                                    
                                </th> -->
                                <th scope="col" class="px-4 py-3 text-center">
                                    ...
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="group bg-white hover:bg-gray-50" :class="{ 'border-b' : index != departments.data.length - 1 }" v-for="(department, index) in departments.data" :key="index">
                                <td class="px-4 py-3 text-gray-700">
                                    <div class="text-sm font-medium inline-flex items-center">{{ department.name }}
                                    <!-- <p class="">(Click to view properties)</p> -->
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700 font-medium mb-4">
                                        {{ department.head }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex">
                                        02 November 2023
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <Link :href="'/departments/' + department.id + '/view-properties'" 
                                    class="inline-flex items-center px-2 py-1.5 rounded-lg bg-white hover:bg-gray-50 text-gray-600 border border-gray-300 text-sm font-medium transition-colors ease-in-out duration-300">
                                    <EyeIcon class="w-4 h-4 mr-1" />
                                    {{ department.properties_count }} properties
                                </Link>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <Link :href="'/departments/edit/' + department.id" 
                                            class="inline-flex items-center px-2 py-1.5 rounded-lg bg-[#4e73df] hover:bg-[#688dff] text-white text-sm font-medium transition-colors ease-in-out duration-300">
                                            <PencilIcon class="w-3 h-3 mr-1" />
                                            Edit
                                        </Link>
                                        <Link :href="'/departments/edit/' + department.id" 
                                            class="inline-flex items-center px-2 py-1.5 rounded-lg bg-[#EA3C53] hover:bg-[#ff5168] text-white text-sm font-medium transition-colors ease-in-out duration-300">
                                            <TrashIcon class="w-3 h-3 mr-1" />
                                            Delete
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>      
                
                <div class="flex justify-between items-center mt-4">

                    <div>
                        <!-- <label class="text-sm font-normal text-gray-700 inline-flex items-center">
                            Entries per page &nbsp;
                            <select v-model="perPage" id="perPage" class="w-18 text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                            &nbsp;&nbsp;
                            1-{{ perPage }} of {{ departments.total }} entries
                        </label> -->
                    </div>

                    <Pagination 
                    class=""
                    :links="departments.links"
                    :current_page="departments.current_page"
                    :prev_page_url="departments.prev_page_url"
                    :next_page_url="departments.next_page_url"
                    :last_page="departments.last_page"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>