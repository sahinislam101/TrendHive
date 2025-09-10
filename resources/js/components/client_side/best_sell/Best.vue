<template>
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
      <!-- Header + Arrows -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2">🔥 Best Selling Products</h2>
        <div class="flex items-center gap-2">
          <button @click="scrollLeft" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button @click="scrollRight" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Horizontal Scrollable Cards -->
      <div
        ref="scrollContainer"
        class="flex gap-6 overflow-x-auto scrollbar-hide scroll-smooth pb-2"
      >
        <div
          v-for="product in best_sell"
          :key="product.id"
          class="min-w-[220px] bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition"
        >
          <!-- Product Image -->
          <div class="p-4 flex justify-center items-center bg-gray-50">
            <img :src="product.image" alt="product" class="h-32 object-contain" />
          </div>

          <!-- Product Info -->
          <div class="px-4 py-3">
            <h3 class="font-medium text-sm truncate">{{ product.name }}</h3>
            <p class="text-red-600 font-bold mt-1">৳{{ product.selling_price ?? product.original_price }}</p>
          </div>

          <!-- Buttons -->
          <div class="flex justify-between items-center gap-2 px-4 pb-4">
            <button @click="addToCart(product.id)"
              class="flex-1 bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-800 py-2 rounded">
              Add to Cart
            </button>
            <Link :href="`/product/${product.slug}`"
              class="flex-1 bg-red-500 hover:bg-red-600 text-sm font-medium text-white py-2 rounded text-center">
              View
            </Link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

// Props from parent
const props = defineProps({
  best_sell: {
    type: Array,
    required: true,
  },
})

// Scroll Logic
const scrollContainer = ref(null)
const scrollLeft = () => {
  scrollContainer.value.scrollBy({ left: -300, behavior: 'smooth' })
}
const scrollRight = () => {
  scrollContainer.value.scrollBy({ left: 300, behavior: 'smooth' })
}

// Add to cart
const addToCart = (productId) => {
  router.post(route('cart.store'), { product_id: productId }, {
    preserveScroll: true,
    onSuccess: () => {
      alert('✅ Product added to cart!')
    }
  })
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
