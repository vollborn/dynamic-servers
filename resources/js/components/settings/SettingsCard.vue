<template>
  <v-card>
    <v-card-title>
      {{ $t('settings.preferences.header') }}
    </v-card-title>
    <v-divider/>
    <v-card-text>
      <div class="text-subtitle-2 primary--text mt-1 mb-2">
        {{ $t('settings.preferences.appearance') }}
      </div>
      <v-row>
        <v-col cols="12">
          <theme-select
            v-model="profile.settings.theme"
            :hide-label="true"
          />
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider/>
    <v-card-text>
      <div class="text-subtitle-2 primary--text mt-1 mb-2">
        {{ $t('settings.preferences.language') }}
      </div>
      <v-row>
        <v-col cols="12">
          <locale-select
            v-model="profile.settings.locale"
            :hide-label="true"
          />
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import ThemeSelect from "./ThemeSelect";
import LocaleSelect from "./LocaleSelect";

export default {
  components: {LocaleSelect, ThemeSelect},
  props: {
    value: {
      type: Object,
      required: true,
      default: {
        settings: {
          theme: null,
          locale: null
        }
      }
    }
  },
  data() {
    return {
      profile: this.value
    }
  },
  watch: {
    value: {
      deep: true,
      handler(value) {
        this.profile = value;
      }
    },
    profile: {
      deep: true,
      handler(value) {
        this.$emit('input', value);
      }
    }
  }
}
</script>