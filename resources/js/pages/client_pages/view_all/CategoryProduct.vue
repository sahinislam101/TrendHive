<script setup>
import Footer from '@/components/client_side/layout/Footer.vue'
import Header from '@/components/client_side/layout/Header.vue'

import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  category: Object,
  products: Object,
  filters: Object,
})

// price range local state
const minPrice = ref(props.filters?.min ?? '')
const maxPrice = ref(props.filters?.max ?? '')

// filter apply
const applyFilter = () => {
  router.get(`/category/${props.category.slug}`, {
    min: minPrice.value,
    max: maxPrice.value,
  }, {
    preserveState: true,
    replace: true,
  })
}

// clear filter
const clearFilter = () => {
  minPrice.value = ''
  maxPrice.value = ''
  router.get(`/category/${props.category.slug}`, {}, {
    preserveState: true,
    replace: true,
  })
}
</script>


<template>
    <Header />
  <section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 grid grid-cols-12 gap-8">

      <!-- Sidebar Filter -->
      <aside class="col-span-12 md:col-span-3 space-y-6">h2
        <!-- Price Range -->
        <div class="bg-white rounded shadow p-4">
          <h3 class="font-semibold mb-3">PRICE RANGE</h3>
          <div class="flex gap-2">
            <input v-model="minPrice" type="number" placeholder="Min"
              class="w-1/2 border rounded px-2 py-1" />
            <input v-model="maxPrice" type="number" placeholder="Max"
              class="w-1/2 border rounded px-2 py-1" />
          </div>
          <div class="mt-3 flex gap-2">
            <button @click="applyFilter" class="bg-black text-white px-3 py-1 rounded">
              Filter
            </button>
            <button @click="clearFilter" class="bg-gray-300 px-3 py-1 rounded">
              Clear
            </button>
          </div>
        </div>

        <!-- Category Filter (optional, যদি categories পাঠাও) -->
        <div v-if="props.filters?.categories" class="bg-white rounded shadow p-4">
          <h3 class="font-semibold mb-3">Categories</h3>
          <div class="space-y-2">
            <label v-for="category in props.filters.categories" :key="category.id" class="flex items-center gap-2">
              <input type="checkbox" :value="category.slug" />
              {{ category.name }}
            </label>
          </div>
        </div>
      </aside>

      <!-- Product List -->
      <div class="col-span-12 md:col-span-9">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-4">
          <Link href="/" class="hover:underline">Home</Link> /
          <span> Categories </span> /
          <span class="font-semibold">{{ category.name }}</span>
        </nav>

        <h2 class="text-xl font-bold mb-6">Products Of {{ category.name }}</h2>

        <!-- Products -->
        <div v-if="products.data.length" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <div v-for="product in products.data" :key="product.id" 
            class="bg-white border rounded-lg shadow-sm hover:shadow-md p-4 flex flex-col">
            <div class="relative">
              <!-- discount badge -->
              <span v-if="product.discount" 
                class="absolute top-2 left-2 bg-orange-500 text-white text-xs px-2 py-1 rounded">
                {{ product.discount }}%
              </span>
              <img :src="product.image" :alt="product.name"
                class="h-40 w-full object-contain mb-3" />
            </div>

            <h3 class="font-medium text-sm mb-1">{{ product.name }}</h3>
            <div class="mt-2 text-center">
            <span class="text-lg font-bold text-gray-900">৳ {{ product.selling_price }}</span>
            <span class="ml-2 text-sm text-gray-500 line-through">৳ {{ product.original_price }}</span>
          </div>

            <div class="mt-3 flex gap-2">
              <Link :href="`/product/${product.slug}`"
                class="flex-1 text-center bg-black text-white text-sm py-1 rounded">
                View
              </Link>
              <button class="flex-1 text-center bg-yellow-500 text-white text-sm py-1 rounded">
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <div v-else class="text-gray-600">
          No products found in this category.
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center gap-2">
          <button
            v-if="products.prev_page_url"
            @click="$inertia.visit(products.prev_page_url)"
            class="px-4 py-2 bg-gray-200 rounded">
            Prev
          </button>
          <button
            v-if="products.next_page_url"
            @click="$inertia.visit(products.next_page_url)"
            class="px-4 py-2 bg-gray-200 rounded">
            Next
          </button>
        </div>
      </div>
    </div>
  </section>
  <Footer />
</template>
