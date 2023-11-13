<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const prop = defineProps({
    items: Array
})

const getCurrentPercentage = (qty) => {
    return (qty / qty) * 100;
}

const getDateFormat = (d) => {
    const date = new Date(d);

    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const day = date.getDate();
    const month = monthNames[date.getMonth()];
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
}
</script>

<template>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Item
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Qty Stock
                </th>
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
            <tr class="bg-white border-b hover:bg-gray-50" v-for="item in items" :key="item.id">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ item.name }}
                </th>
                <td class="px-6 py-4">
                    {{ item.category }}
                </td>
                <td class="px-6 py-4">
                    {{ item.qty_stock }} {{ item.unit }}
                </td>
                <td class="px-6 py-4">
                    160
                </td>
                <td class="px-6 py-4">
                    {{ item.qty_stock }} out of {{ item.qty_stock }} {{ item.unit }}
                    <div id="progress-bar" class="w-full bg-gray-200 rounded-full h-auto">
                        <div id="percentage" class="bg-green-500 rounded-full h-2" :style="{ 'width': getCurrentPercentage(item.qty_stock) + '%' }"></div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    {{ item.expiry_date ? getDateFormat(item.expiry_date) : 'N/A'}}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center space-x-2">
                        <Link :href="'/items/edit/' + item.id" class="text-sm text-white rounded-sm p-1 hover:bg-blue-500 bg-blue-600 outline outline-2 hover:outline-blue-300 duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>
                        </Link>
                        <Link :href="'/items/delete-item/' + item.id" as="button" method="DELETE" class="text-sm text-white rounded-sm p-1 hover:bg-red-500 bg-red-600 outline outline-2 hover:outline-red-300 duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                        </Link>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>