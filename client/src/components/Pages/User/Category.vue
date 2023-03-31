<template>
  <Top title="Category" />
  <div class="categories">
    <div class="kategori-title">
      <i class=""></i>
    </div>
    <div class="category">
      <h1>Sejarah</h1>
    </div>
  </div>

  <div class="books-lists"></div>
  <h1>Kategori</h1>
  <router-link class="button" to="/">Back to Home</router-link>
</template>

<script>
import Top from '../../layouts/Top-section.vue'
export default {
  components: {
    Top,
  },
}
</script>
