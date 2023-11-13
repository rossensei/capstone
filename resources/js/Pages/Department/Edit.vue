<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ArrowLeftIcon } from '@heroicons/vue/24/solid';

const prop = defineProps({
    department: Object,
    users: Array,
});

const form = useForm({
    name: prop.department.name,
    user_id: prop.department.user_id,
});

const submit = () => {
    form.patch('/departments/' + prop.department.id)
}

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
        name: 'Edit Department',
        url: null,
        active: true,
    },
    
]
</script>

<template>
    <Head :title="department.name" />
    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h1 class="font-semibold text-2xl text-gray-700 leading-tight mb-4">Edit department "{{ department.name }}"</h1>

                <Breadcrumb :crumbs="crumbs" class="mb-4" />

                <hr class="mt-3 mb-3">

                <div class="bg-white w-full shadow p-6 rounded-lg">
                    <h1 class="text-xl text-gray-700 font-semibold mb-2">Department details</h1>
                    <form @submit.prevent="submit">
                        <div class="max-w-2xl mb-4">
                            <InputLabel class="text-sm" value="Department Name" />
    
                            <TextInput 
                            v-model="form.name" 
                            class="w-full text-sm"
                            id="facname" />
    
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="max-w-2xl mb-4">
                            <InputLabel for="dept-head" class="text-sm" value="Department Head" />
    
                            <select
                            v-model="form.user_id"
                            class="w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name=""
                            id="dept-head">
                                <option value="">Select user</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                            </select>
    
                            <InputError :message="form.errors.user_id" />
                        </div>

                        <div class="flex justify-between max-w-2xl">
                            <Link 
                            href="/departments" 
                            class="inline-flex items-center px-3 py-2 bg-white border border-[#4e73df] rounded-lg text-sm font-medium text-[#4e73df] shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                            <ArrowLeftIcon class="w-4 h-4 mr-1 stroke-[#4e73df]" />
                            Back</Link>
                            <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg bg-[#4e73df] hover:bg-[#688dff] text-white text-sm font-medium transition-colors ease-in-out duration-300">
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>