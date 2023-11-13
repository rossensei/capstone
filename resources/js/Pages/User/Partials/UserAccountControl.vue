<script setup>
import { MinusCircleIcon, CheckCircleIcon } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';

const prop = defineProps({
    user: Object
})

const toggleActive = () => {
    router.visit('/users/toggle-active/' + prop.user.id, {
        method: 'POST',
        preserveScroll: true
    });
}
</script>

<template>
    <section>
        <h2 class="text-lg font-semibold text-gray-600 flex items-center">User Account Control
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Deactivate this user if no longer part of the organization.
        </p>

        <div class="mt-6">
            <button v-if="user.active" @click="toggleActive" class="px-4 py-1.5 rounded-md text-sm flex items-center text-white font-medium bg-red-600 hover:bg-red-500 shadow-md">
                <MinusCircleIcon class="w-5 h-5 mr-1" /> Deactivate</button>
            <button v-else @click="toggleActive" class="px-4 py-1.5 rounded-md text-sm flex items-center text-white bg-green-600 hover:bg-green-500 shadow-md">
                <CheckCircleIcon class="w-5 h-5 mr-1" /> Reactivate</button>
        </div>
    </section>
</template>