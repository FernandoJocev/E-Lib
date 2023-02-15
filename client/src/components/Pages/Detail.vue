<template>
  <div>
    <Top title="Detail" />

    <div class="container">
      <div class="first-container">
        <div class="left-content">
          <img
            src="../../assets/buku/Laut Bercerita.jpg"
            alt="Laut Bercerita"
          />
        </div>
        <div class="right-content">
          <h1>Laut Bercerita</h1>
          <h2>Leila S. Chudori</h2>
          <hr />
          <h1>Jumlah Halaman</h1>
          <h2>394</h2>
          <h1>Tanggal Terbit</h1>
          <h2>21 Oktober 2017</h2>
          <h1>Penerbit</h1>
          <h2>Kepustakaan Populer Gramedia</h2>
        </div>
        <div class="isbn">
          <h1>ISBN</h1>
          <h2>9786024246952</h2>
          <h1>Terakhir pinjam</h1>
          <h2>-</h2>
        </div>
      </div>

      <div class="second-container">
        <div class="content">
          <h1>Deskripsi Buku</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
            sit amet bibendum nulla. Vestibulum consectetur sem quis libero
            scelerisque ultricies. Donec eu pellentesque nunc. Ut sagittis velit
            velit, vitae malesuada enim condimentum nec. Duis rhoncus pharetra
            suscipit. Sed faucibus ex in tortor consequat, sed interdum tortor
            imperdiet. Sed suscipit malesuada tempus. Proin eget pretium eros.
            Donec congue sapien non ipsum mollis aliquam. Mauris et enim
            vestibulum, faucibus elit at, mattis sem. Donec faucibus ex a nulla
            gravida rhoncus. Nam sagittis nisl eget dui tincidunt interdum.
          </p>
        </div>
        <router-link to="/">Back to Home</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Top from '../layouts/Top-section.vue'

export default {
  components: {
    Top,
  },

  setup() {
    const route = useRoute()

    onMounted(() => {
      console.log(route.params.id)
    })
  },
}
</script>

<style scoped>
img {
  width: auto;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

hr {
  margin: 20px 0px 20px 0px;
}

.container h2 {
  font-size: 21px;
  opacity: 60%;
}

.container {
  background-color: rgba(208, 191, 145, 15%);
  border: 2px solid rgba(0, 0, 0, 31%);
  display: flex;
  flex-direction: column;
  margin: 40px 40px;
  border-radius: 30px;
  padding: 50px 50px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 30%);
}

.first-container {
  display: flex;
  justify-content: flex-start;
}

.left-content {
  margin-right: 70px;
}

.right-content {
  flex: 1;
}

.isbn {
  position: absolute;
  left: 70%;
  top: 34%;
}

.second-container {
  margin-top: 40px;
}

.content h1 {
  color: #292d8b;
  font-weight: 550;
}

.content p {
  font-weight: 500;
}

a {
  display: block;
  margin: 10px 0px;
}
</style>
