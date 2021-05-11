<template>
  <v-container fluid class="pa-0 pb-4">
    <home-title/>
    <v-container fluid class="pa-0 px-8 home-container">
      <info-cards/>
      <about-rows class="mt-12"/>
    </v-container>
    <try-it-image class="mt-14"/>
    <home-footer/>
  </v-container>
</template>

<script>
import HomeTitle from "../../components/home/HomeTitle";
import InfoCards from "../../components/home/InfoCards";
import AboutRows from "../../components/home/AboutRows";
import HomeFooter from "../../components/home/HomeFooter";
import TryItImage from "../../components/home/TryItImage";

export default {
  components: {TryItImage, HomeFooter, AboutRows, InfoCards, HomeTitle}
}
</script>

<style scoped lang="scss">
.home-container {
  width: 100%;
  max-width: 1300px;
}
</style>