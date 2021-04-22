<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    transition="dialog-bottom-transition"
  >
    <template #activator="{on, attrs}">
      <v-btn
        class="d-none d-sm-block mr-4"
        color="primary"
        v-bind="attrs"
        v-on="on"
      >
        <v-icon
          small
          class="mr-3"
        >
          fa-plus
        </v-icon>
        {{ $t('navigation.labels.create_server') }}
      </v-btn>
      <v-btn
        class="d-block d-sm-none mr-3"
        color="primary"
        v-bind="attrs"
        v-on="on"
        fab
        small
      >
        <v-icon>
          fa-plus
        </v-icon>
      </v-btn>
    </template>

    <server-create @close="dialog = false" />
  </v-dialog>
</template>

<script>
import ServerCreate from "./ServerCreate";
export default {
  components: {ServerCreate},
  data() {
    return {
      dialog: false
    }
  },
}
</script>