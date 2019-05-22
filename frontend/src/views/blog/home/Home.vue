<template>
  <div class="home">
    <div class="content">
      <button @click="add()">点击</button>
      <span>{{this.$store.state.count}}</span>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Home',
  methods: {
    add () {
      this.$store.dispatch('addNumber',5)
    }
  },
}
</script>

<style lang="scss" scoped>

</style>
