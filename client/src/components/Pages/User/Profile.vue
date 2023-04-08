<template>
  <div class="profile-container">
    <Top />
    <div class="profile-content-container">
      <div class="left-content">
        <img
          v-if="User?.foto_profil == null"
          :src="Images.LautBercerita"
          alt="Profile Picture"
          id="previewImage"
        />
        <img
          v-else
          :src="User?.foto_profil"
          alt="Profile Picture"
          id="previewImage"
        />
        <div class="button">
          <button class="update-profile" @click="openWidget">
            Ganti profil
          </button>
          <button class="delete-profile" @click="updateProfile('delete')">
            Hapus profil
          </button>
        </div>
      </div>

      <div class="right-content">
        <form>
          <div class="form-item">
            <label for="nama">Nama :</label>
            <input type="text" name="nama" v-model="FormData.name" />
          </div>
          <div class="form-item">
            <label for="email">Email :</label>
            <input type="email" name="email" v-model="FormData.email" />
          </div>
          <div class="form-item">
            <label for="sekolah">Sekolah :</label>
            <input type="text" name="sekolah" value="" />
          </div>
          <div class="update-button">
            <i class="fa-regular fa-pen-to-square"></i>
            <router-link to="" @click="updateProfile">ubah</router-link>
          </div>
          <button class="logout-button" @click="Logout">Logout</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, reactive } from 'vue'
import Top from '../../layouts/Top-section.vue'
import Images from '../../../utils/config-image'
import User from '../../../utils/Token'
import axios from 'axios'
import Crypt from 'crypto-js'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  data() {
    return { Images, User }
  },

  components: {
    Top,
  },

  setup() {
    onMounted(() => {
      if (User == null) {
        return (window.location.href = '/')
      }
    })

    const state = reactive({ message: null })

    const FormData = reactive({
      foto_profil: User?.foto_profil,
      name: User?.name,
      email: User?.email,
      sekolah_id: '',
    })

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

          FormData.foto_profil = result.info.secure_url
        }
      }
    )

    const Logout = () => {
      sessionStorage.removeItem('token')
      return (window.location.href = '/')
    }

    const updateProfile = async (e) => {
      try {
        if (e === 'delete') {
          const { data } = await API.post(`auth/updateProfile/${User.id}`)
          sessionStorage.setItem(
            'token',
            Crypt.AES.encrypt(JSON.stringify(data.user), '123').toString()
          )
          window.location.reload()
          return
        }
        e.preventDefault()
        const { data } = await API.post(
          `auth/updateProfile/${User.id}`,
          FormData
        )

        sessionStorage.setItem(
          'token',
          Crypt.AES.encrypt(JSON.stringify(data.user), '123').toString()
        )
        window.location.reload()
        return
      } catch (e) {
        state.message = e.response
        return
      }
    }

    return { Widget, FormData, state, updateProfile, Logout }
  },

  methods: {
    openWidget(e) {
      e.preventDefault()
      this.Widget.open()
    },
  },
}
</script>
