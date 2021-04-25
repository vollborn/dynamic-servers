<template>
  <div
    :style="containerStyle"
    class="fill-height d-flex justify-center align-center"
  >
    <v-card
      v-if="isLoading"
      max-width="500"
      width="100%"
      class="d-flex justify-center align-center"
    >
      <v-progress-circular
        class="my-10"
        indeterminate
        size="30"
      />
    </v-card>
    <v-card
      v-else-if="hasError"
      max-width="500"
      width="100%"
    >
      <v-card-title>
        <div class="d-flex">
          <v-icon
            color="primary"
            class="mr-4"
          >
            fa-wrench
          </v-icon>
          <div>
            {{ $t('status.title') }}
            <div
              class="text-subtitle-2 primary--text"
            >
              {{ $t('status.subtitle') }}
            </div>
          </div>
        </div>
      </v-card-title>
      <v-divider/>
      <v-card-text class="text-center">
        {{ $t('status.text') }}
      </v-card-text>
    </v-card>
    <v-card
      v-else
      max-width="500"
      width="100%"
    >
      <v-card-title>
        <div>
          {{ server.customLabels.title ? server.customLabels.title : server.name }}
          <div
            class="text-subtitle-2 primary--text"
            v-if="server.customLabels.subtitle"
          >
            {{ server.customLabels.subtitle }}
          </div>
        </div>
      </v-card-title>
      <v-divider/>
      <v-card-text>
        <div class="text-center text-body-1">
          {{ server.ipAddress }}
        </div>
      </v-card-text>
      <div v-if="server.customLabels.text ">
        <v-divider/>
        <v-card-text>
          {{ server.customLabels.text }}
        </v-card-text>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false,
      hasError: false,
      server: null,
    }
  },
  computed: {
    containerStyle() {
      return this.server
        ? 'background: url("' + this.getBackgroundUrl() + '") no-repeat center center fixed;'
        + '-webkit-background-size: cover;'
        + '-moz-background-size: cover;'
        + '-o-background-size: cover;'
        + 'background-size: cover;'
        : '';
    },
    routeId() {
      return this.$route.params.server
    },
    routeToken() {
      return this.$route.params.token
    }
  },
  watch: {
    routeId() {
      this.getServer();
    },
    routeToken() {
      this.getServer();
    }
  },
  created() {
    this.getServer();
  },
  methods: {
    getBackgroundUrl() {
      return process.env.MIX_APP_URL + this.server.backgroundImage.path
    },
    getServer() {
      this.hasError = false;
      this.isLoading = true;
      this.server = null;

      window.axios.get('status/' + this.routeId + '/' + this.routeToken)
        .then((response) => {
          this.server = response.data.data;
        })
        .catch(() => this.hasError = true)
        .finally(() => this.isLoading = false)
    }
  }
}
</script>