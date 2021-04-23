<template>
  <v-container>
    <v-skeleton-loader
      v-if="isLoading"
      type="card"
      class="mx-auto"
    />
    <server-details
      :server="server"
      v-else
    />
  </v-container>
</template>

<script>
import ServerDetails from "../../components/server/ServerDetails/ServerDetails";

export default {
  components: {ServerDetails},
  data() {
    return {
      isLoading: false,
      serverId: this.$route.params.server,
      server: null
    }
  },
  created() {
    if (this.serverId) {
      this.getServer();
    }
  },
  watch: {
    $route: {
      deep: true,
      handler(value) {
        this.serverId = value.params.server;
        this.getServer();
      }
    }
  },
  methods: {
    getServer() {
      this.isLoading = true;

      window.axios.get('servers/' + this.serverId)
        .then((response) => {
          this.server = response.data.data;
        })
        .finally(() => this.isLoading = false)
    }
  }
}
</script>