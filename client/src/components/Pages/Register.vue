<template>
  <div class="register-container">
    <div class="top-title">
      <div
        style="
          display: flex;
          flex-direction: column;
          align-items: center;
          position: relative;
        "
      >
        <i
          class="fa fa-graduation-cap"
          style="color: #0047ff; position: absolute; bottom: 28px; right: 7px"
        ></i>
        <h1 style="font-weight: 500">E-LIB</h1>
      </div>
      <h1 style="color: black">Daftar</h1>
    </div>

    <div class="form-section" @submit="Register">
      <form>
        <div class="input">
          <label for="nama">Nama</label>
          <i class="fa fa-user"></i>
          <input
            type="text"
            placeholder="Masukkan nama anda"
            name="nama"
            v-model="formData.name"
          />
        </div>
        <div class="input">
          <label for="sekolah">Sekolah</label>
          <i class="fa fa-graduation-cap"></i>
          <input
            type="text"
            placeholder="Masukkan sekolah anda"
            name="sekolah"
            v-model="formData.sekolah"
          />
        </div>
        <!-- <div class="input">
          <label for="nis">NIS</label>
          <i></i>
          <input
            type="text"
            placeholder="Masukkan NIS anda"
            name="nis"
            v-model="formData.nis"
          />
        </div> -->
        <div class="input">
          <label for="email">Email</label>
          <i class="fa fa-envelope"></i>
          <input
            type="email"
            placeholder="Masukkan email anda"
            name="email"
            v-model="formData.email"
          />
        </div>
        <div class="input">
          <label for="password">Kata sandi</label>
          <i class="fa fa-lock"></i>
          <input
            type="password"
            placeholder="Masukkan kata sandi Anda"
            name="password"
            v-model="formData.password"
          />
        </div>
        <button type="submit">Daftar</button>
        <p>Sudah Mendaftar? <router-link to="/">Masuk</router-link></p>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { reactive } from 'vue'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  setup() {
    const formData = reactive({
      name: '',
      sekolah: '',
      nis: '',
      email: '',
      password: '',
    })

    const state = reactive({ message: null })

    const Register = async (e) => {
      e.preventDefault()

      try {
        const { data } = await API.post('auth/register', formData)

        state.message = data.message
      } catch (e) {
        state.message = e.response.data.message
      }

      setTimeout(() => {
        state.message = ''
      }, 3000)
    }

    return { formData, state, Register }
  },
}
</script>

<style scoped>
.register-container {
  display: flex;
  height: 100vh;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.top-title {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 50px;
}

.form-section form {
  display: flex;
  flex-direction: column;
  row-gap: 10px;
  position: relative;
}

.form-section form input,
input:focus {
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #aaaaaa;
  outline: none;
}
</style>
