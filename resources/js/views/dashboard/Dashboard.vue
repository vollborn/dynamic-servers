<template>
  <v-container v-if="user">
    <v-row>
      <v-col cols="12">
        <div class="text-lg-h4 text-h6 mt-4 mb-2 mx-4">
          {{ $t('dashboard.welcome_pre') }}{{ user.firstName }}{{ $t('dashboard.welcome_post') }}
        </div>
      </v-col>
      <v-col cols="12" lg="6">
        <server-limit-card/>
      </v-col>
      <v-col cols="12" lg="6">
        <total-request-chart-card/>
      </v-col>
      <v-col cols="12" lg="6">
        <support-card/>
      </v-col>
      <v-col cols="12" lg="6">
        <source-code-card/>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ServerLimitCard from "../../components/dashboard/ServerLimitCard";
import TotalRequestChartCard from "../../components/dashboard/TotalRequestChartCard";
import SupportCard from "../../components/dashboard/SupportCard";
import SourceCodeCard from "../../components/dashboard/SourceCodeCard";
import {mapGetters} from "vuex";

export default {
  components: {SourceCodeCard, SupportCard, TotalRequestChartCard, ServerLimitCard},
  computed: {
    ...mapGetters('auth', ['user'])
  }
}
</script>