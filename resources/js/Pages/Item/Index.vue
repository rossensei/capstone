<script setup>
import { TrashIcon } from '@heroicons/vue/24/outline';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Pagination from '@/Components/Pagination.vue';
import Alert from '@/Components/Alert.vue';
import { PencilIcon, ChevronDownIcon } from '@heroicons/vue/24/solid';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref, watch, computed, onBeforeUpdate } from 'vue';

const props = defineProps({
    items: Array,
});

const getCurrentPercentage = (qty, used) => {
    return ((qty - used) / qty) * 100;
}

const getDateFormat = (d) => {
    const date = new Date(d);

    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const day = date.getDate();
    const month = monthNames[date.getMonth()];
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
}

//handling bulk delete section
const selectedItems = ref([]);

const selectAll = ref(false);

const toggleSelectAll = () => {
    if(selectAll.value){
        selectedItems.value = props.items.map(item => item.id)
    } else {
        selectedItems.value = [];
    }
}

const deleteItems = () => {
    if(selectedItems.value.length) {
        router.delete('/items/delete-items', {
            data: {
                ids: selectedItems.value
            },
            onSuccess: () => {
                selectedItems.value = [];
            }
        });
    }
}

const showDropdown = ref(false);

const toggleActionDropdown = () => {
    showDropdown.value = !showDropdown.value
}
</script>

<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">


                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-3xl text-gray-700 leading-tight">List of Items</h2>
                    <Link href="/items/add-item" class="flex items-center justify-start px-3 py-2 rounded-lg bg-[#4e73df] hover:bg-[#7e99eb] text-white font-semibold duration-300 ease-in">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                          </svg>                                                                           
                        <span class="text-sm ml-1 font-semibold">Add Item</span>
                    </Link>
                </div>
                <Alert class="mb-4" />


                <!-- <Alert v-show="(flash.success || flash.error) && show" :message="flash" @close="closeAlert" class="mb-4" /> -->

                <div class="relative overflow-x-auto bg-white shadow rounded-lg border">
                    <!-- <div class="flex items-center justify-end p-4 bg-gray-50">
                        <Link href="/items/add-item" class="flex items-center px-2 py-2 rounded-md bg-[#4e73df] hover:bg-[#4e72dfc0] text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                              </svg>                                                                           
                            <span class="text-sm ml-1">Add Item</span>
                        </Link>
                    </div>

                    <hr> -->
                    <div class="p-4">


                        <div class="flex items-center justify-between mb-4">

                            <!-- <button type="button" @click="deleteItems" class="inline-flex items-center px-2 py-2 rounded-md border border-red-600 text-red-600 hover:bg-red-500 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg> -->
                            
                            <!-- </button> -->

                            <div class="flex items-center space-x-2">
                                <span v-if="selectedItems.length != 0" class="text-sm font-medium text-blue-700 ml-1">{{selectedItems.length}} item(s) selected</span>

                                <button type="button" @click="deleteItems"
                                class="inline-flex items-center px-2 py-2 rounded-md tracking-wide uppercase text-xs font-semibold"
                                :class="[!selectedItems.length ? 'text-gray-400 bg-gray-50' : 'bg-gray-50 hover:bg-red-100 text-red-600']">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Delete
                                </button>

                                <button type="button" 
                                class="inline-flex items-center px-2 py-2 rounded-md tracking-wide uppercase text-xs font-semibold"
                                :class="[!selectedItems.length ? 'text-gray-400 bg-gray-50' : 'bg-gray-50 hover:bg-blue-100 text-blue-600']">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                    <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                  </svg>
                                  
                                        Edit
                                </button>

                            </div>
                            
                            <div class="flex space-x-2">
                                

                                <label for="search" class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="table-search-users" 
                                        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        placeholder="Search for items">
                                        <span class="absolute right-2 top-3" @click="clearSearch">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                              </svg>                                      
                                        </span>
                                </label>
                                
                            </div>
                        </div>
                        
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input v-model="selectAll" @change="toggleSelectAll" id="select-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="select-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <!-- <th scope="col" class="px-6 py-3">
                                        Qty Stock
                                    </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        Used
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Available
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Expiry Date
                                    </th>
                                    <th scope="col" class="px-6 py-3  text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b bg-white hover:bg-gray-50" v-for="item in items" :key="item.id" :class="{'border-l-4 border-l-blue-600' : selectedItems.includes(item.id)}">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input v-model="selectedItems" :id="'checkbox-' + item.id" :value="item.id" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label :for="'checkbox-' + item.id" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ item.name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ item.category.cat_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.used }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.curr_stocks - item.used }} out of {{ item.init_qty }} {{ item.unit.abbreviation }}
                                        <div id="progress-bar" class="w-full bg-gray-200 rounded-full h-auto">
                                            <div id="percentage" class="bg-green-500 rounded-full h-2" :style="{ 'width': getCurrentPercentage(item.curr_stocks, item.used) + '%' }"></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.expiry_date ? getDateFormat(item.expiry_date) : 'N/A'}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <Link :href="'/items/edit/' + item.id" class="inline-flex items-center text-xs font-semibold tracking-wide text-blue-600 uppercase rounded-sm px-2 py-1.5 hover:text-blue-600 hover:bg-blue-100 duration-300 ease-in-out">
                                                <PencilIcon class="w-4 h-4 mr-1" />
                                                Edit
                                            </Link>
                                            <Link :href="'/items/delete-item/' + item.id" as="button" method="DELETE" class="inline-flex items-center text-xs font-semibold text-red-600 uppercase rounded-sm px-2 py-1.5 hover:bg-red-100 duration-300 ease-in-out">
                                                  <TrashIcon class="w-[14px] h-[14px] mr-1" />
                                                  Delete
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Paginator -->
                        <!-- <Pagination 
                        v-show="users" 
                        :links="users.links"
                        :current_page="users.current_page"
                        :prev_page_url="users.prev_page_url"
                        :next_page_url="users.next_page_url"
                        :last_page="users.last_page"
                        class="mt-4"/> -->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
