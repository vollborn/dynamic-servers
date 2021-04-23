<template>
  <div>
    <v-text-field
      v-model="server.customLabels.title"
      :label="$t('server.customization_form.title')"
      maxlength="50"
    />
    <v-text-field
      v-model="server.customLabels.subtitle"
      :label="$t('server.customization_form.subtitle')"
      maxlength="100"
    />
    <v-textarea
      class="mt-1"
      v-model="server.customLabels.text"
      :label="$t('server.customization_form.text')"
      rows="5"
      maxlength="2000"
    />
    <background-image-picker
      v-model="server.backgroundImageId"
      class="mt-2"
    />
  </div>
</template>

<script>
import BackgroundImagePicker from "../../backgroundImage/BackgroundImagePicker/BackgroundImagePicker";

export default {
  components: {BackgroundImagePicker},
  props: {
    value: {
      type: Object,
      required: true,
      default: () => ({
        server: {
          backgroundImageId: null,
          customLabels: {
            title: null,
            subtitle: null,
            text: null
          }
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
        this.$emit('input', value)
      }
    }
  }
}
</script>