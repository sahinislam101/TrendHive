<script setup>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Undo2 } from 'lucide-vue-next';
import { Head, Link } from '@inertiajs/vue3';




const props = defineProps({
  product: Object,
  categories: Array,
  brands: Array,
});

const form = useForm({
  name: props.product.name,
  slug: props.product.slug,
  description: props.product.description,
  small_description: props.product.small_description,
  category_id: props.product.category_id,
  brand_id: props.product.brand_id,
  original_price: props.product.original_price,
  selling_price: props.product.selling_price,
  sku: props.product.sku,
  stock: props.product.stock,
  image: props.product.image,
  best_sell: props.product.best_sell,
  flash_sales: props.product.flash_sales,
  status: props.product.status,
});

</script>

<template>

  <Head title="Product – Edit" />

  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="p-6 w-full mx-auto bg-gray-100 rounded shadow">
      <h1 class="text-xl font-semibold">Edit Product</h1>
      <form @submit.prevent="form.put(`/products/${product.slug}`)">

        <!-- Name -->
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
          <input v-model="form.name" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white input"
            required />
          <p v-if="form.errors.name">{{ form.errors.name }}</p>
        </div>
        <!-- Description -->
        <div>

          <label for="description"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
          <textarea v-model="form.description" rows="5"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input"
            placeholder=""></textarea>
          <p v-if="form.errors.description">{{ form.errors.description }}</p>
        </div>

        <!-- Small Description -->
        <div>
          <label for="small_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shot
            Description</label>
          <textarea v-model="form.small_description" name="" id="" rows="3"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input"></textarea>
          <p v-if="form.errors.small_description">{{ form.errors.small_description }}</p>
        </div>

        <!-- original_price -->
        <div class="flex gap-4">
          <div class="w-1/2">
            <label for="original_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">original_price</label>
            <input v-model="form.original_price" type="number" id="original_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
            dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            <p v-if="form.errors.original_price">{{ form.errors.original_price }}</p>
          </div>
          <!-- selling_price -->
          <div class="w-1/2">
            <label for="selling_price"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">selling_price</label>
            <input v-model="form.selling_price" type="number" id="selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
            dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
            <p v-if="form.errors.selling_price">{{ form.errors.selling_price }}</p>
          </div>
        </div>

        <!-- Stock -->
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="stock">Stock</label>
          <input v-model="form.stock"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white input"
            type="number">
          <p v-if="form.errors.stock">{{ form.errors.stock }}</p>
        </div>

        <!-- Checkboxes -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
          <label class="flex items-center gap-2">
            <input type="checkbox" v-model="form.flash_sales" /> Flash Sales
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" v-model="form.best_sell" /> Best Sell
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" v-model="form.status" /> Active
          </label>
        </div>

        <!-- Category, Sub category, Brand -->
        <div class="flex gap-4">

          <!-- Category -->

          <div class="w-1/3">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select id="category" v-model="form.category_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
             dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="">Select Category</option>
              <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
          </div>


          <!-- Brand -->

          <div class="w-1/3">
            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
            <select id="brand" v-model="form.brand_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
             dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="">Select Brand</option>
              <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
            </select>
          </div>

        </div>
        <!-- Image -->
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image URL</label>
          <input v-model="form.image" placeholder="https://example.com/image.jpg" type="text"
            class="block w-full p-6 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <p v-if="form.errors.image">{{ form.errors.image }}</p>

        <!-- Submit -->
        <div class="flex items-center gap-2 ">
          <button type="submit" class="bg-blue-600 text-white px-6 py-1 rounded hover:bg-blue-700"
            :disabled="form.processing">
            Save
          </button>
          <Link href="/products"
            class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-md transition">
          <Undo2 class="w-4 h-4 mr-1" /> Back</Link>
        </div>


      </form>
    </div>

  </AppLayout>
</template>
