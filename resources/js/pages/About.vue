<template>
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
      <!-- Product Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

        <!-- Product Card 1 -->
        <div v-for="item in flash_sales" :key="item.id">
          <div  class="relative">
            <img :src="item.image" alt="Product" class="h-32 object-contain" />
          </div>

          <h3 class="mt-3 text-sm font-medium text-gray-900 text-center">
            {{ item.name }}
          </h3>

          <div class="mt-2 text-center">
            <span class="text-lg font-bold text-gray-900">৳ {{ item.selling_price }}</span>
            <span class="ml-2 text-sm text-gray-500 line-through">৳ {{ item.original_price }}</span>
          </div>

          <div class="flex w-full gap-2 mt-4">
            <button
              class="flex-1 bg-black text-white text-sm py-2 rounded-lg hover:bg-gray-800 transition">
              View
            </button>
            <button
              class="flex-1 bg-gray-200 text-gray-700 text-sm py-2 rounded-lg cursor-default">
              Added
            </button>
          </div>
        </div>

        

        <!-- এখানে চাইলে আরও ৪টা একই card কপি করে রাখবেন -->
        
      </div>
    </div>
  </section>
</template>


<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

// Props from parent
const props = defineProps({
  flash_sales: {
    type: Array,
    required: true,
  },
})

</script>
