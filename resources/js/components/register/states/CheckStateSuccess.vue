<template>
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-icon
        color="success"
        dark
        v-bind="attrs"
        v-on="on"
        class="cursor-pointer"
      >
        fa-check
      </v-icon>
    </template>
    <span>
      {{ $t('register.states.success') }}
    </span>
  </v-tooltip>
</template>