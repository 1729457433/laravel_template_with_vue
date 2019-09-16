<template lang="html">
  <div class="">
    <p>{{ content }}</p>
  </div>
</template>

<script>
export default {
  name: 'DescTemplate',
  props: {
    content: {
      type: String,
      default: 'Test!!'
    }
  },
  data() {
    return {
    }
  }
}
</script>

<style lang="css" scoped>
</style>
