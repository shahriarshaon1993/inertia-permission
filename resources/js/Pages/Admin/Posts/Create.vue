<script setup>
import TextInput from '@/Components/TextInput.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: "",
});
</script>

<template>
    <Head title="Create new post" />

    <AdminLayout>
        <div class="py-4">
            <div class="flex justify-between items-center">
                <Link :href="route('posts.index')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                Back
                </Link>
            </div>
            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold uppercase mb-4">Create new post</h1>
                <form @submit.prevent="form.post(route('posts.store'))">
                    <div class="mt-4">
                        <InputLabel for="title" value="Title" />

                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus
                            autocomplete="title" />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div class="flex items-center mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
