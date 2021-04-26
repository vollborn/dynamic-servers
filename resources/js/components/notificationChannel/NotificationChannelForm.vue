<template>
  <v-row>
    <v-col cols="12">
      <notification-channel-add-form
        v-if="canAddNotificationChannels"
        @submit="submit"
      />
      <div
        v-else
        class="text-center mb-4 mt-3"
      >
        {{ $t('notification_channel.form.limit_reached') }}
      </div>
    </v-col>
    <v-col cols="12">
      <div
        v-if="canAddNotificationChannels && notificationChannels.length === 0"
        class="text-center mb-4"
      >
        {{ $t('notification_channel.form.empty') }}
      </div>
      <v-simple-table v-else class="mb-4">
        <template #default>
          <thead>
          <tr>
            <th class="text-left">
              {{ $t('notification_channel.form.headers.channel') }}
            </th>
            <th class="text-left">
              {{ $t('notification_channel.form.headers.content') }}
            </th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(channel, index) in notificationChannels" :key="index">
            <td>
              {{ getNotificationChannelLabel(channel.notificationChannelTypeId) }}
            </td>
            <td>
              {{ getPreview(channel.content, 50, true) }}
            </td>
            <td>
              <v-btn
                @click="removeChannel(index)"
                color="primary"
                icon
              >
                <v-icon small>fa-minus</v-icon>
              </v-btn>
            </td>
          </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-col>
  </v-row>
</template>

<script>
import NotificationChannelAddForm from "./NotificationChannelAddForm";

export default {
  components: {NotificationChannelAddForm},
  props: {
    value: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      notificationChannels: this.value,
    }
  },
  computed: {
    canAddNotificationChannels() {
      return this.notificationChannels.length < process.env.MIX_SERVER_NOTIFICATION_CHANNEL_LIMIT
    }
  },
  watch: {
    value: {
      deep: true,
      handler(value) {
        this.notificationChannels = value;
      }
    },
    notificationChannels: {
      deep: true,
      handler(value) {
        this.$emit('input', value)
      }
    }
  },
  methods: {
    submit(data) {
      this.notificationChannels.push(data);
    },
    removeChannel(index) {
      this.notificationChannels.splice(index, 1);
    }
  }
}
</script>