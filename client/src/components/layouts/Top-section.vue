<template>
  <div class="title">
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
    <div class="title-right">
      <div class="search">
        <input type="text" placeholder="Search" />
      </div>
      <div class="profile">
        <img src="../../assets/buku/Laut Bercerita.jpg" alt="" />
      </div>
    </div>
  </div>
  <div class="title-name">
    <h1>{{ title }}</h1>
  </div>
</template>

<script>
export default {
  props: ['title'],
}
</script>
