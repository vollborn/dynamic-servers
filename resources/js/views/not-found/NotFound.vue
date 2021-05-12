<template>
  <v-container
    fluid
    class="fill-height d-flex justify-center align-center"
    :style="containerStyle"
  >
    <v-card
      class="py-12 text-center"
      :style="cardStyle"
    >
      <div class="text-h1 mb-2" :style="titleStyle">
        404
      </div>
      <div class="text-h6 mt-6" :style="textStyle">
        {{ $t('errors.404.description') }}
      </div>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      containerStyle: this.getContainerStyle(),
      cardStyle: this.getCardStyle(),
      titleStyle: this.getTitleStyle(),
      textStyle: this.getTextStyle()
    }
  },
  methods: {
    getBackgroundImageStyle() {
      return 'background: url("/assets/background.jpg") no-repeat center center fixed;'
        + 'background-size: cover;';
    },
    getContainerStyle() {
      return this.getBackgroundImageStyle();
    },
    getCardStyle() {
      return 'width: 95%;'
        + 'max-width: 500px';
    },
    getTitleStyle() {
      return 'font-weight: 900;'
        + this.getBackgroundImageStyle()
        + 'background-clip: text;'
        + 'color: #fff2';
    },
    getTextStyle() {
      return 'margin: 0 auto;'
        + 'width: 95%;'
        + 'max-width: 400px;';
    }
  }
}
</script>