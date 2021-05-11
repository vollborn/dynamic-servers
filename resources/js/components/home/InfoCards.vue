<template>
  <div class="info-cards">
    <v-row class="cards-container justify-center justify-md-space-between">
      <v-col
        class="card-item pt-0"
        cols="12"
        md="4"
      >
        <v-card
          class="rounded-lg"
        >
          <v-card-text class="text-center">
            <v-icon
              class="icon pt-6"
              color="secondary"
            >
              fab fa-creative-commons-nc-eu
            </v-icon>
          </v-card-text>
          <v-card-text class="card-text py-4">
            <div class="text-h4 primary--text">
              {{ $t('home.info_cards.free.title') }}
            </div>
            <div class="text-body-1 mt-2 pb-4 text-pre-line">{{ $t('home.info_cards.free.description') }}</div>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col
        class="card-item pt-4 pt-md-0"
        cols="12"
        md="4"
      >
        <v-card
          class="rounded-lg"
        >
          <v-card-text class="text-center">
            <v-icon
              class="icon pt-6"
              color="secondary"
            >
              fab fa-github
            </v-icon>
          </v-card-text>
          <v-card-text class="card-text py-4">
            <div class="text-h4 primary--text">
              {{ $t('home.info_cards.open_source.title') }}
            </div>
            <div class="text-body-1 mt-2 pb-4 text-pre-line">{{ $t('home.info_cards.open_source.description') }}</div>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col
        class="card-item pt-4 pt-md-0"
        cols="12"
        md="4"
      >
        <v-card
          class="rounded-lg"
        >
          <v-card-text class="text-center">
            <v-icon
              class="icon pt-6"
              color="secondary"
            >
              fa-user-shield
            </v-icon>
          </v-card-text>
          <v-card-text class="card-text py-4">
            <div class="text-h4 primary--text">
              {{ $t('home.info_cards.private.title') }}
            </div>
            <div class="text-body-1 mt-2 pb-4 text-pre-line">{{ $t('home.info_cards.private.description') }}</div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<style scoped lang="scss">
.info-cards {
  display: flex;
  justify-content: center;
  padding-bottom: 30px;

  .cards-container {
    width: 100%;
    margin-top: -30px;
    z-index: 10;

    .card-item {
      max-width: 600px;

      .icon {
        font-size: 120px;
      }

      .card-text {
        width: 90%;
        margin: 0 auto;
      }
    }
  }
}
</style>