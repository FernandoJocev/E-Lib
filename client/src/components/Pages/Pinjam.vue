<template>
  <Top title="Peminjaman Buku" />
  <div class="qrcode">
    <QrcodeVue
      :value="'http://localhost:5173/Admin/Pinjam/' + state?.user?.id"
      size="250"
      level="H"
    />
  </div>
  <div class="lists">
    <div v-for="datas in state?.data?.detail_pinjam" class="card">
      <div class="left-content">
        <img :src="datas?.buku?.cover_buku" :alt="datas?.buku?.nama_buku" />
      </div>
      <div class="mid-content">
        <p>Title</p>
        <h1>{{ datas?.buku?.nama_buku }}</h1>
        <p>Author</p>
        <h1>{{ datas?.buku?.penulis }}</h1>
        <p>Tanggal pinjam</p>
        <h1>{{ format_date(state?.data?.tgl_peminjaman) }}</h1>
      </div>
      <div class="right-content">
        <router-link :to="'/Detail/' + datas?.buku?.id">Detail</router-link>
      </div>
    </div>
  </div>
  <router-link class="main-button" to="/">Back</router-link>
</template>

<script>
import Top from '../layouts/Top-section.vue'
import { reactive, onMounted } from 'vue'
import axios from 'axios'
import moment from 'moment'
import Crypt from 'crypto-js'
import QrcodeVue from 'qrcode.vue'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

const token = sessionStorage.getItem('token')

export default {
  components: {
    Top,
    QrcodeVue,
  },

  setup() {
    onMounted(async () => {
      const bytes = Crypt.AES.decrypt(token, '123')
      const user = JSON.parse(bytes.toString(Crypt.enc.Utf8))
      state.user = user
      const { data } = await API.get(`main/pinjam/${user.id}`)

      state.data = data
    })

    const state = reactive({ data: null, user: null })

    return { state }
  },

  methods: {
    format_date(value) {
      return moment(String(value)).format('DD MMM yyyy')
    },
  },
}
</script>
