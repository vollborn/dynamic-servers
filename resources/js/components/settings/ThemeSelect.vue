<template>
  <v-select
    v-model="theme"
    :items="themes"
    :label="hideLabel ? '' : $t('settings.preferences.theme')"
    item-value="value"
    item-text="label"
  />
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      required: false,
      default: 'dark'
    },
    hideLabel: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data() {
    return {
      theme: this.value,
      themes: [
        {
          value: 'dark',
          label: this.$t('settings.preferences.themes.dark')
        },
        {
          value: 'light',
          label: this.$t('settings.preferences.themes.light')
        }
      ]
    }
  },
  watch: {
    value(value) {
      this.theme = value;
    },
    theme(value) {
      this.$emit('input', value)
    }
  }
}
</script>