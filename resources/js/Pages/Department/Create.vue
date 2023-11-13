<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    users: Array
})

const form = useForm({
    name: '',
    user_id: '',
})

const submit = () => {
    form.post('/departments', {
        // onFinish: () => {
        //     console.log()
        // }
    })
}

const crumbs = [
    {
        name: 'Dashboard',
        url: '/dashboard',
        active: false,
    },
    {
        name: 'Departments',
        url: '/departments',
        active: false,
    },
    {
        name: 'Create Department',
        url: null,
        active: true,
    },
    
]
</script>

<template>
    <Head title="Add Facility" />
    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h1 class="font-semibold text-2xl text-gray-700 leading-tight mb-4">Create new department</h1>

                <Breadcrumb :crumbs="crumbs" class="mb-4" />

                <hr class="mt-3 mb-3">

                <div class="bg-white w-full shadow p-6 rounded-lg">
                    <h1 class="text-xl text-gray-700 font-semibold mb-2">Department details</h1>
                    <form @submit.prevent="submit">
                        <div class="max-w-2xl mb-4">
                            <InputLabel class="text-sm" for="dept_name" value="Department Name" />
    
                            <TextInput 
                            v-model="form.name" 
                            class="w-full text-sm"
                            id="dept_name" />
    
                            <InputError :message="form.errors.name" />
                        </div>
    
                        <!-- <div class="max-w-2xl mb-4">
                            <InputLabel value="Short Description" />

                            <textarea v-model="form.description" id="description" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
    
                            <InputError :message="form.errors.description" />
                        </div> -->
    
                        <div class="max-w-2xl mb-4">
                            <InputLabel for="dept-head" class="text-sm" value="Facility Head" />
    
                            <select 
                            v-model="form.user_id"
                            class="w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            id="dept-head">
                                <option value="">Select a head</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                            </select>
    
                            <InputError :message="form.errors.user_id" />
                        </div>

                        <div>
                            <!-- <button type="submit" class="px-4 py-1.5 text-sm bg-blue-600 rounded-md text-white">Submit</button> -->
                            <PrimaryButton type="submit" :disabled="form.processing">Submit</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>