<template>
  <v-row>
    <v-col cols="12" md="6">
      <server-properties-card :server="server"/>
      <server-customization-card
        v-model="server"
        class="mt-6"
      />
    </v-col>
    <v-col cols="12" md="6">
      <chart-cards :server="server"/>
    </v-col>
  </v-row>
</template>

<script>
import ChartCards from "./ChartCards";
import ServerPropertiesCard from "./ServerPropertiesCard";
import ServerCustomizationCard from "./ServerCustomizationCard";

export default {
  components: {ServerPropertiesCard, ServerCustomizationCard, ChartCards},
  props: {
    value: {
      type: Object,
      required: true,
      default: () => ({})
    }
  },
  data() {
    return {
      server: this.value
    }
  },
  watch: {
    value: {
      deep: true,
      handler(value) {
        this.server = value;
      }
    },
    server: {
      deep: true,
      handler(value) {
        this.$emit('input', value)
      }
    }
  }
}
</script>