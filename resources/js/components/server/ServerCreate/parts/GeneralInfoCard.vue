<template>
  <v-card>
    <v-card-title>
      {{ $t('dialogs.server_create.general.header') }}
    </v-card-title>
    <v-card-text>
      <v-text-field
        v-model="server.name"
        :label="$t('dialogs.server_create.general.server_name')"
        :hint="$t('dialogs.server_create.general.server_name_hint')"
        maxlength="255"
      >
      </v-text-field>
      <v-autocomplete
        v-model="server.requestInterval"
        :label="$t('dialogs.server_create.general.request_interval')"
        :hint="$t('dialogs.server_create.general.request_interval_hint')"
        :items="requestIntervals"
        class="mt-2"
        item-text="key"
        item-value="value"
      />
    </v-card-text>
  </v-card>
</template>

<script>
import RequestIntervals from "../../../../mixins/RequestIntervals";

export default {
  mixins: [RequestIntervals],
  props: {
    value: {
      type: Object,
      required: true,
      default: () => ({
        name: null,
        requestInterval: null
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