<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps(['users']);

const showConfirmDeleteUserModal = ref(false);

const form = useForm({});

const confirmDeleteUser = () => {
    showConfirmDeleteUserModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteUserModal.value = false;
};

const deleteUser = (id) => {
    form.delete(route('users.destroy', id), {
        onSuccess: () => closeModal()
    });
};
</script>

<template>
    <Head title="Users" />

    <AdminLayout>
        <div class="py-4">
            <div class="flex justify-between items-center">
                <h1>Welcome, Users</h1>
                <Link :href="route('users.create')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                New User
                </Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>Id</TableHeaderCell>
                        <TableHeaderCell>Name</TableHeaderCell>
                        <TableHeaderCell>Email</TableHeaderCell>
                        <TableHeaderCell>Actions</TableHeaderCell>
                    </template>

                    <template #default>
                        <TableRow v-for="(user, index) in users" :key="index" class="border-b">
                            <TableDataCell>{{ user.id }}</TableDataCell>
                            <TableDataCell>{{ user.name }}</TableDataCell>
                            <TableDataCell>{{ user.email }}</TableDataCell>
                            <TableDataCell class="space-x-2">
                                <Link :href="route('users.edit', user.id)" class=" text-green-400 hover:text-green-600">
                                Edit
                                </Link>
                                <button @click="confirmDeleteUser" class=" text-red-400 hover:text-red-600">
                                    Delete
                                </button>

                                <!-- Confirm Modal -->
                                <Modal :show="showConfirmDeleteUserModal" @click="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-white">
                                            Are you sure to delete this user?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deleteUser(user.id)">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
