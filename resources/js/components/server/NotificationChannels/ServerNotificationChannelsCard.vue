<template>
  <v-card tile>
    <v-toolbar
      :style="getToolbarStyle()"
      tile
      class="px-2"
    >
      <v-toolbar-title>{{ $t('notification_channel.edit.header') }}</v-toolbar-title>
      <v-spacer/>
      <v-btn
        fab
        icon
        dark
        @click="close"
      >
        <v-icon>
          fa-times
        </v-icon>
      </v-btn>
    </v-toolbar>
    <v-card-text class="mt-4">
      <v-row no-gutters>
        <v-col cols="12" lg="8" offset-lg="2">
          <v-row v-if="isLoading">
            <v-col cols="12">
              <v-skeleton-loader type="card" class="mx-auto"/>
            </v-col>
          </v-row>
          <v-row v-else>
            <v-col
              v-if="notificationChannels.length < server.notificationChannelLimit"
              cols="12"
            >
              <notification-channel-add-form
                class="mt-2"
                @submit="add"
              />
            </v-col>
            <v-col
              v-else
              cols="12"
              class="text-center my-4 primary--text"
            >
              {{ $t('notification_channel.edit.limit_reached') }}
            </v-col>
            <v-col cols="12">
              <div
                v-if="!notificationChannels.length"
                class="text-center mt-6 mb-12"
              >
                {{ $t('notification_channel.form.empty') }}
              </div>
              <v-simple-table
                v-else
                class="mb-4"
              >
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
                        @click="remove(channel.id)"
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
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider/>
    <v-card-text class="mt-2 pb-0 mb-0">
      <v-row>
        <v-col cols="12" class="d-flex">
          <v-spacer/>
          <v-btn
            @click="close"
            color="primary"
            :disabled="!canSubmit"
            :loading="isLoading"
            class="px-4"
          >
            {{ $t('notification_channel.edit.close') }}
          </v-btn>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import NotificationChannelAddForm from "../../notificationChannel/NotificationChannelAddForm";
import Toolbar from "../../../mixins/Toolbar";

export default {
  components: {NotificationChannelAddForm},
  mixins: [Toolbar],
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
      isLoading: false,
      notificationChannels: []
    }
  },
  computed: {
    canSubmit() {
      return true;
    }
  },
  created() {
    this.get();
  },
  methods: {
    close() {
      this.$emit('close')
    },
    get() {
      this.isLoading = true;
      this.notificationChannels = [];
      window.axios.get('servers/' + this.server.id + '/notification-channels')
        .then((response) => this.notificationChannels = response.data.data)
        .finally(() => this.isLoading = false)
    },
    add(channel) {
      this.isLoading = true;
      let params = {
        notificationChannelTypeId: channel.notificationChannelTypeId,
        content: channel.content
      };

      window.axios.post('servers/' + this.server.id + '/notification-channels', params)
        .then((response) => {
          this.$root.$notification.open(response.data.message)
          this.get();
        })
        .catch((error) => this.$root.$notification.open(error.response.data.message, 'error'))
        .finally(() => this.isLoading = false)
    },
    remove(id) {
      this.isLoading = true;
      window.axios.delete('servers/' + this.server.id + '/notification-channels/' + id)
        .then((response) => {
          this.$root.$notification.open(response.data.message);
          this.get();
        })
        .catch((error) => this.$root.$notification.open(error.response.data.message, 'error'))
        .finally(() => this.isLoading = false)
    }
  }
}
</script>