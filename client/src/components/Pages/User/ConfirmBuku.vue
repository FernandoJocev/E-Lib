<template>
  <LoadingSection v-if="state.loading === true" />
  <div class="confirm-buku-container">
    <Top />
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

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
})

export default {
  components: {
    Top,
    LoadingSection,
  },

  setup() {
    const route = useRoute()
    onMounted(async () => {
      if (route.query.id != null) {
        // const bytes = Crypt.AES.decrypt(route.query.id, '321')
        // console.log(route.query.id)
        // const id = JSON.parse(bytes.toString(Crypt.enc.Utf8))
        // console.log(id)
        const { data } = await API.post(`main/confirm/1`)
        return (state.loading = false)
      }
      return (window.location.href = '/')
    })

    const state = reactive({ loading: false })

    return { state }
  },
}
</script>
