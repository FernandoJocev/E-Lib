<template>
  <div>
    Login

    <form @submit="Login">
      <input type="email" name="email" v-model="FormData.email" />
      <input type="password" name="password" v-model="FormData.password" />
      <button>Login</button>
    </form>
    {{ state?.message }}
    Tidak punya akun?
    <router-link to="/Register">Register</router-link>
  </div>
</template>

<script>
import { onMounted, reactive } from 'vue'
import axios from 'axios'
import Crypt from 'crypto-js'

const API = axios.create({
  baseURL: 'http://elib.infinityfreeapp.com/api/',
})

export default {
  setup() {
    onMounted(() => {
      const token = sessionStorage.getItem('token')

      if (token != null) {
        return (window.location.href = '/Home')
      }
    })

    const state = reactive({ message: null })

    const FormData = reactive({
      email: '',
      password: '',
    })

    const Login = async (e) => {
      e.preventDefault()

      try {
        const { data } = await API.post('auth/login', FormData)

        console.log(data.token)

        const loginToken = Crypt.AES.encrypt(
          JSON.stringify(data.token),
          '123'
        ).toString()

        sessionStorage.setItem('token', loginToken)
        return (window.location.href = '/Home')
      } catch (e) {
        state.message = e.response.data.message
        return
      }
    }

    return { Login, FormData, state }
  },
}
</script>
