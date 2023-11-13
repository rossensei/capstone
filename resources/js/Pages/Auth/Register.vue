<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import BreadCrumb from '@/Components/Breadcrumb.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    roles: Array,
})

const form = useForm({
    user: '',
    fname: '',
    lname: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),    
        onSuccess: () => form.reset()
    });
};

const links = computed(() => {
    return [
        {
            label: 'Users',
            url: '/users'
        },
        {
            label: 'Add User',
            url: null
        }
    ]
})
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Register" />

        <template #header>
            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2> -->
            <BreadCrumb :links="links" />
        </template>

        <div class="py-12">
            <div class="flex space-x-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            

                            <div class="flex w-full space-x-2">
                                <div class="w-full">
                                    <InputLabel for="fname" value="First Name" />
                    
                                    <TextInput
                                        id="fname"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.fname"
                                        autocomplete="fname"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.fname" />
                                </div>
    
                                <div class="w-full">
                                    <InputLabel for="lname" value="Last Name" />
                    
                                    <TextInput
                                        id="lname"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.lname"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.lname" />
                                </div>
    
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />
                
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    autocomplete="username"
                                />
                
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <hr class="mt-4 mb-3">

                            <div>
                                <InputLabel for="username" value="User" />
                
                                <TextInput
                                    id="username"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.user"
                                />
                
                                <InputError class="mt-2" :message="form.errors.user" />
                            </div>
                
                            <div class="mt-4">
                                <InputLabel for="password" value="Password" />
                
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                    autocomplete="new-password"
                                />
                
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                
                            <div class="mt-4">
                                <InputLabel for="password_confirmation" value="Confirm Password" />
                
                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password_confirmation"
                                    autocomplete="new-password"
                                />
                
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>
                
                            <div class="flex items-center justify-end mt-4">                
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Register
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h4 class="text-xl text-gray-600 text-center font-bold mb-3">Create User</h4>
                     <CreateUserVector></CreateUserVector>
                </div>
            </div>
        </div>

        
    </AuthenticatedLayout>
</template>
