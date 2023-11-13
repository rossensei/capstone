<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    prev_page_url: String,
    next_page_url: String,
    last_page: Number,
    current_page: Number,
    links: Array
})
</script>

<template>
    <nav>


          <!-- Paginator -->
          <div class="flex items-center space-x-1">
              <!-- Previous Button -->
              <Link v-if="current_page > 1" :href="prev_page_url" class="h-[30px] w-[30px] bg-white flex items-center justify-center rounded-md text-sm text-gray-400 shadow hover:bg-blue-600 hover:text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                </Link>
              <span v-else class="h-[30px] w-[30px] flex items-center justify-center rounded-md text-sm text-gray-400 shadow">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                </span>

              <!-- Links -->
              <template v-for="(link, index) in links" :key="index">     
                      <Link 
                      v-if="index !== 0 && index !== links.length-1" 
                      :href="link.url" 
                      class="h-[30px] w-[30px] flex items-center justify-center rounded-md font-medium text-sm text-gray-400 hover:bg-blue-600 hover:text-white shadow"
                      :class="{'bg-blue-600 text-white' : link.active, 'bg-white' : !link.active}"
                      >{{ link.label }}</Link>
              </template>

              <!-- Next Button -->
              <Link v-if="current_page < last_page" :href="next_page_url" class="h-[30px] w-[30px] flex items-center justify-center rounded-md text-sm text-gray-400 shadow hover:bg-blue-600 hover:text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                </Link>
              <span v-else class="h-[30px] w-[30px] flex items-center justify-center rounded-md text-sm text-gray-400 shadow">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                </span>
          </div>
    </nav>
</template>