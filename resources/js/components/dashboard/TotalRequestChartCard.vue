<template>
  <v-card>
    <dashboard-card-title
      :title="$t('dashboard.cards.total_requests.title')"
      :subtitle="$t('dashboard.cards.total_requests.subtitle')"
    />
    <v-card-text v-if="isLoading">
      <v-skeleton-loader type="card" class="mx-auto"/>
    </v-card-text>
    <v-card-text v-else>
      <area-chart
        class="mt-1"
        :data="chartData"
        :curve="false"
      />
    </v-card-text>
  </v-card>
</template>

<script>
import DashboardCardTitle from "./DashboardCardTitle";
export default {
  components: {DashboardCardTitle},
  data() {
    return {
      isLoading: false,
      chartData: null
    }
  },
  created() {
    this.getChartData();
  },
  methods: {
    getChartData() {
      this.isLoading = true;
      window.axios.get('dashboard/total-requests-chart')
        .then((response) => {
          this.chartData = response.data;
        })
        .finally(() => {
          this.isLoading = false;
        })
    }
  }
}
</script>