<template>
  <div class="pinjam-container">
    <Loading v-if="state?.loading == true" />
    <Top title="Peminjaman Buku" />
    <div class="qrcode-container">
      <div class="qrcode" v-if="state?.status?.includes('pending')">
        <h1>QR Code Peminjaman</h1>
        <QrcodeVue
          :value="
            'http://localhost:5173/Confirm/' +
            state?.user?.name +
            '?id=' +
            state?.id_user
          "
          size="250"
          level="H"
        />
      </div>

      <div class="qrcode" v-if="state?.status?.includes('dipinjam')">
        <h1>QR Code Pengembalian</h1>
        <QrcodeVue
          :value="
            'http://localhost:5173/Return/' +
            state?.user?.name +
            '?id=' +
            state?.id_user
          "
          size="250"
          level="H"
        />
      </div>
    </div>

    <div class="no-books" v-if="state?.data === null">
      <h1>Kamu belum meminjam buku, silahkan pinjam hehe</h1>
    </div>

    <div class="lists" v-if="state?.data != null">
      <div v-for="data in state?.data">
        <div v-for="datas in data?.detail_pinjam" class="card">
          <div class="left-content">
            <img :src="datas?.buku?.cover_buku" :alt="datas?.buku?.nama_buku" />
          </div>
          <div class="mid-content">
            <p>Title</p>
            <h1>{{ datas?.buku?.nama_buku }}</h1>
            <p>Author</p>
            <h1>{{ datas?.buku?.penulis }}</h1>
            <p>Status</p>
            <h1>{{ data?.status === 'pending' ? 'Pending' : 'Dipinjam' }}</h1>
          </div>
          <div class="right-content">
            <router-link :to="'/Detail/' + datas?.buku?.id">Detail</router-link>
          </div>
        </div>
      </div>
    </div>
    <router-link class="main-button" to="/">Back</router-link>
  </div>
</template>

<script>
import Top from '../../layouts/Top-section.vue'
import { reactive, onMounted } from 'vue'
import axios from 'axios'
import moment from 'moment'
import QrcodeVue from 'qrcode.vue'
import User from '../../../utils/Token'
import Crypt from 'crypto-js'
import Loading from '../../layouts/Loading.vue'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  components: {
    Top,
    QrcodeVue,
    Loading,
  },

  setup() {
    onMounted(async () => {
      if (User == null) {
        return (window.location.href = '/')
      }
      state.loading = true
      state.user = User
      const token = Crypt.AES.encrypt(JSON.stringify(User.id), '321').toString()
      state.id_user = token
      const { data } = await API.get(`main/pinjam/${User.id}`)

      if (Object.keys(data).length >= 1) {
        let key = data?.indexOf()
        state.status = data[(key += 1)]?.status + ' ' + data[(key += 1)]?.status
        state.data = data
        state.loading = false
        return
      }
      state.loading = false
      return
    })

    const state = reactive({
      data: null,
      user: null,
      id_user: null,
      loading: false,
      status: null,
    })

    return { state }
  },

  methods: {
    format_date(value) {
      return moment(String(value)).format('DD MMM yyyy')
    },
  },
}
</script>
