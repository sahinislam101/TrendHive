<template>
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
      <!-- Title + Arrows -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2">📁 Browse By Category</h2>
        <div class="flex items-center gap-2">
          <button @click="scrollLeft" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button @click="scrollRight" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Horizontal Scrollable Category Cards -->
      <div ref="scrollContainer" class="flex gap-6 overflow-x-auto scrollbar-hide scroll-smooth pb-2">
        <Link :href="`/category/${cat.slug}`" v-for="cat in categories" :key="cat.id"
          class="min-w-[140px] bg-white text-center p-6 rounded-lg shadow-none hover:shadow-xl transition-shadow duration-300">
          <img :src="cat.image" alt="image" class="h-16 mx-auto mb-3 object-contain" />
          <p class="text-gray-800 font-medium text-sm">{{ cat.name }}</p>
        </Link>

      </div>

      <!-- View All Button -->
      <div class="mt-10 text-center">
        <Link href="/allcategories" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-medium">
          View All Categories
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3';

// Props from parent
const props = defineProps({
  categories: {
    type: Array,
    required: true,
  }
})

// Scroll logic
const scrollContainer = ref(null)

const scrollLeft = () => {
  scrollContainer.value.scrollBy({ left: -300, behavior: 'smooth' })
}
const scrollRight = () => {
  scrollContainer.value.scrollBy({ left: 300, behavior: 'smooth' })
}
</script>

<style scoped>
/* Hide scrollbar */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
