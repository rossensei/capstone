<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// defineProps({
//     canResetPassword: {
//         type: Boolean,
//     },
//     status: {
//         type: String,
//     },
// });

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <!-- <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div> -->

        <form @submit.prevent="submit">
            <div>
                <label for="username" class="relative text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill absolute left-2 top-2" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                        <TextInput
                            id="username"
                            type="text"
                            class="mt-1 block w-full pl-10 text-gray-600"
                            v-model="form.username"
                            placeholder="Username"
                            autofocus
                            autocomplete="username"
                        />
                </label>
                    
                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="mt-4">

                    <label for="password" class="relative text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="24px" height="24px" class="absolute left-2 top-2">
                            <g fill="#9ca3af" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M6.5625,5.01367c-4.10293,0.25319 -7.24977,4.03997 -6.43164,8.35547c0.522,2.755 2.744,4.978 5.5,5.5c3.74715,0.71038 7.08927,-1.57035 8.07227,-4.86914h4.29688v1c0,1.105 0.895,2 2,2c1.105,0 2,-0.895 2,-2v-1c1.105,0 2,-0.895 2,-2c0,-1.105 -0.895,-2 -2,-2h-8.30078c-0.71979,-2.45675 -2.78972,-4.38798 -5.33008,-4.86914c-0.61637,-0.11688 -1.22051,-0.15336 -1.80664,-0.11719zM7,9c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3z"/></g></g>
                        </svg>

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full pl-10 text-gray-600"
                            v-model="form.password"
                            placeholder="Password"
                            autocomplete="current-password"
                        />
                    </label>
                    
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <!-- <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton> -->

                <button 
                type="submit" 
                class="space-x-1 px-2 py-2 rounded-md bg-[#4e73df] hover:bg-[#4e72dfc0] text-white w-full text-center" 
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Login</button>
            </div>
        </form>
    </GuestLayout>
</template>
