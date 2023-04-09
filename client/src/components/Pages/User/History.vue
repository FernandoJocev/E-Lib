<template>
  <div>
    <Top title="History" />

    <div class="no-history" v-if="state?.data === null">
      <h1>Kamu belum meminjam buku, silahkan pinjam</h1>
    </div>

    <div class="lists" v-if="state?.data != null">
      <div v-for="datas in state?.data">
        <div class="card" v-for="data in datas.detail_pinjam">
          <div class="left-content">
            <img :src="data?.buku?.cover_buku" alt="Laut Bercerita" />
          </div>
          <div class="mid-content">
            <p>Title</p>
            <h1>{{ data?.buku?.nama_buku }}</h1>
            <p>Author</p>
            <h1>{{ data?.buku?.penulis }}</h1>
            <p>Tanggal pinjam</p>
            <h1>{{ datas?.tgl_peminjaman }}</h1>
          </div>
          <div class="right-content">
            <router-link :to="'/Detail/' + data?.buku?.id">Detail</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
  <router-link class="main-button" to="/">Back</router-link>
</template>

<script>
import Top from '../../layouts/Top-section.vue'
import { onMounted, reactive } from 'vue'
import axios from 'axios'
import Images from '../../../utils/config-image'
import User from '../../../utils/Token'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  data() {
    return { Images }
  },

  components: {
    Top,
  },

  setup() {
    onMounted(async () => {
      if (Object.keys(User) <= 0) {
        window.location.href = '/'
        return
      }
      const { data } = await API.get(`main/history/${User.id}`)

      console.log(data)

      if (data.length >= 1) {
        state.data = data
      }
    })

    const state = reactive({ data: null })
    return { state }
  },
}
</script>

<style scoped>
.main-button {
  width: 100px;
}
</style>
