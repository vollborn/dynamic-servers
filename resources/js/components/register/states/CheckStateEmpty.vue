<template>
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-icon
        color="primary"
        dark
        v-bind="attrs"
        v-on="on"
        class="cursor-pointer"
      >
        fa-info-circle
      </v-icon>
    </template>
    <span>
      {{ $t('register.states.empty') }}
    </span>
  </v-tooltip>
</template>