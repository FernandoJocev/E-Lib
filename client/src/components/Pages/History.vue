<template>
  <div>
    <Top title="History" />

    <div class="lists">
      <div class="card">
        <div class="left-content">
          <img
            src="../../assets/buku/Laut Bercerita.jpg"
            alt="Laut Bercerita"
          />
        </div>
        <div class="mid-content">
          <p>Title</p>
          <h1>Laut Bercerita</h1>
          <p>Author</p>
          <h1>Eireinei Fangidae</h1>
          <p>Tanggal pinjam</p>
          <h1>20 Januari 2023</h1>
        </div>
        <div class="right-content">
          <router-link to="/Detail/1">Detail</router-link>
        </div>
      </div>

      <div class="card">
        <div class="left-content">
          <img
            src="../../assets/buku/Laut Bercerita.jpg"
            alt="Laut Bercerita"
          />
        </div>
        <div class="mid-content">
          <p>Title</p>
          <h1>Laut Bercerita</h1>
          <p>Author</p>
          <h1>Eireinei Fangidae</h1>
          <p>Tanggal pinjam</p>
          <h1>20 Januari 2023</h1>
        </div>
        <div class="right-content">
          <router-link to="/Detail/2">Detail</router-link>
        </div>
      </div>
    </div>
    <router-link class="main-button" to="/">Back</router-link>
  </div>
</template>

<script>
import Top from '../layouts/Top-section.vue'

export default {
  components: {
    Top,
  },
}
</script>

<style scoped>
.main-button {
  width: 100px;
}
</style>
