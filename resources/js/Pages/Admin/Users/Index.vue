<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';

import { Head, Link } from '@inertiajs/vue3';

defineProps(['users']);
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
                            <TableDataCell>Edit/Delete</TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
