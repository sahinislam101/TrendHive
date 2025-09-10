<template>
  <div class="w-full md:w-1/5 border-r border-gray-200 relative">
    <ul class="space-y-4 text-sm p-4">
      <li
        v-for="item in categories"
        :key="item.id"
        class="group relative hover:text-red-500 cursor-pointer"
      >
        <div class="flex justify-between items-center">
          <span>
            <Link :href="`/category/${item.slug}`" class="hover:underline">
              {{ item.name }}
            </Link>
          </span>
          <span v-if="item.subs?.length">&#8250;</span>
        </div>

        <!-- Subcategories on hover -->
        <ul
          v-if="item.subs?.length"
          class="absolute left-full top-0 w-48 bg-white shadow-md border rounded p-2 hidden group-hover:block z-50"
        >
          <li
            v-for="sub in item.subs"
            :key="sub.id"
            class="hover:text-red-500 py-1 px-2"
          >
            <Link :href="`/sub-category/${sub.slug}`">
              {{ sub.name }}
            </Link>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  categories: Array
})
</script>
