<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const input = ref('');

const search = (ev) => {
    // router.visit('/search/' + ev.target.value)
    console.log(ev.target.value)
}

const handleSearchClick = () => {
    // must use if statement to prevent empty string search
    if(input.value != ''){
        console.log(input.value);
    }
}
</script>

<template>
    <label for="search" class="relative ml-10 flex items-center">
        <span class="absolute left-2 top-2 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
              </svg>                                  
        </span>
        <input 
            v-model="input"
            type="search" 
            id="search" 
            class="pl-8 py-2 rounded-l-lg w-[300px] border-gray-300 text-sm focus:mr-[1px]"
            placeholder="Search.."
            @keyup.enter="search($event)"
        >
        <button 
            type="button" 
            class="py-2 px-3.5 rounded-r-lg border-y border-r bg-gray-200 border-gray-300 text-gray-500 text-sm" 
            @click="handleSearchClick()
        ">Search</button>
    </label>
</template>