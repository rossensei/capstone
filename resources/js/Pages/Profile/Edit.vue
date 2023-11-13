<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
// import UserPhotoForm from './Partials/UserPhotoForm.vue';
import UserPhotoForm from '@/Pages/Profile/Partials/UserPhotoForm.vue';

import { Head } from '@inertiajs/vue3';

// defineProps({
//     mustVerifyEmail: {
//         type: Boolean,
//     },
//     status: {
//         type: String,
//     },
// });

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h1 class="font-semibold text-3xl text-gray-700 leading-tight">Account</h1>
                <p class="text-md font-normal text-gray-600">Manage your account's profile information.</p>
                <div class="p-4 sm:p-8 mb-4 sm:rounded-lg">

                    <UserPhotoForm />
                    <!-- <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    /> -->
                </div>
                <hr>
                <div class="p-4 sm:p-8 mt-4 sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <hr>

                <div class="p-4 sm:p-8 mb-4 sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <!-- <div class="p-4 sm:p-8 mb-4 sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
