<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";

import { Link, useForm, usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

defineProps({
  mustVerifydescription: {
    type: Boolean,
  },
  status: {
    type: String,
  },
  formRoute: {
    type: String
  }
});

const book = usePage().props.book;

const form = useForm({
  title: book.title ? book.title : "",
  author: book.author ? book.author : "",
  isbn: book.isbn ? book.isbn : "",
  genre: book.genre ? book.genre : "",
  publication_date: book.publication_date ? book.publication_date : "",
  description: book.description ? book.description : "",
});

const onSubmit = () => {
  if(Object.keys(book).length && book.id) {
    form.patch(route('books.update', book.id), {
      onFinish: () => {}
    })
  } else {
    form.post(route('books.store'))
  }
}
</script>

<template>
  <section>
    <form
      @submit.prevent="onSubmit"
      class="mt-6 space-y-6"
    >
      <InputError :message="form.errors.message" />
      <div class="row">
        <div class="col-md-6">
          <div>
            <InputLabel for="title" value="Title" />

            <TextInput
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              
              autocomplete="title"
            />

            <InputError :message="form.errors.title" />
          </div>

          <div>
            <InputLabel for="author" value="Author" />

            <TextInput
              id="author"
              type="text"
              class="mt-1 block w-full"
              v-model="form.author"
              autocomplete="author"
            />

            <InputError :message="form.errors.author" />
          </div>

          <div>
            <InputLabel for="isbn" value="ISBN" />

            <TextInput
              id="isbn"
              type="text"
              class="mt-1 block w-full"
              v-model="form.isbn"
              autocomplete="isbn"
            />

            <InputError :message="form.errors.isbn" />
          </div>

          <div>
            <InputLabel for="genre" value="Genre" />

            <TextInput
              id="genre"
              type="text"
              class="mt-1 block w-full"
              v-model="form.genre"
              autocomplete="genre"
            />

            <InputError :message="form.errors.genre" />
          </div>

          
        </div>
        <div class="col-md-6">
          <div>
            <InputLabel for="publication_date" value="Publication date" />

            <TextInput
              id="publication_date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.publication_date"
              autocomplete="publication_date"
            />

            <InputError :message="form.errors.publication_date" />
          </div>
            <div>
                <InputLabel for="description" value="Description" />

                <TextArea
                    id="description"
                    type="description"
                    class="mt-1 block w-full"
                    rows="4"
                    v-model="form.description"
                    autocomplete="Description"
                />

                <InputError :message="form.errors.description" />
            </div>
        </div>
      </div>

      <div class="flex items-center mt-2">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-success">
            Saved successfully! 
          </p>
        </Transition>
      </div>
    </form>
  </section>
</template>
