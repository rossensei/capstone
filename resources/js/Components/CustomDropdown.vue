<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    options: Array
});

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const open = ref(false);

const selectedOption = ref('')

function toggleOptionSelect(option) {
    selectedOption.value = option;
}
</script>

<template>
    <div class="relative">
        <div id="selectedOption" class="px-4 py-1.5 border rounded-sm" @click="open = !open">
            {{ selectedOption }}
        </div>

        <ul v-show="open" class="list-none">
            <li v-for="(option, index) in options" :key="index" @click="toggleOptionSelect(option)">{{ option.name }}</li>
        </ul>
    </div>
</template>
