<template>
  <Header />
  <section class="py-10 max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row gap-8 items-start">

      <!-- ✅ Product Image (Fixed Size) -->
      <div class="w-full lg:w-1/2 flex justify-center items-center border p-4 rounded bg-white sticky top-10 self-start">
        <img :src="product.image" class="max-w-full max-h-[400px] object-contain" />
      </div>

      <!-- ✅ Product Info -->
      <div class="w-full lg:w-1/2 flex flex-col gap-4">

        <!-- Product Name -->
        <h1 class="text-3xl font-bold text-white">{{ product.name }}</h1>

        <!-- Stock -->
        <span :class="product.stock > 0 ? 'text-green-400' : 'text-red-400'" class="font-medium">
          {{ product.stock > 0 ? 'In Stock' : 'Out of Stock' }}
        </span>

        <!-- Price -->
        <p class="text-lg text-gray-400 line-through">${{ product.original_price }}</p>
        <p  class="text-2xl font-semibold text-red-600">${{ product.selling_price }}</p>

        <!-- ✅ Small Description -->
        <p v-if="product.small_description" class="text-gray-400 italic text-base">
          {{ product.small_description }}
        </p>

        <!-- ✅ Full Description with Read More -->
        <div>
          <p class="text-gray-300 leading-relaxed transition-all duration-300 ease-in-out"
             :class="{ 'line-clamp-5': !showFullDescription }">
            {{ product.description }}
          </p>

          <button 
            v-if="product.description?.length > 200" 
            @click="toggleDescription" 
            class="text-blue-500 mt-2 hover:underline text-sm font-medium"
          >
            {{ showFullDescription ? 'Show Less' : 'Read More' }}
          </button>
        </div>

        <!-- ✅ Quantity & Buy Now -->
        <div class="flex items-center gap-3 mt-4">
          <button @click="decreaseQty" class="border px-3 py-1 rounded text-white">-</button>
          <span class="text-white">{{ quantity }}</span>
          <button @click="increaseQty" class="border px-3 py-1 rounded text-white">+</button>
          <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded shadow">
            Buy Now
          </button>
        </div>

        <!-- ✅ Delivery Info -->
        <div class="mt-6 flex flex-col gap-2 text-sm text-gray-400">
          <div class="flex items-center gap-2">🚚 Free Delivery – Enter your postal code</div>
          <div class="flex items-center gap-2">🔄 Free 30 Days Return</div>
        </div>

      </div>
    </div>
  </section>
  <Footer />
</template>

<script setup>
import Footer from '@/components/client_side/layout/Footer.vue';
import Header from '@/components/client_side/layout/Header.vue';
import { ref } from 'vue';

const props = defineProps({
  product: Object,
});

const quantity = ref(1);
const showFullDescription = ref(false);

function increaseQty() {
  quantity.value++;
}

function decreaseQty() {
  if (quantity.value > 1) quantity.value--;
}

function toggleDescription() {
  showFullDescription.value = !showFullDescription.value;
}
</script>

<style scoped>
/* Description line clamp */
.line-clamp-5 {
  display: -webkit-box;
  -webkit-line-clamp: 5;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
