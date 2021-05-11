<template>
  <div class="try-it-image">
    <v-card class="py-8 px-md-12 text-center vue-animations size-fade-in">
      <div class="text-h2">
        {{ $t('home.try_it.title') }}
      </div>
      <div class="description text-body-1 primary--text mt-4 text-pre-line">{{ $t('home.try_it.description') }}</div>
      <v-btn
        @click="pushRouteTo({name: 'register'})"
        color="primary"
        class="mt-4"
      >
        {{ $t('home.register_now') }}
      </v-btn>
    </v-card>
  </div>
</template>

<style scoped lang="scss">
.try-it-image {
  width: 100%;
  height: 100vh;
  max-height: 600px;
  background: url("/assets/background.jpg") no-repeat center center fixed;
  background-size: cover;
  display: flex;
  justify-content: center;
  align-items: center;

  .description {
    width: 95%;
    margin: 0 auto;
  }
}
</style>