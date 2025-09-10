<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay, Pagination } from 'swiper/modules'
import 'swiper/swiper-bundle.css'

const props = defineProps<{
  sliders: Array<{
    id: string
    name: string
    description: string
    image: string
    status: boolean
  }>
}>()
</script>

<template>
  <div class="w-full md:w-4/5 mx-auto">
    <Swiper
      :modules="[Pagination, Autoplay]"
      :pagination="{ clickable: true }"
      :autoplay="{ delay: 3000 }"
      loop
      class="h-full"
    >
      <SwiperSlide
        v-for="(slider, index) in props.sliders"
        :key="slider.id"
      >
        <div class="bg-black text-white rounded-md overflow-hidden flex flex-col md:flex-row justify-between items-center px-6 py-8 gap-4">
          <div class="max-w-md text-center md:text-left">
            <h2 class="text-2xl md:text-4xl font-bold mb-2">{{ slider.name }}</h2>
            <p class="text-sm mb-4">{{ slider.description }}</p>
            <a href="#" class="text-white underline text-sm">Shop Now →</a>
          </div>
          <img :src="slider.image" class="h-40 md:h-64 object-cover rounded shadow" />
        </div>
      </SwiperSlide>
    </Swiper>
  </div>
</template>
