<template>
  <Top title="Home" />

  <swiper
    v-if="Object.keys(route.query).length == 0"
    :slides-per-view="1"
    :space-between="40"
    :autoplay="{ delay: 2000, disableOnInteraction: false }"
    :speed="1500"
    :loop="true"
    :navigation="true"
    :modules="modules"
    :centered-slides="true"
    :pagination="{ clickable: true }"
  >
    <swiper-slide>
      <div class="banner">
        <img
          :src="Images.Banner"
          alt="Banner"
          style="width: 100% !important; height: 600px !important"
        />
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="banner">
        <img
          :src="Images.Banner"
          alt="Banner"
          style="width: 100% !important; height: 600px !important"
        />
      </div>
    </swiper-slide>
  </swiper>

  <div class="books-category" v-if="Object.keys(route.query).length == 0">
    <router-link to="/" style="color: black">
      <div class="category">
        <img :src="Images.BukuKelas10" alt="Buku Kelas 10" />
        <p>Buku Kelas 10</p>
      </div>
    </router-link>

    <router-link to="/" style="color: black">
      <div class="category">
        <img :src="Images.BukuKelas11" alt="Buku kelas 11" />
        <p>Buku Kelas 11</p>
      </div>
    </router-link>

    <router-link to="/" style="color: black">
      <div class="category">
        <img :src="Images.BukuKelas12" alt="Buku Kelas 12" />
        <p>Buku Kelas 12</p>
      </div>
    </router-link>

    <router-link to="/" style="color: black">
      <div class="category">
        <img :src="Images.BukuBaru" alt="Buku Baru" />
        <p>Buku Baru</p>
      </div>
    </router-link>

    <router-link to="/History" style="color: black">
      <div class="category">
        <img :src="Images.HistoryPeminjaman" alt="History Peminjaman" />
        <p>History Peminjaman</p>
      </div>
    </router-link>
  </div>

  <div class="books-section">
    <div class="books-title-section">
      <div class="books-title">
        <h2 style="font-weight: 500">Buku Pilihan</h2>
      </div>
      <div class="lihat-semua">
        <router-link to="/" style="color: #caa648; font-weight: 500">
          Lihat semua
        </router-link>
      </div>
    </div>

    <div class="books-lists">
      <div class="books" v-for="data in state?.data">
        <img v-bind:src="data?.cover_buku" v-bind:alt="data?.nama_buku" />
        <p>{{ data?.nama_buku }}</p>
        <h2>{{ data?.penulis }}</h2>
        <p class="category-label" v-if="data?.kategori">
          {{ data?.kategori?.nama }}
        </p>
        <router-link v-bind:to="'/Detail/' + data?.id">Detail</router-link>
      </div>
    </div>

    <!-- <div class="books-lists">
        <div class="books">
          <img
            v-bind:src="'data:image/png;base64,' + item?.cover_buku"
            v-bind:alt="item?.nama_buku"
          />
          <p>{{ item?.nama_buku }}</p>
          <h2>{{ item?.penulis }}</h2>
          <router-link v-bind:to="'/Detail/' + item?.id">Detail</router-link>
        </div>
      </div> -->

    <div class="books-title-section">
      <div class="books-title">
        <h2 style="font-weight: 500">Buku Terpopuler</h2>
      </div>
      <div class="lihat-semua">
        <router-link to="/" style="color: #caa648; font-weight: 500">
          Lihat semua
        </router-link>
      </div>
    </div>
    <div class="books-lists">
      <div class="books" v-for="item in state?.data">
        <img v-bind:src="item?.cover_buku" v-bind:alt="item?.nama_buku" />
        <p>{{ item?.nama_buku }}</p>
        <h2>{{ item?.penulis }}</h2>
        <router-link v-bind:to="'/Detail/' + item?.id">Detail</router-link>
      </div>
    </div>
  </div>

  <!-- <router-link to="/About">About</router-link>
  <br />
  <router-link to="/History">History</router-link>
  <br />
  <router-link to="/Add">Add book</router-link> -->
</template>

<script>
import { onMounted, reactive } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import axios from 'axios'
import Top from '../../layouts/Top-section.vue'
import { Autoplay, Pagination, Navigation } from 'swiper'
import Images from '../../../utils/config-image'
import { useRoute } from 'vue-router'

import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/navigation'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  components: {
    Top,
    Swiper,
    SwiperSlide,
  },

  data() {
    return {
      Images,
    }
  },

  setup() {
    const state = reactive({ data: null })

    const route = useRoute()
    onMounted(async () => {
      if (Object.keys(route.query).length >= 1) {
        const { data } = await API.get(
          `main/searchBooks/?search=${route.query.search}`
        )
        state.data = data.data
        return
      }
      const { data } = await API.get('main/books')
      state.data = data.datas
      return
    })
    // const onSwiper = (swiper) => {
    //   console.log(swiper)
    // }
    // const onSlideChange = () => {
    //   console.log('slide change')
    // }

    return {
      modules: [Autoplay, Pagination, Navigation],
      state,
      route,
    }
  },
}
</script>

<style scoped>
img {
  width: 200px !important;
  height: 250px !important;
}

/* .books-container {
  display: flex;
  justify-content: space-between;
  padding: 20px 20px;
} */
</style>
