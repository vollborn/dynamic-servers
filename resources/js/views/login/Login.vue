<template>
  <v-container class="fill-height d-flex justify-center align-center">
    <v-card max-width="500" width="100%">
      <v-card-text>
        <div
          style="height: 50px"
          class="cursor-pointer d-flex align-center"
        >
          <img
            src="/assets/logo.png"
            alt=""
            style="height: 100%"
          />
          <span class="ml-2 text-h6">Dynamic Servers</span>
        </div>
      </v-card-text>
      <v-divider/>
      <v-form @submit.prevent="performLogin">
        <v-card-text>
          <v-text-field
            v-model="username"
            :label="$t('login.labels.username')"
          />
          <v-text-field
            v-model="password"
            type="password"
            :label="$t('login.labels.password')"
            class="mb-2"
          />
        </v-card-text>
        <v-divider/>
        <v-card-actions>
          <v-btn
            text
            @click="redirect('register')"
          >
            {{ $t('login.labels.register') }}
          </v-btn>
          <v-spacer/>
          <v-btn
            type="submit"
            color="primary"
            class="px-8"
            :loading="isLoading"
            :disabled="!canLogin"
          >
            {{ $t('login.labels.login') }}
          </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-container>
</template>

<script>
import {mapActions} from "vuex";

export default {
  data() {
    return {
      username: null,
      password: null,
      errorMessage: null,
      showPassword: false,
      isLoading: false
    }
  },
  computed: {
    canLogin() {
      return this.username && this.password;
    }
  },
  methods: {
    ...mapActions('auth', ['login']),
    redirect(name) {
      this.pushRouteTo({name: name})
    },
    performLogin() {
      this.isLoading = true;
      this.errorMessage = null;

      let params = {
        username: this.username,
        password: this.password
      };

      this.login(params)
        .then(() => {
          this.redirect('dashboard');
        })
        .catch((error) => {
          this.$root.$notification.open(error.response.data.message, 'error');
        })
        .finally(() => this.isLoading = false)
    }
  }
}
</script>