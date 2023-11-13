<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ArrowPathIcon, PencilIcon, ChevronDownIcon, TrashIcon, MagnifyingGlassIcon,
    EyeIcon, UserPlusIcon, AdjustmentsHorizontalIcon, CheckCircleIcon, MinusCircleIcon, XCircleIcon } from '@heroicons/vue/24/solid';
import { FunnelIcon, ExclamationTriangleIcon } from '@heroicons/vue/24/outline';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Pagination from '@/Components/Pagination.vue';
import Table from '@/Components/Table.vue';
import UsersTable from '@/Pages/User/Partials/UsersTable.vue';
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import throttle from 'lodash/throttle';
import { watch, ref } from 'vue';
import Alert from '@/Components/Alert.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    users: Object,
    filters: Object,
    roles: Array
})

const search = ref(props.filters.search)
const role = ref(props.filters.role);
const status = ref(props.filters.status);

watch([search, role, status], throttle( function ([value1, value2, value3]) {

    let params = {
        search: value1,
        role: value2,
        status: value3
    }

    Object.keys(params).forEach(key => {
        if(params[key] == '') {
            delete params[key];
        }
    });

    router.get('/users', params,{
        preserveState: true,
        replace: true,
    });
}, 300));

const formatTimestampToDate = (timestamp) => {
    const date = new Date(timestamp);

    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    const day = date.getDate();
    const month = monthNames[date.getMonth()];
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
}

const reset = () => {
    role.value = '';
    status.value = '';
}

const showStatusFilter = ref(false);

function openStatusDropdown() {
    showStatusFilter.value = !showStatusFilter.value;
}

const showRoleFilter = ref(false);

function openRoleDropdown() {
    showRoleFilter.value = !showRoleFilter.value;
}

const selectedUser = ref({})
const confirmingUserDeletion = ref(false);

const deleteUser = (user) => {
    confirmingUserDeletion.value = true;

    selectedUser.value = user;
}
const closeModal = () => {
    confirmingUserDeletion.value = false;
};

const confirmDeleteUser = () => {
    router.delete('/users/delete/' + selectedUser.value.id, {
        onSuccess: () => closeModal()
    });
}
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <div class="py-6">
            <div class="w-full sm:px-6 lg:px-8">
                
                <div class="flex items-center justify-between mb-4">
                    <h1 class="font-semibold text-3xl text-gray-700 leading-tight">Manage Users</h1>
                    <Link href="/users/create" class="flex items-center px-3 py-2 rounded-lg bg-[#4e73df] hover:bg-[#4e72dfc0] text-white font-medium">
                        <UserPlusIcon class="w-4 h-4" />
                        <span class="text-sm ml-1">Add User</span>
                    </Link>
                </div>

                <Alert class="mb-4" />


                        <div class="flex items-end mb-4">
                            
                            <label for="search" class="relative">
                                <MagnifyingGlassIcon class="absolute left-2 top-2 w-5 h-5 text-gray-400" />
                                <input 
                                    v-model="search"
                                    type="search" 
                                    id="table-search-users" 
                                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Search for users">
                            </label>
        
                            <div class="flex space-x-2 ml-2">
        
                                <div class="relative">
                                    <button @click="openStatusDropdown" class="w-36 inline-flex justify-between text-gray-600 items-center rounded-md bg-white hover:bg-gray-100 shadow p-2 text-sm">
                                        Filter by Status
                                        <ChevronDownIcon class="w-4 h-4 mr-1" :class="{ 'rotate-180' : showStatusFilter }"/>
                                    </button>
        
                                    <!-- Full Screen Dropdown Overlay -->
                                    <div v-show="showStatusFilter" class="fixed inset-0 z-40" @click="showStatusFilter = false"></div>
        
                                    <transition
                                    enter-active-class="transition ease-out duration-200"
                                    enter-from-class="opacity-0 scale-95"
                                    enter-to-class="opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="opacity-100 scale-100"
                                    leave-to-class="opacity-0 scale-95"
                                    >
                                        <div v-show="showStatusFilter" class="z-50 absolute w-36 top-10 left-0 bg-white shadow rounded-md">
                                            <ul class="p-2 space-y-1 text-sm text-gray-700">
                                                <li>
                                                    <input v-model="status" value="true" type="radio" name="status" id="status-1" class="hidden peer">
                                                    <label for="status-1" class="flex items-center p-2 hover:bg-gray-50 text-sm font-medium text-gray-600 peer-checked:text-blue-600 rounded peer-checked:bg-gray-50">
                                                        <CheckCircleIcon class="w-5 h-5 mr-1" />
                                                        Active
                                                    </label>
                                                </li>
                                                <li>
                                                    <input v-model="status" value="false" type="radio" name="status" id="status-2" class="hidden peer">
                                                    <label for="status-2" class="flex items-center p-2 hover:bg-gray-50 text-sm font-medium text-gray-600 peer-checked:text-red-600 rounded peer-checked:bg-gray-50">
                                                        <MinusCircleIcon class="w-5 h-5 mr-1" />
                                                        Deactivated
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </transition>
                                </div>
                                <div class="relative">
                                    <button @click="openRoleDropdown" class="w-44 inline-flex justify-between text-gray-600 items-center rounded-md bg-white hover:bg-gray-100 shadow p-2 text-sm">
                                        Filter by Role
                                        <ChevronDownIcon class="w-4 h-4 mr-1" :class="{ 'rotate-180' : showRoleFilter }"/>
                                    </button>

                                    <!-- Full Screen Dropdown Overlay -->
                                    <div v-show="showRoleFilter" class="fixed inset-0 z-40" @click="showRoleFilter = false"></div>

                                    <transition
                                    enter-active-class="transition ease-out duration-200"
                                    enter-from-class="opacity-0 scale-95"
                                    enter-to-class="opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="opacity-100 scale-100"
                                    leave-to-class="opacity-0 scale-95"
                                    >
                                        <div v-show="showRoleFilter" class="z-50 absolute w-44 top-10 left-0 bg-white border shadow-lg rounded-md">
                                            <ul class="p-2 space-y-1 text-sm text-gray-700">
                                                <li>
                                                    <input v-model="role" value="Administrator" type="radio" name="role" id="role-1" class="hidden peer">
                                                    <label for="role-1" class="flex items-center p-2 hover:bg-gray-50 text-sm font-medium text-gray-600 peer-checked:text-blue-600 rounded peer-checked:bg-gray-50">
                                                        Administrator
                                                    </label>
                                                </li>
                                                <li>
                                                    <input v-model="role" value="Property Custodian" type="radio" name="role" id="role-2" class="hidden peer">
                                                    <label for="role-2" class="flex items-center p-2 hover:bg-gray-50 text-sm font-medium text-gray-600 peer-checked:text-rose-600 rounded peer-checked:bg-gray-50">
                                                        Property Custodian
                                                    </label>
                                                </li>
                                                <li>
                                                    <input v-model="role" value="Department Head" type="radio" name="role" id="role-3" class="hidden peer">
                                                    <label for="role-3" class="flex items-center p-2 hover:bg-gray-50 text-sm font-medium text-gray-600 peer-checked:text-orange-600 rounded peer-checked:bg-gray-50">
                                                        Department Head
                                                    </label>
                                                </li>
                                                <li>
                                                    <input v-model="role" value="Regular User" type="radio" name="role" id="role-4" class="hidden peer">
                                                    <label for="role-4" class="flex items-center p-2 hover:bg-gray-50 text-sm font-medium text-gray-600 peer-checked:text-green-600 rounded peer-checked:bg-gray-50">
                                                        Regular User
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </transition>
                                </div>

                                <button 
                                v-if="role || status"
                                @click="reset" 
                                class="inline-flex items-center text-sm text-red-600 justify-center bg-red-100 hover:bg-red-200 shadow p-2 rounded-md">
                                    <XCircleIcon class="w-4 h-4 mr-1" />
                                    Reset All Filter</button>
                            </div>
                        </div>
                        
                    <div class="overflow-x-auto rounded-lg bg-white">

                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        User
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Email Address
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Joined
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Role
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white hover:bg-gray-50" :class="{ 'border-b' : index != users.data.length - 1 }" v-for="(user, index) in users.data" :key="index">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <img v-if="user.profile_photo" :src="user.profile_photo_url" alt="user_photo" class="w-8 h-8 rounded-full">
                                            <img v-else src="../../Components/images/user-icon.png" class="w-8 h-8 rounded-full" alt="">
                                            <div class="text-sm font-medium text-black ml-2 shrink-0">{{ user.name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-normal text-gray-500">{{ user.email }} </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center">
                                            <span v-if="user.active" class="text-green-600">
                                                <CheckCircleIcon class="w-5 h-5" />
                                            </span>
                                            <span v-else class="text-red-600">
                                                <MinusCircleIcon class="w-5 h-5" />                         
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        {{ formatTimestampToDate(user.created_at) }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div>
                                            <span 
                                                v-html="user.role" 
                                                class="px-2 py-1.5 text-xs font-medium rounded-full tracking-wide"
                                                :class="{
                                                    'text-indigo-600 bg-indigo-100' : user.role == 'Administrator',
                                                    'text-rose-600 bg-rose-100' : user.role == 'Property Custodian',
                                                    'text-orange-600 bg-orange-100' : user.role == 'Department Head',
                                                    'text-green-600 bg-green-100' : user.role == 'Regular User',
                                                }"
                                            ></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center space-x-2">
                                            <Link :href="'/users/edit/' + user.id"
                                                class="inline-flex items-center px-2 py-1.5 rounded-lg bg-[#4e73df] hover:bg-[#688dff] text-white text-xs font-medium transition-colors ease-in-out duration-300">
                                                <PencilIcon class="w-3 h-3 mr-1" />
                                                Edit
                                            </Link>
                                            <button @click="deleteUser(user)" type="button" class="inline-flex items-center px-2 py-1.5 rounded-lg bg-[#EA3C53] hover:bg-[#ff5168] text-white text-xs font-medium transition-colors ease-in-out duration-300">
                                                  <TrashIcon class="w-3 h-3 mr-1" />
                                                  Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Joined
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b hover:bg-gray-50" v-for="(user, index) in users.data" :key="index">
                                    <th scope="row" class="flex items-center px-6 py-3 text-gray-900 whitespace-nowrap">
                                        <img v-if="user.profile_photo" :src="user.profile_photo_url" alt="user_photo" class="w-10 h-10 rounded-full">
                                        <img v-else src="../../Components/images/user-icon.png" class="w-10 h-10 rounded-full" alt="">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ user.name }}</div>
                                            <div class="font-normal text-gray-500">{{ user.email }} </div>
                                        </div>  
                                    </th>
                                    <td class="px-6 py-3 text-center">
                                        {{ formatTimestampToDate(user.created_at) }}
                                    </td>
                                    <td class="px-6 py-3">
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
                                    <td class="px-6 py-3 text-center">
                                        <div>
                                            <span 
                                                v-html="user.role" 
                                                class="px-4 py-2 text-xs font-medium rounded-md tracking-wide uppercase"
                                                :class="{
                                                    'text-indigo-600 bg-indigo-100' : user.role == 'Administrator',
                                                    'text-rose-600 bg-rose-100' : user.role == 'Property Custodian',
                                                    'text-orange-600 bg-orange-100' : user.role == 'Department Head',
                                                    'text-green-600 bg-green-100' : user.role == 'Regular User',
                                                }"
                                            ></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center justify-center space-x-2">
                                            <Link :href="'/users/edit/' + user.id"
                                                class="inline-flex items-center px-3 py-2 rounded-lg bg-[#4e73df] hover:bg-[#688dff] text-white text-sm font-medium transition-colors ease-in-out duration-300">
                                                <PencilIcon class="w-3 h-3 mr-1" />
                                                Edit
                                            </Link>
                                            <button @click="deleteUser(user)" type="button" class="inline-flex items-center px-3 py-2 rounded-lg bg-[#EA3C53] hover:bg-[#ff5168] text-white text-sm font-medium transition-colors ease-in-out duration-300">
                                                  <TrashIcon class="w-3 h-3 mr-1" />
                                                  Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->

                        <!-- No user data response -->
                        <div v-show="users.data.length < 1" class="flex flex-col w-full py-10">
                            <h1 class="text-center text-md font-medium text-gray-400">No user found</h1>
                        </div>
                    </div>

                    <!-- Paginator -->
                    <div v-if="users.data.length > 0" class="flex items-center justify-end mt-4">
                        <Pagination
                        :links="users.links"
                        :current_page="users.current_page"
                        :prev_page_url="users.prev_page_url"
                        :next_page_url="users.next_page_url"
                        :last_page="users.last_page"
                        />
                    </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">

                <div class="flex space-x-2">
                    <div class="shrink-0">
                        <ExclamationTriangleIcon class="w-5 h-5 mt-1" />
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-medium text-gray-900">
                            Delete Confirmation
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Are you sure you want to remove {{ selectedUser.name }}? This action cannot be undone.
                        </p>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="button" @click="closeModal"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 
                    shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                    > Cancel </button>

                    <button
                        type="button"
                        class="ml-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        @click="confirmDeleteUser()"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>