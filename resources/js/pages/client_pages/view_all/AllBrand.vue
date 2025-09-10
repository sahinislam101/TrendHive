<template>
  <Header />
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4">
      <!-- Section Title -->
      <h2 class="text-2xl font-bold text-center mb-8 bg-orange-50 pt-5 pb-5">Our Brand</h2>

      <!-- Colored Background Area -->
      <div class="p-6 rounded-lg shadow-sm">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
          <Link
            v-for="brand in brands"
            :key="brand.id"
            :href="`/brand/${brand.slug}`"
            class="border rounded-lg p-4 flex flex-col items-center hover:shadow-md transition duration-200"
            style="background-color: transparent"
          >
            <div class="w-24 h-24 mb-3 flex items-center justify-center bg-gray-100 rounded">
              
              <img
                v-if="brand.image"
                :src="brand.image"
                :alt="brand.name"
                class="w-full h-full object-contain"
              />
              <svg
                v-else
                class="w-10 h-10 text-gray-400"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3 5h18M9 3v2m6-2v2M4 7h16v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7z"
                />
              </svg>
            </div>
            <p class="text-sm font-medium text-center text-gray-700 truncate w-full">
              {{ brand.name }}
            </p>
          </Link>
        </div>
      </div>
    </div>
  </section>
  <Footer />
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'

const props = defineProps({
  brands: {
    type: Array,
    required: true,
  },
})
</script>
