<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, ref } from "vue";

let books = ref(usePage().props.books);
const form = useForm({});

onMounted(() => {
  console.log(books.value);
})

const deleteBook = (id, index) => {
  if (confirm("Are you sure you want to delete?")) {
    form.delete(route("books.destroy", id), {
      onSuccess: () => {
        books.value.data.splice(index, 1);
        books.value.total = books.value.total - 1;
      },
    });
  }
};
let response = ref('');
let loading = ref(false);
const importBook = () => {
  loading.value = true;
  axios.post(route('books.import'), {}).then(res => {
    console.log(res);
    response.value = res.data.message;
    loading.value = false;
  }).catch(err => {
    loading.value = false;
  });
}
</script>

<template>
  <Head title="Book listing" />

  <AuthenticatedLayout>
    <template #header>
      <h4>
        Book Listing
        <Link :href="route('books.create')" class="btn btn-primary float-end">
          Add new</Link
        >
      </h4>
    </template>

    <div class="py-1 mt-2">
      <h5>Total : {{ books.total }} records
        <button @click="importBook()" class="btn btn-secondary float-end">
          Import Books from FakerApi
          <div class="spinner-border" v-if="loading"  style="width: 1rem;height: 1rem;" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div> 
        </button>
      </h5>
      <p class="text-success text-center" v-if="response">
        {{ response }}
      </p>
      <table class="table table-borderless table-striped">
        <thead>
          <tr>
            <th scope="col">#ISBN</th>
            <th scope="col">Title</th>
            <th scope="col">Genre</th>
            <th scope="col">Published At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr v-for="(book, key) of books.data" :key="key">
            <th scope="row">{{ book.isbn }}</th>
            <td>
              {{ book.title }} <br />
              <small> <span class="badge bg-info"> {{ book.author }} </span></small>
            </td>
            <td>{{ book.genre }}</td>
            <td>{{ book.publication_date }}</td>
            <td>
              <Link :href="route('books.edit', book.id)" class="btn text-info"
                >Edit</Link
              >
              <button
                @click.prevent="deleteBook(book.id, key)"
                class="btn text-danger"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <nav class="float-end">
        <ul class="pagination">
          <li class="page-item" :class="{active: link.active == true, disabled: link.url == null && link.label != '...' }" v-for="(link, key) of books.links" :key="key">
            <Link class="page-link" :href="link.url ? link.url :''" tabindex="-1"> <span v-html="link.label"></span> </Link>
          </li>
        </ul>
      </nav>
    </div>
  </AuthenticatedLayout>
</template>