<template>
  <header class="bg-white shadow-sm py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4">

      <!-- Logo -->
      <div class="text-2xl font-bold text-gray-800"><a :href="('/')">Shoppia</a></div>

      <!-- Nav Links -->
      <nav class="space-x-6 hidden md:flex">
        <Link :href="('/')" :class="{
          'text-black border-b-2 border-black pb-1':
          'text-gray-600 hover:text-black',
        }">Home</Link>

        <Link  :class="{
          'text-black border-b-2 border-black pb-1':
          'text-gray-600 hover:text-black',
        }">Contact</Link>

        <Link  :class="{
          'text-black border-b-2 border-black pb-1':
          'text-gray-600 hover:text-black',
        }">About</Link>

        <Link :href="login()" :class="{
          'text-black border-b-2 border-black pb-1': 
          'text-gray-600 hover:text-black',
        }">Sign Up</Link>
      </nav>


      <!-- Search + Icons -->
      <div class="flex items-center space-x-4">
        <div class="relative">
          <input type="text" placeholder="What are you looking for?"
            class="pl-4 pr-10 py-2 border rounded-full bg-gray-100 text-sm w-64" />
          <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
            🔍
          </span>
        </div>
        <button title="Wishlist">🤍</button>
        <button title="Cart">🛒</button>
      </div>

    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { home, login, register, dashboard } from '@/routes';

</script>
