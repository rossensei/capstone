<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    users: Array
})


const formatTimestampToDate = (timestamp) => {
    const date = new Date(timestamp);

    const options = {
        year: 'numeric',
        month: 'long', // or 'short' or 'numeric' depending on your preference
        day: 'numeric',
    };

    return date.toLocaleDateString(undefined, options);
}
</script>

<template>
    <table class="bordered-table">
        <thead>
            <th>#</th>
            <th>User</th>
            <th>Joined</th>
            <th>Active</th>
            <th>Role</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>
                      {{ user.id }}
                </td>
                <td>
                    <div class="flex items-center whitespace-nowrap w-full">
                        <div>
                            <img v-if="user.profile_photo" :src="user.profile_photo_url" alt="user_photo" class="w-10 h-10 rounded-full">
                            <img v-else src="../Components/images/user-icon.png" class="w-10 h-10 rounded-full" alt="">
                        </div>
                        <div class="pl-3">
                            <div class="text-base font-semibold">{{ user.fname }} {{ user.lname }}</div>
                            <div class="font-normal text-gray-500">{{ user.email }}</div>
                        </div> 
                    </div>
                </td>
                <td class="text-center text-gray-900 text-sm">
                      {{ formatTimestampToDate(user.created_at) }}
                </td>
                <td class="text-center text-sm">
                    <div class="flex justify-center">
                        <span v-if="user.active" class="text-green-600 font-extrabold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>                          
                        </span>
                        <span v-else class="text-red-600 font-extrabold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                              </svg>                          
                        </span>
                    </div>
                </td>
                <td class="text-center">
                    <div v-if="user.roles.length">
                        <span 
                            v-for="role in user.roles" 
                            :key="role.id" 
                            v-html="role.name" 
                            class="px-3 py-1.5 text-xs rounded-lg"
                            :class="{
                                'bg-indigo-100 text-indigo-600 uppercase tracking-wide font-semibold' : role.name == 'admin',
                                'bg-green-100 text-green-600 uppercase tracking-wide font-semibold' : role.name == 'faculty',
                            }"
                        ></span>
                    </div>
                </td>
                <td>
                    <div class="flex items-center justify-center space-x-2">
                        <Link :href="'/users/edit/' + user.id" class="text-sm text-white rounded-sm p-1 hover:bg-blue-500 bg-blue-600 outline outline-2 hover:outline-blue-300 duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>
                        </Link>
                        <Link :href="'/users/delete/' + user.id" as="button" method="DELETE" class="text-sm text-white rounded-sm p-1 hover:bg-red-500 bg-red-600 outline outline-2 hover:outline-red-300 duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                        </Link>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
.bordered-table {
    width: 100%;
    border-collapse: collapse;
}

/*.bordered-table thead {
    @apply border border-gray-300;
}**/
.bordered-table th {
    @apply px-4 py-3 text-xs uppercase;
}

/**.bordered-table tbody tr {
    @apply  border border-gray-300;
}*/
.bordered-table td {
    @apply px-4 py-2 text-gray-600;
}

tr:nth-child(odd) {
    @apply bg-gray-100;
}

tr:nth-child(even) {
    @apply bg-none;
}
</style>