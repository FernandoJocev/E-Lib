<template>
  <div>
    <Top title="Tambahkan Buku" />

    <h1>Add Book</h1>
    <form>
      <label>Nama Buku : </label>
      <input type="text" name="nama_buku" v-model="FormData.nama_buku" />
      <br />
      <label>Jumlah Halaman : </label>
      <input type="number" name="jlh_halaman" v-model="FormData.jlh_halaman" />
      <br />
      <label>Cover Buku : </label>
      <input type="file" ref="file" name="cover_buku" @change="fileHandler" />
      <br />
      <label>Nama Penulis : </label>
      <input type="text" name="penulis" v-model="FormData.penulis" />
      <br />
      <label>Nama Penerbit : </label>
      <input type="text" name="penerbit" v-model="FormData.penerbit" />
      <br />
      <label>ISBN : </label>
      <input type="text" name="isbn" v-model="FormData.isbn" />
      <br />
      <button class="button" @click="AddProduct">Tambahkan Buku</button>
    </form>
    <p>{{ state?.message }}</p>
    <router-link class="main-button" to="/">Back</router-link>
  </div>
</template>

<script>
import axios from 'axios'
import { reactive, ref } from 'vue'
import Top from '../layouts/Top-section.vue'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  components: {
    Top,
  },

  setup() {
    const FormData = reactive({
      nama_buku: '',
      jlh_halaman: '',
      cover_buku: '',
      penulis: '',
      penerbit: '',
      isbn: '',
    })

    const file = ref(null)

    const state = reactive({ message: null, data: null })

    const fileHandler = () => {
      const image = file.value.files[0]
      const reader = new FileReader()
      reader.onloadend = function () {
        const cover = reader.result.replace('data:', '').replace(/^.+,/, '')

        FormData.cover_buku = cover
      }
      reader.readAsDataURL(image)
    }

    const AddProduct = async (e) => {
      e.preventDefault()
      const { data } = await API.post('add/addBook', FormData).catch(function (
        error
      ) {
        if (error.response) {
          state.message = error.response.data.message
        }
      })

      state.message = data.message

      setTimeout(() => {
        state.message = ''
      }, 3000)
    }

    return { AddProduct, fileHandler, FormData, file, state }
  },
}
</script>

<style scoped>
.main-button {
  width: 100px;
}
</style>
