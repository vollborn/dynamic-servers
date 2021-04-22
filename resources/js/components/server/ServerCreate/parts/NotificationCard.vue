<template>
  <v-card>
    <v-card-title>
      {{ $t('dialogs.server_create.notifications.header') }}
    </v-card-title>
    <v-card-text>
      <notification-channel-form v-model="server.notificationChannels" />
    </v-card-text>
  </v-card>
</template>

<script>
import NotificationChannelForm from "../../../notificationChannel/NotificationChannelForm";
export default {
  components: {NotificationChannelForm},
  props: {
    value: {
      type: Object,
      required: true,
      default: () => ({
        name: null,
        requestInterval: null
      })
    }
  },
  data() {
    return {
      server: this.value
    }
  },
  watch: {
    value: {
      deep: true,
      handler(value) {
        this.server = value;
      }
    },
    server: {
      deep: true,
      handler(value) {
        this.$emit('input', value);
      }
    }
  }
}
</script>