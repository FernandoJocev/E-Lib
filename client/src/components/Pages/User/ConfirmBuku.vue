<template>
  <div class="confirm-buku-container" style="height: 100vh">
    <LoadingSection v-if="state?.loading === true" />
    <Top />
    <div
      class="success"
      v-if="state?.message != null"
      style="
        display: flex;
        height: 80%;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      "
    >
      <h1>{{ state?.message }}</h1>
      <router-link class="main-button" to="/">Kembali ke Home</router-link>
    </div>
    <div
      class="error"
      v-if="state?.error != null"
      style="
        display: flex;
        height: 85%;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      "
    >
      <Error />
      <router-link
        class="main-button"
        style="margin: 10px 0px !important"
        to="/"
        >Kembali to Home</router-link
      >
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Top from '../../layouts/Top-section.vue'
import { reactive, onMounted } from 'vue'
import User from '../../../utils/Token'
import Crypt from 'crypto-js'
import LoadingSection from '../../layouts/Loading.vue'
import { useRoute } from 'vue-router'
import Swal from 'sweetalert'
import Error from '../../layouts/500-Error.vue'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
})

export default {
  components: {
    Top,
    LoadingSection,
    Error,
  },

  setup() {
    const route = useRoute()
    onMounted(async () => {
      if (route.query.id != null && Object.keys(User).length >= 1) {
        const checkLink = route.fullPath.slice(1, 8)
        // const bytes = Crypt.AES.decrypt(route.query.id, '321')
        // console.log(route.query.id)
        // const id = JSON.parse(bytes.toString(Crypt.enc.Utf8))
        // console.log(id)
        if (checkLink === 'Confirm') {
          try {
            const { data } = await API.post(
              `main/confirm/${route.query.id}`
            ).then((data) => {
              state.loading = false
              state.message = data.data.message
              Swal({
                title: 'Buku berhasil di pinjam',
                icon: 'success',
                buttons: true,
              })
            })
            return
          } catch (e) {
            state.loading = false
            state.error = e.response.data.message
            return
          }
        }
        try {
          const { data } = await API.post(`main/return/${route.query.id}`).then(
            (data) => {
              state.loading = false
              state.message = data.data.message
              Swal({
                title: 'Buku berhasil di kembalikan',
                icon: 'success',
                buttons: true,
              })
            }
          )
          return
        } catch (e) {
          state.loading = false
          state.error = e.response.data.message
          return
        }
      }
      return (window.location.href = '/')
    })

    const state = reactive({ loading: true, message: null, error: null })

    return { state }
  },
}
</script>
