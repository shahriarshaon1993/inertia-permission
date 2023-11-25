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
    role: {
        type: Object,
        required: true
    },
    permissions: Array
});

const form = useForm({
    name: props.role.name,
    permissions: []
});

watch(
    () => props.role,
    () => form.permissions = props.role?.permissions
);

onMounted(() => {
    form.permissions = props.role?.permissions
});
</script>

<template>
    <Head title="Update role" />

    <AdminLayout>
        <div class="py-4">
            <div class="flex justify-between items-center">
                <Link :href="route('roles.index')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                Back
                </Link>
            </div>
            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold uppercase mb-4">Update role</h1>
                <form @submit.prevent="form.put(route('roles.update', role.id))">
                    <div class="mt-4">
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permissions" />
                        <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                            :close-on-select="true" placeholder="Pick some" label="name" track-by="id" />
                    </div>

                    <div class="flex items-center mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>
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
                            <TableRow v-for="(rolePermission, index) in role.permissions" :key="index" class="border-b">
                                <TableDataCell>{{ rolePermission.id }}</TableDataCell>
                                <TableDataCell>{{ rolePermission.name }}</TableDataCell>
                                <TableDataCell class="space-x-2">
                                    <Link :href="route('roles.permissions.destroy', [role.id, rolePermission.id])"
                                        method="DELETE" as="button" class=" text-red-400 hover:text-red-600">
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
