<template lang="html">
  <div class="">
    <h2>利用模板来建立组件</h2>
    <desc-template />
    <h2>利用渲染函数来建立组件</h2>
    <render-template :is-show="false" content="渲染函数的使用" />
    <books-template :lists="lists" />
    <input-template text="" />
    <h1>render组件</h1>
    <br>
    <to-list :lists="lists" />
  </div>
</template>

<script>
import DescTemplate from '@/views/components/DescTemplate'
import RenderTemplate from '@/views/components/RenderTemplate'
import BooksTemplate from '@/views/components/BooksTemplate'
import InputTemplate from '@/views/components/InputTemplate'
import ToList from '@/views/components/ToList'
export default {
  components: {
    DescTemplate,
    RenderTemplate,
    BooksTemplate,
    InputTemplate,
    ToList
  },
  data() {
    return {
      lists: ['html5权威指南', 'Css权威指南', 'javascript权威指南']
    }
  }
}
</script>

<style lang="css" scoped>
</style>
