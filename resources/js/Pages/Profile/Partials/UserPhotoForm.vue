<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { PencilIcon } from '@heroicons/vue/24/solid';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const editMode = ref(false);
const photoInput = ref(null);
const photoPreview = ref(null);

function selectNewPhoto() {
    photoInput.value.click();
};

function updatePhotoPreview() {
    const photo = photoInput.value.files[0];

    // const photo = event.target.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        const img = new Image();

        img.onload = () => {
            const aspectRatio = img.width / img.height;
            if(aspectRatio == 1) {
                photoPreview.value = e.target.result;
            } else {
                alert('Only photos with 1:1 aspect ratio is accepted!')
            }
        }
        img.src = e.target.result;   


        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};
</script>

<template>
    <div>
        <header>
            <h1 class="text-xl font-semibold text-gray-600">Avatar</h1>
        </header>
        <div class="flex items-center">
            <div v-show="!photoPreview">
                <img 
                    v-if="page.props.auth.user.profile_photo_url" 
                    :src="page.props.auth.user.profile_photo_url" 
                    class="w-44 rounded-full mt-5" 
                    :alt="page.props.auth.user.name"
                >

                <img 
                    v-else 
                    src="../../../Components/images/user-icon.png" 
                    class="w-44 rounded-full mt-5" 
                    :alt="page.props.auth.user.name"
                >
            </div>
            <div v-show="photoPreview">
                <img 
                    :src="photoPreview" 
                    class="w-44 rounded-full mt-5" 
                    :alt="page.props.auth.user.name"
                >
            </div>
            <div v-if="editMode">
                <PrimaryButton type="button" @click="selectNewPhoto">Select Photo</PrimaryButton>
                <input 
                    ref="photoInput" 
                    type="file" 
                    class="hidden" 
                    @change="updatePhotoPreview"
                >

                <DangerButton type="button" @click="deletePhoto">Remove Photo</DangerButton>
            </div>

            <div v-if="!editMode" class="ml-5">
                <button 
                type="button" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md" 
                @click="editMode = true;">
                <PencilIcon class="w-3 h-3 mr-1"/>
                Edit</button>
            </div>
        </div>
    </div>
</template>