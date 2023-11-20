<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import * as _ from "lodash";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

let books = ref([]);
let booksData = ref([]);
let loader = ref(false);

onMounted(() => {
  const urlParams = new URLSearchParams(window.location.search);
  searchText.value = urlParams.get('search');
  bookListing(searchText.value);
});

const bookListing = (text = "", page = 1, is_load_more_record = false) => {
  loader.value = true
  axios.get(route("book.list", { search: text, page: page })).then((response) => {
    if(!is_load_more_record) {
      books.value = response.data.data;
      currentPage.value = books.value.current_page;
      booksData.value = [...response.data.data.data];
    } else {
      const newBooks = response.data.data.data;
      booksData.value = [...booksData.value, ...newBooks];
    }
    console.log(books.value);
    loader.value = false;
  });
};


let currentPage = ref(1);
const loadMore = () => {
  currentPage.value += 1;
  bookListing(searchText.value, currentPage.value, true);
}


let searchText = ref('');
const searchBook = _.debounce((e) => {
  console.log(e.target.value);
  searchText.value = e.target.value;
  bookListing(searchText.value, 1);
  
  if (history.pushState) {
    history.pushState(null, '', '?search='+searchText.value)
  }
}, 1000);
</script>

<template>
  <Head title="Welcome" />

  <div>
    <div v-if="canLogin" class="p-2 bg-light">
      <span> </span>
      <Link class="btn" :href="route('dashboard')">BookStore</Link>
      <div class="float-end">
        <Link
          v-if="$page.props.auth.user"
          class="btn"
          :href="route('dashboard')"
          >Dashboard</Link
        >

        <template v-else>
          <Link class="btn" :href="route('login')">Log in</Link>

          <Link v-if="canRegister" :href="route('register')" class="btn"
            >Register</Link
          >
        </template>
      </div>
    </div>
    <div class="py-2">
      <div class="p-2 text-center">Welcome to the <b> Book Store! </b></div>

      <div class="container-fluid mb-2">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <span class="search-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                height="1em"
                viewBox="0 0 512 512"
              >
                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                  d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"
                />
              </svg>
            </span>
            <input
              type="search"
              class="form-control search-input"
              @input="searchBook"
              v-model="searchText"
              placeholder="Search something..."
            />
          </div>
        </div>
      </div>
      <div class="loader" >
        <div v-if="loader" class="loader__element"></div>
      </div>
      <div class="container-fluid">
        <div class="row bg-light py-2">
          <div class="col-md-12">
            Total result found: <strong> {{ books?.total }}</strong>
          </div>
          <div class="col-md-3" v-for="(book, key) of booksData" :key="key">
            <div class="card border-0 mb-2">
              <div class="card-body">
                <h5 class="card-title">{{ book.title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                  {{ book.genre }}
                  <span class="float-end">
                    {{ book.publication_date }}
                  </span>
                </h6>
                <div class="card-text similarheight">
                  {{ book.description }}
                </div>

                <p class="footer-content">
                  ISBN: <strong>{{ book.isbn }} </strong>
                  <span class="float-end">
                    <strong> {{ book.author }}</strong></span
                  >
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-12" v-if="books.current_page < books.last_page">
            <p class="text-center"> 
              <button class="btn btn-primary" @click="loadMore()"> {{ loader ? 'Loading...': 'Load more...' }}
                <div class="spinner-border" v-if="loader"  style="width: 1rem;height: 1rem;" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div> 
              </button> 
            </p>
          </div>

          <div class="col-md-12 py-5 text-center" v-if="!booksData?.length">
              <p>No result found.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}

.search-icon {
  position: absolute;
  margin: 6px 12px;
}

.search-icon svg {
  font-size: 20px;
  fill: #727579;
}

.search-input {
  padding-left: 36px;
}
.similarheight {
  height: 150px;
  overflow: hidden;
}

.footer-content {
  font-size: 14px;
  opacity: 0.7;
}
:root {
  /* --main-color: #111; */
  --loader-color: #4caf50;
  --back-color: #a5d6a7;
  --time: 3s;
  --size: 3px;
}
.loader {
  background-color: var(--main-color);
  overflow: hidden;
  width: 100%;
  height: 100%;
  height: 3px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

.loader__element {
  height: var(--size);
  width: 100%;
  background: var(--back-color);
}

.loader__element:before {
  content: "";
  display: block;
  background-color: var(--loader-color);
  height: var(--size);
  width: 0;
  animation: getWidth var(--time) ease-in infinite;
}

@keyframes getWidth {
  100% {
    width: 100%;
  }
}
</style>
