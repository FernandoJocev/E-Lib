<template>
  <div class="category-container">
    <Top title="Category" />

    <div class="category-section">
      <div class="category-lists">
        <div class="category-title">
          <i
            class="fa fa-list"
            style="margin-top: 5px; font-weight: 550; font-size: 24px"
          ></i>
          <h1>Kategori</h1>
        </div>
        <div class="categories">
          <h1
            id="kateogri"
            data-key="all"
            class="active"
            @click="active(null, 'All')"
          >
            All
          </h1>
          <h1
            v-for="kategori in state?.kategori"
            id="kategori"
            :data-key="kategori?.id"
            @click="active(kategori?.id, kategori?.nama)"
          >
            {{ kategori?.nama }}
          </h1>
        </div>
        <router-link style="margin: 10px 0px" to="/">Back to Home</router-link>
      </div>

      <div class="books-section">
        <div class="books-title">
          <h1>{{ state?.title }}</h1>
        </div>
        <div class="no-data" v-if="state?.datas?.length <= 0">
          <h1>Maaf belum ada buku pada kategori ini</h1>
        </div>
        <div class="books-category-lists">
          <div class="books" v-for="data in state?.datas">
            <img :src="data?.cover_buku" alt="data?.nama_buku" />
            <p>{{ data?.penulis }}</p>
            <h1>{{ data?.nama_buku }}</h1>
            <p class="category-label">
              {{ data?.kategori?.nama }}
            </p>
            <router-link :to="'/Detail/' + data?.id">Detail</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Top from '../../layouts/Top-section.vue'
import { onMounted, reactive } from 'vue'
import { useRouter } from 'vue-router'

const API = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
})

export default {
  components: {
    Top,
  },

  setup() {
    onMounted(async () => {
      const router = useRouter()
      router.replace({ query: null })

      const { data } = await API.get('main/getKategori')

      state.kategori = data
      getAllBooks()
    })

    const state = reactive({
      kategori: null,
      datas: null,
    })

    const getAllBooks = async () => {
      const { data } = await API.get('main/books')

      state.datas = data.datas
    }

    const getBooksByCategory = async (id) => {
      if (id != null) {
        const { data } = await API.get(`main/booksByKategori/${id}`)

        state.datas = data
        return
      }
    }

    return { state, getBooksByCategory, getAllBooks }
  },

  methods: {
    active(id, nama) {
      this.state.title = nama
      const data = document.querySelectorAll('[id=kategori]')
      const all = document.querySelector('[data-key=all]')

      data.forEach((categories) => {
        categories.removeAttribute('class')
        all.removeAttribute('class')
      })

      if (id != null) {
        const category = document.querySelector(`[data-key="${id}"]`)
        category.setAttribute('class', 'active')
        this.$router
          .push({ path: 'Kategori', query: { id: `${id}` } })
          .then(() => {
            this.getBooksByCategory(this.$route.query.id)
          })
      } else if (id === null) {
        all.setAttribute('class', 'active')
        this.$router.replace({ query: null }).then(() => {
          this.getAllBooks()
        })
      }
      // console.log(categories)
    },
  },
}
</script>

<style scoped>
h1 {
  color: black;
  user-select: none;
}
</style>
