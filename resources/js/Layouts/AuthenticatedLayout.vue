<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <Link class="navbar-brand" :href="'/'">
            BookStore
          </Link>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown" v-if="$page.props.auth.user.role == 'admin'">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Manage Book
              </a>
              <ul class="dropdown-menu">
                <li>
                    <DropdownLink
                    class="dropdown-item"
                    :href="route('books.index')"
                  >
                    Listing
                  </DropdownLink>
                </li>
                <li>
                  <DropdownLink
                    class="dropdown-item"
                    :href="route('books.create')"
                  >
                    Add new 
                  </DropdownLink>
                </li>
                
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                {{ $page.props.auth.user.name }}
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdown"
              >
                <li>
                  <DropdownLink
                    class="dropdown-item"
                    :href="route('profile.edit')"
                  >
                    Profile
                  </DropdownLink>
                </li>
                <li>
                  <DropdownLink
                    class="dropdown-item"
                    :href="route('logout')"
                    method="post"
                    as="button"
                  >
                    Log Out
                  </DropdownLink>
                </li>
              </ul>
            </li>
          </ul>
          <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
        </div>
      </div>
    </nav>
    <div class="">
      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="container-fluid">
          <div class="mx-auto py-1 ">
            <slot name="header" />
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <div class="container-fluid">
            <div class="alert alert-success mt-2" v-if="$page.props.flash.success"> {{ $page.props.flash.success }} </div>
            <div class="alert alert-danger mt-2" v-if="$page.props.flash.error"> {{ $page.props.flash.error }} </div>
            <slot />
        </div>
      </main>
    </div>
  </div>
</template>
