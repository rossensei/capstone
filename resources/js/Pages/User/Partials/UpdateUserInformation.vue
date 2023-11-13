<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { InformationCircleIcon } from '@heroicons/vue/24/outline';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    user: Object
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    username: props.user.username,
});

const submit = () => {
    form.patch('/users/' + props.user.id, {
        preserveScroll: true,
        // onSuccess: () => form.reset()
    });
};
</script>

<template>
    <section class="w-full">
        <h2 class="text-xl font-semibold text-gray-600 flex items-center">User Details
            <InformationCircleIcon class="w-5 h-5 ml-2" />
        </h2>
        
        <form @submit.prevent="submit">
            <div  class="mt-2 space-y-2">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full text-sm"
                    />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="username" value="Username" />

                    <TextInput
                        id="username"
                        v-model="form.username"
                        type="text"
                        class="mt-1 block w-full text-sm"
                    />

                    <InputError :message="form.errors.username" class="mt-2" />
                </div>
                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-full text-sm"
                    />

                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div>
                    <button 
                    type="submit" 
                    class="px-4 py-1.5 rounded-md text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 shadow-md mt-3"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</button>
                </div>
            </div>
        </form>
    </section>
</template>