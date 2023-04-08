<template>
  <div>
    <Top title="Detail" />

    <div class="container">
      <div class="first-container">
        <div class="left-content">
          <img :src="state?.data?.cover_buku" alt="Laut Bercerita" />
        </div>
        <div class="right-content">
          <div class="left-right">
            <h1 style="font-weight: 500; color: rgb(0, 0, 0) !important">
              {{ state?.data?.nama_buku }}
            </h1>
            <h2 style="font-weight: normal !important">
              {{ state?.data?.penulis }}
            </h2>
          </div>
          <div class="right">
            <router-link to="" v-if="state?.buku === null" @click="Pinjam"
              >Pinjam buku</router-link
            >
            <p style="font-size: 20px" v-if="state?.status === 'pending'">
              <i>Silahkan scan barcode untuk meminjam buku</i>
            </p>
            <p style="font-size: 20px" v-if="state?.status === 'dipinjam'">
              <i>Buku sedang di pinjam</i>
            </p>
          </div>
          <hr />
          <h1>Jumlah Halaman</h1>
          <h2>{{ state?.data?.jlh_halaman }}</h2>
          <h1>Tanggal Terbit</h1>
          <h2>
            {{
              state?.data?.created_at != null
                ? format_date(state?.data?.created_at)
                : '-'
            }}
          </h2>
          <h1>Penerbit</h1>
          <h2>{{ state?.data?.penerbit }}</h2>
        </div>
        <div class="isbn">
          <h1>ISBN</h1>
          <h2>{{ state?.data?.isbn }}</h2>
          <h1>Terakhir pinjam</h1>
          <h2>
            {{
              state?.buku?.id == route.params.id
                ? format_date(
                    state?.data?.detail_pinjam_buku?.pinjam_buku
                      ?.tgl_pengembalian
                  )
                : '-'
            }}
          </h2>
        </div>
      </div>

      <div class="second-container">
        <div class="content">
          <h1>Deskripsi Buku</h1>
          <p>
            {{ state?.data?.deskripsi ? state?.data?.deskripsi : '-' }}
          </p>
        </div>
        <router-link to="/">Back to Home</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, reactive } from 'vue'
import { useRoute } from 'vue-router'
import Top from '../../layouts/Top-section.vue'
import axios from 'axios'
import moment from 'moment'
import Crypt from 'crypto-js'
import User from '../../../utils/Token'
import Swal from 'sweetalert'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  data() {
    return { User }
  },

  components: {
    Top,
  },

  setup() {
    const route = useRoute()

    const state = reactive({
      data: null,
      detail_pinjam: null,
      message: null,
      loading: false,
      buku: null,
      status: null,
      terakhir_pinjam: null,
    })

    const formData = reactive({
      id_user: '',
    })

    onMounted(() => {
      if (User == null) {
        return
      }
      formData.id_user = User.id
      getBook()
    })

    const getBook = async () => {
      const { data } = await API.post(
        `main/detail/${route.params.id}`,
        formData
      )

      data?.detail_pinjam?.detail_pinjam?.forEach((item) => {
        if (item.buku.id == route.params.id) {
          state.buku = item.buku
          state.status = data.detail_pinjam.status
        }
      })

      data?.terakhir_pinjam?.forEach((item) => {
        item.detail_pinjam.forEach((buku) => {
          state.terakhir_pinjam = buku
        })
      })

      state.detail_pinjam = data.detail_pinjam
      state.data = data.buku
      // console.log(state.terakhir_pinjam)
      // console.log(state.data)
      // console.log(state.detail_pinjam)
      // console.log(state.status)
      return
    }

    const Pinjam = async () => {
      try {
        const { data } = await API.post(
          `main/pinjam/${route.params.id}`,
          formData
        )
        Swal({
          title: 'Success',
          text: data.message,
          icon: 'success',
          button: true,
        }).then(() => {
          window.location.reload()
        })
      } catch (e) {
        Swal({
          title: 'Error',
          text: e.response.data.message,
          icon: 'error',
          button: true,
        }).then(() => {
          window.location.reload()
        })
      }
    }

    return { state, Pinjam, route }
  },

  methods: {
    format_date(value) {
      return moment(String(value)).format('DD MMM yyyy')
    },
  },
}
</script>

<style scoped>
img {
  width: 250px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

h1 {
  color: rgba(0, 0, 0, 60%) !important;
}

hr {
  margin: 20px 0px 20px 0px;
}

.container h2 {
  font-size: 21px;
  font-weight: 500;
}

.container {
  background-color: rgba(208, 191, 145, 15%);
  border: 2px solid rgba(0, 0, 0, 31%);
  display: flex;
  flex-direction: column;
  margin: 40px 40px;
  border-radius: 30px;
  padding: 50px 50px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 30%);
}

.first-container {
  display: flex;
  justify-content: flex-start;
}

.left-content {
  margin-right: 70px;
}

.right-content {
  flex: 1;
}

.isbn {
  position: absolute;
  left: 70%;
  top: 152px;
}

.second-container {
  margin-top: 40px;
}

.content h1 {
  color: #292d8b;
  font-weight: 550;
}

.content p {
  font-weight: 500;
}

a {
  display: block;
  margin: 10px 0px;
}
</style>
