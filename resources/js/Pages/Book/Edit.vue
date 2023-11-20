<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BookForm from "./Form.vue"
import { onMounted, ref } from "vue";
defineProps({
  book: {
    type: Object,
  },
});

</script>

<template>
  <Head title="Book edit" />

  <AuthenticatedLayout>
    <template #header>
      <h4>Book Edit
        <Link :href="route('books.index')" class="btn btn-primary float-end"> Back</Link>
      </h4>
    </template>

    <div class="py-1">
      <BookForm formRoute="books.update" />
    </div>
  </AuthenticatedLayout>
</template>