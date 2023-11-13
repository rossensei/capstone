<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const prop = defineProps({
    user: Object,
    roles: Array
})

const form = useForm({
    role: prop.user.roles[0]?.name,
});

const updateRole = () => {
    form.patch('/users/update-role/' + prop.user.id);
};
</script>

<template>
    <section>
        <div>
            <h2 class="text-lg font-semibold text-gray-600 flex items-center">User Role</h2>
            <!-- <div class="p-2 border text-sm font-normal bg-white text-gray-600 rounded-md mt-1 opacity-75 max-w-xl">
                {{ prop.user.roles[0]?.name }}
            </div> -->
        </div>

        <form @submit.prevent="updateRole" class="space-y-6">
            <div class="">
                <select v-model="form.role" name="role" id="role" class="px-4 py-2 rounded-md text-sm border-gray-300 w-52">
                    <option value="" disabled>Select Role</option>
                    <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <button 
                    type="submit" 
                    class="px-4 py-1.5 rounded-md text-sm font-medium flex items-center text-white bg-blue-600 hover:bg-blue-500 shadow-md"
                    :disabled="form.processing"
                >Save</button>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-green-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>