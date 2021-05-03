<template>
  <v-select
    v-model="locale"
    :items="locales"
    :label="hideLabel ? '' : $t('settings.preferences.locale')"
    item-value="value"
    item-text="label"
  />
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      required: true,
      default: 'en'
    },
    hideLabel: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data() {
    return {
      locale: this.value,
      locales: [
        {
          value: 'en',
          label: this.$t('settings.preferences.locales.en')
        },
        {
          value: 'de',
          label: this.$t('settings.preferences.locales.de')
        }
      ]
    }
  },
  watch: {
    value(value) {
      this.locale = value;
    },
    locale(value) {
      this.$emit('input', value);
    }
  }
}
</script>