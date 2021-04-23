<template>
  <v-row>
    <v-col cols="12" md="6">
      <server-properties-card :server="server"/>
    </v-col>
    <v-col cols="12" md="6">
      <chart-cards :server="server"/>
    </v-col>
  </v-row>
</template>

<script>
import ChartCards from "./ChartCards";
import ServerPropertiesCard from "./ServerPropertiesCard";

export default {
  components: {ServerPropertiesCard, ChartCards},
  props: {
    server: {
      type: Object,
      required: true,
      default: () => null
    }
  }
}
</script>