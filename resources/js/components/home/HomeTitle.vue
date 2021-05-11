<template>
  <div class="home-title">
    <div class="wrapper">
      <div class="text-h2 text-sm-h1 white--text">
        Dynamic Servers
      </div>
      <v-btn
        @click="pushRouteTo({name: 'register'})"
        color="primary"
        class="mt-4"
      >
        {{ $t('home.register_now') }}
      </v-btn>
    </div>
  </div>
</template>

<style scoped lang="scss">
.home-title {
  width: 100%;
  height: 100vh;
  max-height: 600px;
  position: relative;
  background: url("/assets/background.jpg") no-repeat center center fixed;
  background-size: cover;

  .wrapper {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }
}
</style>
