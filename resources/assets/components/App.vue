<template>
  <div id="app-view">
    <navbar/>
    <router-view></router-view>
  </div>
</template>

<script>
import navbar from './Navbar.vue'
export default {
  components: {
    navbar
  }
}
</script>


<style>
.block-top {
  padding-top: 20px;
  padding-bottom: 20px;
}

i {
  cursor: pointer !important;
}
</style>
