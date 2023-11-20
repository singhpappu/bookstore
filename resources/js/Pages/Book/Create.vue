<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BookForm from "./Form.vue"
</script>

<template>
  <Head title="Book create" />

  <AuthenticatedLayout>
    <template #header>
      <h4>Book Create
        <Link :href="route('books.index')" class="btn btn-primary float-end"> Back</Link>
      </h4>
    </template>

    <div class="mt-3">
        <BookForm formRoute="books.store" />
    </div>

  </AuthenticatedLayout>
</template>