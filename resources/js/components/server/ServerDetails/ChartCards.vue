<template>
  <div>
    <v-card>
      <v-card-title>
        {{ $t('server.charts.requests') }}
      </v-card-title>
      <v-divider />
      <v-card-text class="pt-6 pb-7">
        <v-skeleton-loader
          v-if="isLoading"
          type="card"
          class="mx-auto"
        />
        <area-chart
          v-else
          :data="requestChartData"
          :curve="false"
        />
      </v-card-text>
    </v-card>

    <v-card class="mt-6">
      <v-card-title>
        {{ $t('server.charts.downtime') }}
      </v-card-title>
      <v-divider />
      <v-card-text class="pt-6 pb-7">
        <v-skeleton-loader
          v-if="isLoading"
          type="card"
          class="mx-auto"
        />
        <area-chart
          v-else
          :data="downtimeChartData"
          :curve="false"
        />
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  props: {
    server: {
      type: Object,
      required: true,
      default: () => null
    }
  },
  data() {
    return {
      isLoading: false,
      requestChartData: null,
      downtimeChartData: null
    }
  },
  created() {
    this.getChartData();
  },
  methods: {
    getChartData() {
      this.isLoading = true;

      window.axios.get('servers/' + this.server.id + '/statistics')
        .then((response) => {
          this.requestChartData = response.data.requests;
          this.downtimeChartData = response.data.downtime;
        })
        .finally(() => this.isLoading = false)
    }
  }
}
</script>