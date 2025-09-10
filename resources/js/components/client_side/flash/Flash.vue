<template>
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">

      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2">🔥 Flash Sales</h2>
        <Link
          href="\allproducts"
          class="text-sm font-medium text-blue-600 hover:underline"
        >
          View All
        </Link>
      </div>

      <!-- Wrapper with Arrows -->
      <div class="relative">
        <!-- Left Arrow -->
        <button
          @click="scrollLeft"
          class="absolute -left-3 top-1/2 -translate-y-1/2 bg-white shadow rounded-full p-2 z-10 hover:bg-gray-100"
        >
          <ChevronLeft class="w-5 h-5" />
        </button>

        <!-- Product Scroll Row (drag enabled) -->
        <div
          ref="scrollContainer"
          class="flex gap-6 overflow-x-auto pb-4 scrollbar-hide scroll-smooth cursor-grab active:cursor-grabbing"
          @mousedown="startDrag"
          @mousemove="onDrag"
          @mouseup="endDrag"
          @mouseleave="endDrag"
        >
          <!-- Product Card -->
          <div
            v-for="item in flash_sales"
            :key="item.id"
            class="min-w-[200px] border rounded-lg p-3 shadow-sm hover:shadow-md transition flex-shrink-0"
          >
            <!-- Product Image -->
            <div class="relative flex justify-center">
              <img
                :src="item.image"
                alt="Product"
                class="h-32 object-contain"
              />
            </div>

            <!-- Product Name -->
            <h3 class="mt-3 text-sm font-medium text-gray-900 text-center line-clamp-2">
              {{ item.name }}
            </h3>

            <!-- Price -->
            <div class="mt-2 text-center">
              <span class="text-lg font-bold text-gray-900">৳ {{ item.selling_price }}</span>
              <span class="ml-2 text-sm text-gray-500 line-through">৳ {{ item.original_price }}</span>
            </div>

            <!-- Actions -->
            <div class="flex w-full gap-2 mt-4">
              <!-- View Button -->
              <Link
                :href="`/product/${item.slug}`"
                class="flex-1 bg-black text-white text-sm py-2 rounded-lg hover:bg-gray-800 transition text-center"
              >
                View
              </Link>

              <!-- Add to Cart Button -->
              <button
                @click="addToCart(item)"
                class="flex-1 bg-blue-600 text-white text-sm py-2 rounded-lg hover:bg-blue-700 transition"
              >
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Right Arrow -->
        <button
          @click="scrollRight"
          class="absolute -right-3 top-1/2 -translate-y-1/2 bg-white shadow rounded-full p-2 z-10 hover:bg-gray-100"
        >
          <ChevronRight class="w-5 h-5" />
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ChevronLeft, ChevronRight } from 'lucide-vue-next'
import { ref } from 'vue'

const props = defineProps({
  flash_sales: {
    type: Array,
    required: true,
  },
})

const scrollContainer = ref(null)
const isDown = ref(false)
const startX = ref(0)
const scrollLeftPos = ref(0)

// Arrows click scroll
const scrollLeft = () => {
  scrollContainer.value.scrollBy({ left: -300, behavior: 'smooth' })
}
const scrollRight = () => {
  scrollContainer.value.scrollBy({ left: 300, behavior: 'smooth' })
}

// Drag scroll
const startDrag = (e) => {
  isDown.value = true
  startX.value = e.pageX - scrollContainer.value.offsetLeft
  scrollLeftPos.value = scrollContainer.value.scrollLeft
}
const onDrag = (e) => {
  if (!isDown.value) return
  e.preventDefault()
  const x = e.pageX - scrollContainer.value.offsetLeft
  const walk = (x - startX.value) * 1.5 // sensitivity
  scrollContainer.value.scrollLeft = scrollLeftPos.value - walk
}
const endDrag = () => {
  isDown.value = false
}

// Add to Cart (demo)
const addToCart = (item) => {
  alert(`Added ${item.name} to cart!`)
  // এখানে আপনার আসল cart logic বসান
}
</script>

<style>
/* scrollbar hide */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
