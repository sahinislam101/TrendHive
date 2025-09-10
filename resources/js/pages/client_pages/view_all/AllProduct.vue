<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'

const props = defineProps({
  products: Object,
})

const filters = ref({
  minPrice: '',
  maxPrice: '',
  sort: 'default',
})

const applyFilters = () => {
  router.get('/allproducts', filters.value, {
    preserveState: true,
    preserveScroll: true,
  })
}


const clearFilters = () => {
  filters.value.minPrice = ''
  filters.value.maxPrice = ''
  filters.value.sort = 'default'
  applyFilters()
}
</script>

<template>
  <Header />

  <div class="bg-white py-10 px-4 max-w-7xl mx-auto">
    <!-- Filter Bar -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <!-- Price Filter -->
      <div>
        <h2 class="font-semibold mb-2">PRICE RANGE</h2>
        <div class="flex items-center gap-2 mb-4">
          <input v-model="filters.minPrice" type="number" placeholder="Min" class="w-full border px-2 py-1 rounded" />
          <input v-model="filters.maxPrice" type="number" placeholder="Max" class="w-full border px-2 py-1 rounded" />
        </div>
        <div class="flex gap-2">
          <button @click="clearFilters" class="bg-gray-300 px-3 py-1 rounded text-sm">Clear</button>
          <button @click="applyFilters" class="bg-black text-white px-3 py-1 rounded text-sm">Apply</button>
        </div>
      </div>

      <!-- Sorting -->
      <div class="md:col-span-2 flex justify-between items-end">
        <div class="text-gray-700">All Products</div>
        <select v-model="filters.sort" @change="applyFilters" class="border px-2 py-1 rounded">
          <option value="default">Default</option>
          <option value="low">Price Low to High</option>
          <option value="high">Price High to Low</option>
        </select>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div v-for="product in products.data" :key="product.id" class="bg-white border rounded shadow hover:shadow-md">
        <img :src="product.image" class="w-full h-64 object-contain p-4" alt="Product" />
        <div class="p-4">
          <h3 class="text-sm font-semibold truncate">{{ product.name }}</h3>
          <div class="mt-2 text-center">
            <span class="text-lg font-bold text-gray-900">৳ {{ product.selling_price }}</span>
            <span class="ml-2 text-sm text-gray-500 line-through">৳ {{ product.original_price }}</span>
          </div>
          <div class="flex gap-2 mt-3">
            <button class="w-1/2 bg-gray-100 hover:bg-gray-200 text-sm py-2 rounded">Add to Cart</button>
            <button class="w-1/2 bg-red-500 hover:bg-red-600 text-white text-sm py-2 rounded">Buy Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <Footer />
</template>
