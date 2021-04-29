<template>
  <v-card>
    <dashboard-card-title
      :title="$t('dashboard.cards.server_limit.title')"
      :subtitle="$t('dashboard.cards.server_limit.maximum_pre') + user.serverLimit + $t('dashboard.cards.server_limit.maximum_post')"
    />
    <v-card-text>
      <div
        :id="serverLimitCircleId"
        class="server-limit-circle"
      >
        <div
          :id="serverLimitLabelId"
          class="server-limit-label"
        >
          <div class="text-center">
            <div class="text-h3">
              {{ servers.length }} / {{ user.serverLimit }}
            </div>
            <div class="text-body-1 mt-1 primary--text">
              {{ $t('dashboard.cards.server_limit.servers') }}
            </div>
          </div>
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
import DashboardCardTitle from "./DashboardCardTitle";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {DashboardCardTitle},
  data() {
    return {
      serverLimitCircleId: 'server-limit-circle',
      serverLimitLabelId: 'server-limit-label'
    }
  },
  computed: {
    ...mapGetters('auth', ['user']),
    ...mapGetters('server', ['servers', 'loadingServers'])
  },
  mounted() {
    if (this.servers.length !== 0) {
      this.setServerLimitBorder();
    } else if (!this.loadingServers) {
      this.getServers();
    }
  },
  watch: {
    loadingServers(value) {
      if (!value) {
        this.setServerLimitBorder();
      }
    }
  },
  methods: {
    ...mapActions('server', ['getServers']),
    setServerLimitBorder() {
      let label = document.getElementById(this.serverLimitLabelId);
      label.style.background = this.$vuetify.theme.currentTheme.vuetifyCardBackground;

      let circle = document.getElementById(this.serverLimitCircleId);
      circle.style.background = this.getConicGradient();
    },
    getConicGradient() {
      let disabled = this.$vuetify.theme.currentTheme.disabled;
      if (disabled.length === 3) {
        disabled += '5';
      } else {
        disabled += '55';
      }

      let percentage = (this.servers.length / this.user.serverLimit) * 80;

      return 'conic-gradient('
        + this.$vuetify.theme.currentTheme.primary
        + ' 0% '
        + percentage
        + '%, '
        + disabled
        + ' 1% 80%, #0000 80% 100%)';
    }
  }
}
</script>


<style lang="scss">
.server-limit-circle {
  width: 280px;
  height: 280px;
  margin: 12px auto;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  border-radius: 50%;
  transform: rotate(216.5deg);

  .server-limit-label {
    transform: rotate(-216.5deg);
    background: #0000;
    width: calc(100% - 44px);
    height: calc(100% - 44px);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;

  }
}
</style>