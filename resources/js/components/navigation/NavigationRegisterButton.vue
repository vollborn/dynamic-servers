<template>
  <div>
    <v-btn
      icon
      class="d-block d-md-none"
      color="primary"
      @click="pushRouteTo({name: 'register'})"
    >
      <v-icon>fa-user-plus</v-icon>
    </v-btn>
    <v-btn
      class="d-none d-md-block"
      color="primary"
      @click="pushRouteTo({name: 'register'})"
    >
      {{ $t('navigation.labels.register') }}
    </v-btn>
  </div>
</template>