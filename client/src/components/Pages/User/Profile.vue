<template>
  <div class="profile-container">
    <Top />
    <div class="profile-content-container">
      <div class="left-content">
        <img
          v-if="User?.foto_profil == null"
          :src="Images.LautBercerita"
          alt="Profile Picture"
        />
        <img v-else :src="User?.foto_profil" alt="Profile Picture" />
        <div class="button">
          <button class="update-profile" @click="updateProfilePict">
            Ganti profil
          </button>
          <button class="delete-profile" @click="deleteProfilePict">
            Hapus profil
          </button>
        </div>
      </div>

      <div class="right-content">
        <form action="">
          <div class="form-item">
            <label for="nama">Nama :</label>
            <input type="text" name="nama" :value="User?.name" />
          </div>
          <div class="form-item">
            <label for="email">Email :</label>
            <input type="email" name="email" :value="User?.email" />
          </div>
          <div class="form-item">
            <label for="sekolah">Sekolah :</label>
            <input type="text" name="sekolah" value="" />
          </div>
          <div class="update-button">
            <i class="fa-regular fa-pen-to-square"></i>
            <router-link to="">ubah</router-link>
          </div>
          <button class="logout-button">Logout</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted } from 'vue'
import Top from '../../layouts/Top-section.vue'
import Images from '../../../utils/config-image'
import User from '../../../utils/Token'

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
  },
}
</script>
