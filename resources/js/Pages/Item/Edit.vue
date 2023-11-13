<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import ItemsTable from '@/Pages/Item/Partials/ItemsTable.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';

const props = defineProps({
    categories: Array,
    units: Array,
    item: Object,
});

const crumbs = [
    {
        name: 'Dashboard',
        url: '/dashboard',
        active: false
    },
    {
        name: 'Items',
        url: '/items',
        active: false
    },
    {
        name: 'Edit',
        url: null,
        active: true
    },
]

const form = useForm({
    name: props.item.name,
    category_id: props.item.category_id,
    qty_stock: props.item.qty_stock,
    unit_id: props.item.unit_id,
    expiry_date: props.item.expiry_date,
});

const submit = () => {
    form.put('/items/' + props.item.id);
}
</script>

<template>
    <Head title="Add Item" />

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h2 class="font-semibold text-3xl text-gray-700 leading-tight mb-4">Edit an Item</h2>

                <Breadcrumb :crumbs="crumbs" class="mb-4"/>

                <div class="bg-white shadow rounded-md">
                    <div class="p-4">
                        <h4 class="text-lg text-gray-700 font-semibold mb-2">Item Details</h4>
                        <div class="py-2 max-w-2xl">
                            <form @submit.prevent="submit">
                                <div class="mb-4">
                                    <label for="item_name" class="block font-medium text-sm text-gray-700">Item name</label>
                                    <input v-model="form.name" type="text" id="item_name" 
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    :class="{'border-red-600' : form.errors.name}">
                                    <InputError :message="form.errors.name" />
                                </div>
    
                                <div class="mb-4 w-1/2">
                                    <label for="category" class="block font-medium text-sm text-gray-700">Category</label>
                                    <select v-model="form.category_id" id="category" 
                                    :class="{'border-red-600' : form.errors.category_id}"
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">Select Category</option>
                                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.cat_name }}</option>
                                    </select>
                                    <InputError :message="form.errors.category_id" />
                                </div>
    
                                <div class="mb-4 w-1/2">
                                    <div class="flex items-center justify-between w-full">
    
                                        <div class="w-40">
                                            <label for="qty" class="block font-medium text-sm text-gray-700">Quantity Stock</label>
                                            <input v-model="form.qty_stock" type="number" id="qty" 
                                            :class="{'border-red-600' : form.errors.qty_stock}"
                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <InputError :message="form.errors.qty_stock" />
                                        </div>
    
                                        <div class="w-40">
                                            <label for="unit" class="block font-medium text-sm text-gray-700">Unit</label>
                                            <select v-model="form.unit_id" id="unit" 
                                            :class="{'border-red-600' : form.errors.unit_id}"
                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="">Select Unit</option>
                                                <option v-for="unit in units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>
                                            </select>
                                            <InputError :message="form.errors.unit_id" />
                                        </div>
                                    </div>
                                </div>
    
                                <div class="mb-4">
                                    <label for="exp_date" class="block font-medium text-sm text-gray-700">Expiration Date</label>
                                    <input v-model="form.expiry_date" type="date" id="exp_date" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <span class="font-medium text-xs text-gray-700">Enter the expiration date if the item expires, leave this field empty otherwise.</span>
                                </div>
    
                                <button type="submit" class="px-3 py-1.5 text-sm rounded-md bg-[#4e73df] hover:bg-[#4e72dfc0] text-white" :disabled="form.processing">Save Changes</button>
                                <Link :href="'/items/delete-item/' + props.item.id" method="DELETE" as="button" class="ml-3 px-3 py-1.5 text-sm rounded-md bg-red-600 hover:bg-red-500 text-white" :disabled="form.processing">Delete Item</Link>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
