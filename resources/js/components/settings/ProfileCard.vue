<template>
  <v-card>
    <v-card-title>
      {{ $t('settings.profile.header') }}
    </v-card-title>
    <v-divider/>
    <v-card-text>
      <div class="text-subtitle-2 primary--text mt-1 mb-3">
        {{ $t('settings.profile.personal_information') }}
      </div>
      <v-row>
        <v-col cols="12" lg="6">
          <v-text-field
            v-model="profile.username"
            :label="$t('settings.profile.username')"
            hide-details
            disabled
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" offset-lg="0" lg="6">
          <v-text-field
            v-model="profile.firstName"
            :label="$t('settings.profile.first_name')"
          />
        </v-col>
        <v-col cols="12" lg="6">
          <v-text-field
            v-model="profile.lastName"
            :label="$t('settings.profile.last_name')"
          />
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider/>
    <v-card-text>
      <div class="text-subtitle-2 primary--text mt-1 mb-3">
        {{ $t('settings.profile.change_password') }}
      </div>
      <v-row>
        <v-col cols="12" lg="6">
          <v-text-field
            v-model="profile.password"
            :label="$t('settings.profile.new_password')"
          />
        </v-col>
        <v-col cols="12" lg="6">
          <v-text-field
            v-model="profile.repeatPassword"
            :label="$t('settings.profile.repeat_password')"
          />
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: {
    value: {
      type: Object,
      required: true,
      default: null
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