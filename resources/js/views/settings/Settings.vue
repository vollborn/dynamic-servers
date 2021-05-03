<template>
  <v-container>
    <v-row>
      <v-col cols="12" lg="6">
        <profile-card v-model="profile"/>
      </v-col>
      <v-col cols="12" lg="6">
        <settings-card v-model="profile"/>
      </v-col>
      <v-col cols="12" class="d-flex">
        <v-btn
          @click="reset"
          :disabled="!hasChanges"
        >
          Reset
        </v-btn>
        <v-spacer/>
        <v-btn
          @click="submit"
          :disabled="!canSubmit"
          :loading="isLoading"
          color="primary"
        >
          Save & Reload
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import {mapGetters} from "vuex";
import SettingsCard from "../../components/settings/SettingsCard";
import ProfileCard from "../../components/settings/ProfileCard";
import {cloneDeep} from "lodash";

export default {
  components: {ProfileCard, SettingsCard},
  data() {
    return {
      profile: {
        username: null,
        firstName: null,
        lastName: null,
        password: null,
        repeatPassword: null,
        settings: {
          theme: null,
          locale: null
        }
      },
      isLoading: false
    }
  },
  created() {
    this.reset();
  },
  computed: {
    ...mapGetters('auth', ['user']),
    canSubmit() {
      return this.profile.firstName
        && this.profile.lastName
        && ((!this.profile.password && !this.profile.repeatPassword) || this.passwordIsSame)
        && this.hasChanges
    },
    hasChanges() {
      return this.profile.firstName !== this.user.firstName
        || this.profile.lastName !== this.user.lastName
        || JSON.stringify(this.profile.settings) !== JSON.stringify(this.user.settings)
        || this.profile.password
        || this.profile.repeatPassword
    },
    passwordIsSame() {
      return this.profile.password === this.profile.repeatPassword;
    }
  },
  methods: {
    reset() {
      this.profile = {
        username: this.user.username,
        firstName: this.user.firstName,
        lastName: this.user.lastName,
        settings: cloneDeep(this.user.settings),
        password: null,
        repeatPassword: null
      }
    },
    submit() {
      this.isLoading = true;
      let params = {
        firstName: this.profile.firstName,
        lastName: this.profile.lastName,
        password: !!this.profile.password ? this.profile.password : null,
        settings: JSON.stringify(this.profile.settings)
      }

      window.axios.put('profile', params)
        .then(() => this.reload())
        .finally(() => this.isLoading = false)
    },
    reload() {
      window.location.reload(false);
    }
  }
}
</script>