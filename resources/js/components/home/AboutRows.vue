<template>
  <div class="about">
    <v-row>
      <v-col cols="12" md="6">
        <div class="text-h4">
          {{ $t('home.about_rows.what_it_is.title') }}
        </div>
        <v-divider class="mt-4 mb-6"/>
        <p class="about-text grey--text text-pre-line">{{ $t('home.about_rows.what_it_is.description') }}</p>
      </v-col>
      <v-col cols="12" md="6">
        <v-container class="image-container">
          <v-img src="/assets/background.jpg" class="rounded-lg rounded-br-xl rounded-tl-xl"/>
        </v-container>
      </v-col>
    </v-row>
    <v-row class="flex-md-row-reverse mt-12">
      <v-col cols="12" md="6">
        <div class="text-h4">
          {{ $t('home.about_rows.how_it_works.title') }}
        </div>
        <v-divider class="mt-4 mb-6"/>
        <p class="about-text grey--text text-pre-line">{{ $t('home.about_rows.how_it_works.description') }}</p>
      </v-col>
      <v-col cols="12" md="6">
        <v-container class="image-container">
          <v-img src="/assets/background.jpg" class="rounded-lg rounded-br-xl rounded-tl-xl"/>
        </v-container>
      </v-col>
    </v-row>
  </div>
</template>

<style scoped>
.image-container {
  width: 90%;
  margin: 0 auto;
}

.about-text {
  font-size: 18px;
}
</style>
