<template>
  <v-card>
    <v-card-title>
      {{ $t('dialogs.server_create.customization.header') }}
    </v-card-title>
    <v-card-text>
      <server-customization-form v-model="server" />
    </v-card-text>
  </v-card>
</template>

<script>
import ServerCustomizationForm from "../../parts/ServerCustomizationForm";
export default {
  components: {ServerCustomizationForm},
  props: {
    value: {
      type: Object,
      required: true,
      default: () => ({
        customLabels: {
          title: null,
          subtitle: null,
          text: null
        }
      })
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
        this.$emit('input', value);
      }
    }
  }
}
</script>