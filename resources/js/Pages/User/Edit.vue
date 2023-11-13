<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateUserInformation from './Partials/UpdateUserInformation.vue';
import ChangePasswordForm from './Partials/ChangePasswordForm.vue';
import ChangeUserRole from './Partials/ChangeUserRole.vue';
import UserAccountControl from './Partials/UserAccountControl.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { ShieldCheckIcon } from '@heroicons/vue/24/outline'
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    user: Object,
    roles: Array
})

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
        name: 'Edit User',
        url: null,
        active: true,
    },
]

const showChangePasswordForm = ref(false);
</script>

<template>
    <Head :title="user.name "/>

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                
                <h1 class="font-semibold text-2xl text-gray-700 leading-tight mb-4">Editing {{ user.name }}'s Information</h1>
                
                <Breadcrumb :crumbs="crumbs"/>

                <hr class="mt-3 mb-3">

                <div class="flex items-start lg:space-x-4 p-4 flex-wrap">

                    <div class="w-full lg:w-1/2">
                        <UpdateUserInformation :user="user" class="mb-8 w-full lg:max-w-xl" />

                        <label for="toggle-change-password" class="text-sm">
                            <input v-model="showChangePasswordForm" type="checkbox" id="toggle-change-password" class="rounded-sm">
                            Set a new password for this user.
                        </label>
                        
                        <ChangePasswordForm v-if="showChangePasswordForm" :user="user.id" class="mt-3" />
                    </div>

                    <div class="w-full lg:flex-1 mt-8 lg:mt-0">
                        <h1 class="text-xl font-semibold text-gray-600 inline-flex items-center">Administrative Actions
                            <ShieldCheckIcon class="w-5 h-5 ml-2"/>
                        </h1>
    
                        <ChangeUserRole :user="user" :roles="roles" class="mb-4 mt-4" />
    
                        <UserAccountControl :user="user" class="max-w-xl" />
    
                        
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>