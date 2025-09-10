<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import Footer from '@/components/client_side/layout/Footer.vue';
import Best from '@/components/client_side/best_sell/Best.vue';
import Brand from '@/components/client_side/brand/Brand.vue';
import Category from '@/components/client_side/category/Category.vue';
import Flash from '@/components/client_side/flash/Flash.vue';
import CategorySlider from '@/components/client_side/layout/CategorySlider.vue';
import Header from '@/components/client_side/layout/Header.vue';
import MainSlider from '@/components/client_side/layout/MainSlider.vue';

const props = defineProps ({
    sliders:{
        type:  Array,
        required: true,
    },
    categories: {
      type:  Array,
        required: true,  
    },
    brands :{
        type: Array,
        required: true,
    },
    flash_sales: {
        type: Array,
        required: true,
    },
    best_sell:{
      type:Array,
      required: true,
    }

});

</script>

<template>
    <!-- <Link :href="login()">Login</Link>
    <Link :href="('/')" > login</Link> -->
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <Header />

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 py-6">
      <div class="max-w-7xl mx-auto mt-8 px-4 flex flex-col md:flex-row gap-4">
        <CategorySlider :categories="categories"/>
      <MainSlider :sliders="sliders" />
      </div>
      <Flash :flash_sales="flash_sales" />
      <Category :categories="categories" />
      <Best :best_sell="best_sell" />
      <Brand :brands="brands" />
      <slot />
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>
