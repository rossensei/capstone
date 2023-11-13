<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    password: '',
    password_confirmation: '',
});

const props = defineProps({
    user: Number
})

const updatePassword = () => {
    form.patch('/users/update-password/' + props.user , {
        preserveScroll: true,
        onSuccess: () => form.reset()
    });
};
</script>

<template>
    <section>
        <h2 class="text-lg font-semibold text-gray-600 flex items-center">Set a new password </h2>
        <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
        >
            <p v-if="form.recentlySuccessful" class="text-sm text-green-500">A new password has been set for this user.</p>
        </Transition>
        <!-- <header>

            <p class="mt-1 text-sm text-gray-600">
                Set only a new password when it is forgotten.
            </p>
        </header> -->

        <form @submit.prevent="updatePassword" class="mt-2">  
            <div class="w-full lg:max-w-xl">
                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-3 block w-full text-sm"
                    autocomplete="new-password"
                    placeholder="New Password"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="w-full lg:max-w-xl">
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-3 block w-full text-sm"
                    autocomplete="new-password"
                    placeholder="Confirm New Password"
                />

                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div v-show="form.password || form.password_confirmation">
                <button 
                    type="submit" 
                    class="px-4 py-1.5 rounded-md text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 shadow-md mt-3"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</button>
            </div>
        </form>
    </section>
</template>