<template>
  <v-card tile>
    <v-toolbar
      tile
      class="px-2"
    >
      <v-toolbar-title>{{ $t('dialogs.server_create.title') }}</v-toolbar-title>
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
      <v-row>
        <v-col cols="12" md="6">
          <general-info-card v-model="server"/>
          <notification-card v-model="server" class="mt-6"/>
        </v-col>
        <v-col cols="12" md="6">
          <customization-card v-model="server"/>
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider/>
    <v-card-text class="mt-2 pb-0 mb-0">
      <v-row>
        <v-col cols="12" class="d-flex justify-space-between">
          <v-btn
            @click="reset"
            class="px-6"
          >
            {{ $t('dialogs.server_create.actions.reset') }}
          </v-btn>
          <v-btn
            @click="submit"
            color="primary"
            :disabled="!canSubmit"
            :loading="isLoading"
            class="pr-5 pl-4"
          >
            <v-icon
              small
              class="mr-3"
            >
              fa-plus
            </v-icon>
            {{ $t('dialogs.server_create.actions.create') }}
          </v-btn>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import CustomizationCard from "./parts/CustomizationCard";
import GeneralInfoCard from "./parts/GeneralInfoCard";
import NotificationCard from "./parts/NotificationCard";
import {mapActions} from "vuex";

export default {
  components: {NotificationCard, GeneralInfoCard, CustomizationCard},
  data() {
    return {
      isLoading: false,
      server: {
        name: null,
        requestInterval: 12000,
        backgroundImageId: null,
        customLabels: {
          title: null,
          subtitle: null,
          text: null
        },
        notificationChannels: []
      }
    }
  },
  computed: {
    canSubmit() {
      return this.server.name
        && this.server.requestInterval;
    }
  },
  methods: {
    ...mapActions('server', ['getServers']),
    close() {
      this.reset();
      this.$emit('close')
    },
    submit() {
      this.isLoading = true;
      let params = {
        name: this.server.name,
        requestInterval: this.server.requestInterval,
        customLabels: JSON.stringify(this.server.customLabels),
        notificationChannels: JSON.stringify(this.server.notificationChannels),
        backgroundImageId: this.server.backgroundImageId
      };

      window.axios.post('servers', params)
        .then((response) => {
          this.$root.$notification.open(response.data.message)
          this.close();
          this.getServers();
        })
        .catch((error) => {
          this.$root.$notification.open(error.response.data.message, 'error')
        })
        .finally(() => {
          this.isLoading = false;
        })
    },
    reset() {
      this.server = {
        name: null,
        requestInterval: 12000,
        backgroundImageId: null,
        customLabels: {
          title: null,
          subtitle: null,
          text: null
        },
        notificationChannels: []
      }
    }
  }
}
</script>