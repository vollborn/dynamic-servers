<template>
  <v-tooltip bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-progress-circular
        color="primary"
        indeterminate
        size="24"
      />
    </template>
    <span>
      {{ $t('register.states.loading') }}
    </span>
  </v-tooltip>
</template>