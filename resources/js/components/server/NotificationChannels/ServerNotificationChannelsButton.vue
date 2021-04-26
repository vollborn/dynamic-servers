<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    transition="dialog-bottom-transition"
  >
    <template #activator="{on, attrs}">
      <v-btn
        icon
        color="primary"
        v-bind="attrs"
        v-on="on"
      >
        <v-icon
          small
        >
          fa-envelope
        </v-icon>
      </v-btn>
    </template>

    <server-notification-channels-card
      :server="server"
      @close="dialog = false"
    />
  </v-dialog>
</template>

<script>
import ServerNotificationChannelsCard from "./ServerNotificationChannelsCard";

export default {
  components: {ServerNotificationChannelsCard},
  props: {
    server: {
      type: Object,
      required: true,
      default: () => ({
        id: null,
        notificationChannelLimit: null
      })
    }
  },
  data() {
    return {
      dialog: false
    }
  },
}
</script>