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
    <v-col cols="12">
      <div
        v-if="notificationChannels.length === 0"
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
              {{ getLabel(channel.notificationChannelTypeId) }}
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
import NotificationChannelSelect from "./NotificationChannelSelect";
import NotificationChannels from "../../mixins/NotificationChannels";

export default {
  components: {NotificationChannelSelect},
  mixins: [NotificationChannels],
  props: {
    value: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      notificationChannel: {
        notificationChannelTypeId: null,
        content: null
      },
      notificationChannels: this.value,
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
    clear() {
      this.notificationChannel = {
        notificationChannelTypeId: null,
        content: null
      }
    },
    submit() {
      this.notificationChannels.push(this.notificationChannel);
      this.clear();
    },
    removeChannel(index) {
      this.notificationChannels.splice(index, 1);
    }
  }
}
</script>