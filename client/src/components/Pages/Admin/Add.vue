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
      <img id="previewImage" src="" alt="" />
      <button id="upload_widget" class="cloudinary-button" @click="uploadImage">
        Upload Image
      </button>
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
import Crypt from 'crypto-js'
import { reactive, ref, onMounted } from 'vue'
import Top from '../../layouts/Top-section.vue'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  components: {
    Top,
  },

  setup() {
    // onMounted(() => {
    //   let decrypt = Crypt.AES.decrypt(sessionStorage.getItem('token'), '123')
    //   let text = JSON.parse(decrypt.toString(Crypt.enc.Utf8))
    //   console.log(text)
    // })
    const FormData = reactive({
      nama_buku: '',
      jlh_halaman: '',
      penulis: '',
      penerbit: '',
      cover_buku: '',
      isbn: '',
    })

    const file = ref(null)

    const state = reactive({ message: null, data: null })

    const Widget = cloudinary.createUploadWidget(
      {
        cloudName: 'dxqu8d8z8',
        uploadPreset: 'E-Lib_Assets',
      },
      (error, result) => {
        if (!error && result && result.event === 'success') {
          document
            .getElementById('previewImage')
            .setAttribute('src', result.info.secure_url)

          FormData.cover_buku = result.info.secure_url
        }
      }
    )

    const AddProduct = async (e) => {
      e.preventDefault()

      try {
        const { data } = await API.post('add/addBook', FormData)
        console.log(data)

        state.message = data.message
      } catch (error) {
        state.message = error.response.data.message
      }

      setTimeout(() => {
        state.message = ''
      }, 3000)
    }

    // const uploadImage = () => {
    //   Widget.open()
    // }

    return { AddProduct, FormData, file, state, Widget }
  },

  methods: {
    uploadImage(e) {
      e.preventDefault()
      this.Widget.open()
    },
  },
}
</script>

<style scoped>
.main-button {
  width: 100px;
}
</style>
