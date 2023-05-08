<template>
  <div class="webapp bg-slate-800 w-full h-full min-h-screen">
    <HeaderComponent/>
    <MainComponent/>
  </div>
</template>

<script>
import HeaderComponent from './components/HeaderComponent.vue';
import MainComponent from './components/MainComponent.vue';
import FooterComponent from './components/FooterComponent.vue';
export default {
  name: 'App',
  data() {
    return {

    }
  },
  methods: {

  },
  components: {
    HeaderComponent,
    MainComponent,
    FooterComponent
  },
  mounted() {

  }
}
</script>

<style lang="scss" scoped></style>