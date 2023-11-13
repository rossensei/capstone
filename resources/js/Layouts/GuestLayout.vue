<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount, computed} from 'vue';


const screenWidth = ref(window.innerWidth);

const isSmallScreen = computed(() => {
    return screenWidth.value <= 768;
});

const handleResize = () => {
    screenWidth.value = window.innerWidth;
}

onMounted(() => {
    window.addEventListener('resize', handleResize)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize)
})
</script>

<template>
    <div class="min-h-screen w-full relative overflow-hidden z-10">
        <div v-if="!isSmallScreen">
            <img src="../Components/images/mdc-background.jpg" alt="mdc-background" class="object-cover z-0 w-full h-full fixed">

            <div class="z-20 absolute top-0 min-h-screen w-full bg-gradient-to-t bg-black opacity-40"></div>
            <div class="z-30 absolute top-0 h-full w-full">
                <div class="flex justify-center items-center w-full h-full">
                    <Transition name="slide-up">
                        <div class="w-5/6 lg:w-1/2 xl:w-1/3 flex flex-col mx-auto bg-white p-6 rounded-lg">
                            <img src="../Components/images/mdc-logo.png" alt="" class="w-32 mx-auto mb-3">
                            <h1 class="text-2xl uppercase font-bold font-sans text-center text-gray-500 mb-4">wELCOME BACK!</h1>
            
                            <slot />
                        </div>
                    </Transition>
                </div>
            </div>

            <!-- <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#0099ff" fill-opacity="1" d="M0,224L48,192C96,160,192,96,288,101.3C384,107,480,181,576,181.3C672,181,768,107,864,117.3C960,128,1056,224,1152,261.3C1248,299,1344,277,1392,266.7L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                </svg>
            </div> -->
        </div>
        
        <!-- tablet and smaller screens login page -->
        <div v-else>
            <img src="../Components/images/mdc-background.jpg" alt="mdc-background" class="object-cover z-0 w-full h-[300px] fixed">
            <div class="z-20 absolute top-0 h-[300px] w-full bg-gradient-to-t from-gray-900 from-20% opacity-50"></div>
            <div class="z-30 absolute top-0 min-h-screen w-full flex flex-col justify-end">
                <!-- <img src="../Components/images/mdc-logo.png" alt="" class="w-32 mx-auto mb-3">
                <h1 class="z-20 text-5xl uppercase font-extrabold font-sans text-center text-white mb-4">MDC-IMS</h1>

                <div class="flex flex-col mx-auto bg-white p-6 rounded-lg sm:w-9/12 w-11/12 shadow-sm border">
                    
                    <h1 class="text-2xl uppercase font-bold font-sans text-center text-gray-500 mb-4">WELCOME BACK!</h1>
    
                    <slot />
                </div> -->

                <div class="bg-white rounded-t-[50px] h-[650px] py-6 border">
                    
                    <!-- <div class="w-full flex justify-center items-center">
                        <LoginVector class="w-[250px]" />
                    </div> -->
                    <img src="../Components/images/mdc-logo.png" class="w-32 mx-auto mb-3">
                    <div class="flex flex-col rounded-lg px-20 sm:">
                        <h1 class="text-2xl uppercase font-bold font-sans text-center text-gray-500 mb-4">LOGIN TO CONTINUE</h1>
        
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
