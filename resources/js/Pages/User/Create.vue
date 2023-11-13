<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ArrowLeftIcon } from '@heroicons/vue/24/solid';

defineProps({
    roles: Array
})
const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
})

const submit = () => {
    form.post('/users')
}

const crumbs = [
    {
        name: 'Dashboard',
        url: '/dashboard',
        active: false,
    },
    {
        name: 'Users',
        url: '/users',
        active: false,
    },
    {
        name: 'Create New User',
        url: null,
        active: true,
    },
]
</script>

<template>
    <Head title="Create User"/>

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h1 class="font-semibold text-2xl text-gray-700 leading-tight mb-4">Creating a new user</h1>

                <Breadcrumb :crumbs="crumbs" class="mb-4" />
                <hr class="mb-4">


                <div class="p-4">
                    <h2 class="text-lg font-medium text-gray-600 mb-4">User Details</h2>
                    <form @submit.prevent="submit">
                        <div class="max-w-3xl flex items-center mt-2">
                            <div class="w-40">
                                <InputLabel for="name" value="Name" />
                            </div>
                            <div class="flex-1">
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="block w-full text-sm"
                                    v-model="form.name"
                                    autocomplete="name"
                                    placeholder="Full Name"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>
                        <div class="max-w-3xl flex items-center mt-2">
                            <div class="w-40">
                                <InputLabel for="email" value="Email address" />
                            </div>
                            <div class="flex-1">
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="block w-full text-sm"
                                    v-model="form.email"
                                    autocomplete="username"
                                    placeholder="Email address"
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                        </div>
                        <div class="max-w-3xl flex items-center mt-2">
                            <div class="w-40">
                                <InputLabel for="username" value="Username" />
                            </div>
                            <div class="flex-1">
                                <TextInput
                                    id="username"
                                    type="text"
                                    class="block w-full text-sm"
                                    v-model="form.username"
                                    autocomplete="username"
                                    placeholder="Username"
                                />
                                <InputError class="mt-2" :message="form.errors.username" />
                            </div>
                        </div>
                        <div class="max-w-3xl flex items-center mt-2">
                            <div class="w-40">
                                <InputLabel for="password" value="Password" />
                            </div>
                            <div class="flex-1">
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="block w-full text-sm"
                                    v-model="form.password"
                                    placeholder="Password"
                                />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                        </div>
                        <div class="max-w-3xl flex items-center mt-2">
                            <div class="w-40">
                                <InputLabel for="password_confirmation" value="Confirm Password" />
                            </div>
                            <div class="flex-1">
                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="block w-full text-sm"
                                    v-model="form.password_confirmation"
                                    placeholder="Confirm Password"
                                />
                            </div>
                        </div>
                        <div class="max-w-3xl flex items-center mt-2">
                            <div class="w-40">
                                <InputLabel for="role" value="Role" />
                            </div>
                            <div class="flex-1">
                                <select v-model="form.role" id="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm w-full">
                                    <option value="">Select role</option>
                                    <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                                </select>
    
                                <InputError class="mt-2" :message="form.errors.role" />
                            </div>
                        </div>


                        <div class="max-w-3xl flex items-center justify-end mt-5">
                            <Link href="/users" class="inline-flex items-center px-4 py-1.5 rounded-md text-sm text-white bg-gray-500 hover:bg-gray-400 shadow-md mr-2">
                                <ArrowLeftIcon class="w-4 h-4 mr-1"/>
                                Back
                            </Link>
                            <button type="submit" class="px-4 py-1.5 rounded-md text-sm flex items-center text-white bg-blue-600 hover:bg-blue-500 shadow-md" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>