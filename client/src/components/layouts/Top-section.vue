<template>
  <LoadingPage v-if="state.loading == true" />
  <div class="title" id="title">
    <div class="title-left">
      <router-link style="color: black" to="/">
        <div class="e-lib">
          <h1 class="font-medium">E-LIB</h1>
          <h2>Electronic Library</h2>
        </div>
      </router-link>
      <div class="kategori">
        <router-link class="button" to="/Kategori">Kategori</router-link>
      </div>
    </div>
    <div class="title-mid">
      <div class="search">
        <form @submit="Search">
          <input type="text" placeholder="Search" v-model="state.search" />
        </form>
      </div>
    </div>

    <div class="title-right">
      <!-- <div class="profile">
        <img src="../../assets/buku/Laut Bercerita.jpg" alt="" />
      </div> -->
      <div class="login no-account">
        <button @click="active('active')" v-if="User == null">Masuk</button>
        <div class="profile" id="profile" v-else>
          <img :src="Images.LautBercerita" alt="Profile User" ref="val" />
          <div class="dropdown-menu" v-if="state?.dropdown == true">
            <router-link to="/Profile">Profile</router-link>
            <hr style="width: 100%; border: 1px solid black" />
            <router-link :to="'/Pinjam/' + state?.user?.name"
              >Buku Dipinjam</router-link
            >
            <hr style="width: 100%; border: 1px solid black" />
            <router-link to="#" @click="Logout">Logout</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="background-blur" v-if="state?.active === true">
    <div class="login-section">
      <i class="fa fa-times-circle" @click="active"></i>
      <h1 style="font-weight: 550">E-Lib</h1>
      <h1>Electronic Library</h1>

      <form @submit="Login">
        <h1>Email</h1>
        <i class="fa fa-envelope"></i>
        <input
          type="email"
          placeholder="Masukkan alamat email anda"
          v-model="FormData.email"
          name="email"
        />
        <h1>Password</h1>
        <i class="fa fa-lock"></i>
        <input
          type="text"
          placeholder="Masukkan kata sandi anda"
          v-model="FormData.password"
          name="password"
        />
        <p style="color: rgba(0, 71, 255, 70%); margin-top: 5px">
          Lupa kata sandi?
        </p>
        <button type="submit">Masuk</button>
        <p style="text-align: center; margin: 10px 0px">
          Belum punya akun?
          <router-link to="/Register">Daftar</router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted, ref } from 'vue'
import axios from 'axios'
import Crypt from 'crypto-js'
import LoadingPage from '../layouts/Loading.vue'
import Images from '../../utils/config-image'
import User from '../../utils/Token'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  props: ['title'],

  data() {
    return { Images, User }
  },

  components: {
    LoadingPage,
  },

  setup() {
    onMounted(() => {
      if (User != null) {
        return (state.user = User)
      }
    })

    document.addEventListener('click', function handlerCloseDropdwon(e) {
      // console.log(val.value)

      // console.log(e.target.toString().includes(val.value))
      if (e.target != val.value) {
        state.dropdown = false
        return
      } else if (e.target === val.value && state.dropdown === true) {
        state.dropdown = false
        return
      }
      state.dropdown = true
      return
    })

    const val = ref()

    const state = reactive({
      data: null,
      active: false,
      message: null,
      dropdown: false,
      loading: false,
      user: null,
      search: null,
    })

    const active = (status) => {
      if (status === 'active') {
        state.active = true
      } else {
        state.active = false
      }
      return
    }

    const FormData = reactive({
      email: '',
      password: '',
    })

    const Login = async (e) => {
      e.preventDefault()

      try {
        state.loading = true
        const { data } = await API.post('auth/login', FormData)

        console.log(data.token)

        const loginToken = Crypt.AES.encrypt(
          JSON.stringify(data.token),
          '123'
        ).toString()

        sessionStorage.setItem('token', loginToken)
        return window.location.reload()
      } catch (e) {
        state.message = e.response.data.message
        return
      }
    }

    const Logout = () => {
      sessionStorage.removeItem('token')
      return window.location.reload()
    }

    return {
      state,
      Login,
      active,
      FormData,
      Logout,
      active,
      val,
    }
  },

  // beforeDestroy() {
  //   document.removeEventListener('click', function handlerCloseDropdwon(e) {
  //     const element = document.getElementsByClassName('.dropdown-menu')

  //     if (!element.includes(e.target)) {
  //       this.closeDropdown
  //     }
  //   })
  // },

  methods: {
    Search(e) {
      e.preventDefault()
      if (this.state.search != null) {
        return (window.location.href = `/?search=${this.state.search}`)
      }
      return
    },
  },
}
</script>

<style scoped>
a {
  color: rgba(0, 71, 255, 70%);
  font-size: 14px;
}

.login button {
  background-color: rgba(208, 191, 145, 15%);
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 10%);
  padding: 10px 20px;
  border-radius: 20px;
  border: 1px solid rgba(0, 0, 0, 15%);
  cursor: pointer;
  font-size: 18px;
}
</style>
