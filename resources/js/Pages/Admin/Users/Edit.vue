<script setup>
import TextInput from '@/Components/TextInput.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import VueMultiselect from 'vue-multiselect';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    roles: Array,
    permissions: Array
});

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    roles: [],
    permissions: []
});

const submit = () => {
    form.put(route('users.update', props.user?.id));
};

watch(
    () => props.user,
    () => {
        form.permissions = props.user?.permissions;
        form.roles = props.user?.roles;
    }
);

onMounted(() => {
    form.permissions = props.user?.permissions;
    form.roles = props.user?.roles;
});
</script>

<template>
    <Head title="Create user" />

    <AdminLayout>
        <div class="py-4">
            <div class="flex justify-between items-center">
                <Link :href="route('users.index')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                Back
                </Link>
            </div>

            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold uppercase mb-4">update user</h1>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                            autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="roles" value="Roles" />
                        <VueMultiselect v-model="form.roles" :options="roles" :multiple="true" :close-on-select="true"
                            placeholder="Pick some" label="name" track-by="id" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permissions" />
                        <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                            :close-on-select="true" placeholder="Pick some" label="name" track-by="id" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            <!-- Roles -->
            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold uppercase mb-4">Roles</h1>
                <div class="bg-white">
                    <Table>
                        <template #header>
                            <TableHeaderCell>Id</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Actions</TableHeaderCell>
                        </template>

                        <template #default>
                            <TableRow v-for="(userRoles, index) in user.roles" :key="index" class="border-b">
                                <TableDataCell>{{ userRoles.id }}</TableDataCell>
                                <TableDataCell>{{ userRoles.name }}</TableDataCell>
                                <TableDataCell class="space-x-2">
                                    <Link :href="route('users.roles.destroy', [user.id, userRoles.id])" method="DELETE"
                                        as="button" class=" text-red-400 hover:text-red-600" preserve-scroll>
                                    Revoke
                                    </Link>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>

            <!-- Permissions -->
            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold uppercase mb-4">Permissions</h1>
                <div class="bg-white">
                    <Table>
                        <template #header>
                            <TableHeaderCell>Id</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Actions</TableHeaderCell>
                        </template>

                        <template #default>
                            <TableRow v-for="(userPermission, index) in user.permissions" :key="index" class="border-b">
                                <TableDataCell>{{ userPermission.id }}</TableDataCell>
                                <TableDataCell>{{ userPermission.name }}</TableDataCell>
                                <TableDataCell class="space-x-2">
                                    <Link :href="route('users.permissions.destroy', [user.id, userPermission.id])"
                                        method="DELETE" as="button" class=" text-red-400 hover:text-red-600"
                                        preserve-scroll>
                                    Revoke
                                    </Link>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
