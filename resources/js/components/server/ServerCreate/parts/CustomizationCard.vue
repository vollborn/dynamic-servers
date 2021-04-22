<template>
  <v-card>
    <v-card-title>
      {{ $t('dialogs.server_create.customization.header') }}
    </v-card-title>
    <v-card-text>
      <v-text-field
        v-model="server.customLabels.title"
        :label="$t('dialogs.server_create.customization.title')"
        maxlength="50"
      />
      <v-text-field
        v-model="server.customLabels.subtitle"
        :label="$t('dialogs.server_create.customization.subtitle')"
        maxlength="100"
      />
      <v-textarea
        class="mt-1"
        v-model="server.customLabels.text"
        :label="$t('dialogs.server_create.customization.text')"
        rows="3"
        maxlength="2000"
      />
    </v-card-text>
  </v-card>
</template>

<script>
export default {
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