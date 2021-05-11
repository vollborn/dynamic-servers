<template>
  <v-btn
    fab
    class="elevation-0"
    @click="toNextLocale"
  >
    <div class="flag-container">
      <img :src="flagUrl" alt=""/>
    </div>
  </v-btn>
</template>

<script>
export default {
  data() {
    return {
      locales: ['en', 'de'],
      locale: 'en',
      nextLocale: 'de',
    }
  },
  computed: {
    flagUrl() {
      return '/assets/flags/' + this.nextLocale + '.png';
    }
  },
  methods: {
    getNextLocaleIndex() {
      let index = this.locales.indexOf(this.locale) + 1;
      if (index === this.locales.length) {
        index = 0;
      }
      return index;
    },
    toNextLocale() {
      this.locale = this.nextLocale;
      this.nextLocale = this.locales[this.getNextLocaleIndex()];

      this.$i18n.locale = this.locale;
    }
  }
}
</script>

<style scoped lang="scss">
.flag-container {
  width: 32px;
  height: 32px;
  display: flex;
  justify-content: center;
  align-items: center;

  img {
    width: 100%;
  }
}
</style>