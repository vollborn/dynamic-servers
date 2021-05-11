<template>
  <div>
    <v-btn
      icon
      class="d-block d-md-none"
      color="primary"
      @click="pushRouteTo({name: 'login'})"
    >
      <v-icon>fa-sign-in-alt</v-icon>
    </v-btn>
    <v-btn
      text
      class="d-none d-md-block"
      color="navigationColor"
      @click="pushRouteTo({name: 'login'})"
    >
      {{ $t('navigation.labels.login') }}
    </v-btn>
  </div>
</template>