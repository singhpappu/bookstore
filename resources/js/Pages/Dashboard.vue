<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h4>Dashboard</h4>
        </template>

        <div class="py-2">
            <div class="p-4">You're logged in!</div>
        </div>
    </AuthenticatedLayout>
</template>
