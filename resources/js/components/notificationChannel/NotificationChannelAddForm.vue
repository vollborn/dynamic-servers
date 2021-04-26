<template>
  <v-row>
    <v-col cols="12" sm="3">
      <notification-channel-select v-model="notificationChannel.notificationChannelTypeId"/>
    </v-col>
    <v-col cols="12" sm="7">
      <v-text-field
        v-model="notificationChannel.content"
        :label="channelContentLabel"
      />
    </v-col>
    <v-col cols="12" sm="2">
      <v-btn
        class="mt-3"
        @click="submit"
        color="primary"
        :disabled="!canSubmit"
        block
      >
        {{ $t('notification_channel.form.add') }}
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
import NotificationChannelSelect from "./NotificationChannelSelect";

export default {
  components: {NotificationChannelSelect},
  data() {
    return {
      notificationChannel: {
        notificationChannelTypeId: null,
        content: null
      }
    }
  },
  computed: {
    channelContentLabel() {
      switch (this.notificationChannel.notificationChannelTypeId) {
        case 1:
          return this.$t('notification_channel.form.labels.discord_content');
        case 2:
          return this.$t('notification_channel.form.labels.email_content');
        default:
          return this.$t('notification_channel.form.labels.default');
      }
    },
    canSubmit() {
      return this.notificationChannel.notificationChannelTypeId
        && this.notificationChannel.content
    }
  },
  methods: {
    clear() {
      this.notificationChannel = {
        notificationChannelTypeId: null,
        content: null
      }
    },
    submit() {
      this.$emit('submit', this.notificationChannel);
      this.clear();
    }
  }
}
</script>