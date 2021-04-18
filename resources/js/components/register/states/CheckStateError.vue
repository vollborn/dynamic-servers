<template>
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-icon
        color="error"
        dark
        v-bind="attrs"
        v-on="on"
        class="cursor-pointer"
      >
        fa-times
      </v-icon>
    </template>
    <span>
      {{ $t('register.states.error') }}
    </span>
  </v-tooltip>
</template>