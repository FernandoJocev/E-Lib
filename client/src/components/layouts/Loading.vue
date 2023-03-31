<template>
  <div class="loading-container">
    <img :src="Images.Zeta" alt="Loading" />
    <h1>Loading . . .</h1>
  </div>
</template>

<script>
import Images from '../../utils/config-image'

export default {
  data() {
    return { Images }
  },
}
</script>
