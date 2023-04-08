<template>
  <div class="background-blur">
    <img :src="Images.Success4" alt="Success" />
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
