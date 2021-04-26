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
      <v-form @submit.prevent="performRegister">
        <v-card-text>
          <v-text-field
            v-model="firstName"
            :label="$t('register.labels.first_name')"
          />
          <v-text-field
            v-model="lastName"
            :label="$t('register.labels.last_name')"
          />
          <v-text-field
            v-model="username"
            :label="$t('register.labels.username')"
          >
            <template #append-outer>
              <check-username-icon
                v-model="usernameIsValid"
                :username="username"
              />
            </template>
          </v-text-field>
          <v-text-field
            v-model="password"
            :type="showPassword ? 'text' : 'password'"
            :label="$t('register.labels.password')"
            class="mb-2"
          >
            <template #append>
              <div
                style="width: 20px; padding-left: 15px; padding-right: 15px"
                @click="showPassword = !showPassword"
                class="d-flex justify-center align-center cursor-pointer"
              >
                <v-icon size="18">
                  {{ showPassword ? 'fa-eye-slash' : 'fa-eye' }}
                </v-icon>
              </div>
            </template>
          </v-text-field>
          <v-checkbox
            v-model="acceptTerms"
          >
            <template #label>
              <span class="ml-2 text-body-2">
               {{ $t('register.labels.accept_terms') }}
              </span>
            </template>
          </v-checkbox>
        </v-card-text>
        <v-divider/>
        <v-card-actions>
          <v-spacer/>
          <v-btn
            type="submit"
            color="primary"
            class="px-8"
            :loading="isLoading"
            :disabled="!canRegister"
          >
            {{ $t('register.labels.register') }}
          </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-container>
</template>

<script>
import {mapActions} from "vuex";
import CheckUsernameIcon from "../../components/register/CheckUsernameIcon";

export default {
  components: {
    CheckUsernameIcon
  },
  data() {
    return {
      username: null,
      password: null,
      firstName: null,
      lastName: null,
      errorMessage: null,
      showPassword: false,
      isLoading: false,
      acceptTerms: false,
      usernameIsValid: false
    }
  },
  computed: {
    canRegister() {
      return this.username
        && this.password
        && this.firstName
        && this.lastName
        && this.acceptTerms;
    }
  },
  methods: {
    ...mapActions('auth', ['register']),
    redirect(name) {
      this.pushRouteTo({name: name})
    },
    performRegister() {
      this.isLoading = true;
      this.errorMessage = null;

      let params = {
        firstName: this.firstName,
        lastName: this.lastName,
        username: this.username,
        password: this.password
      };

      this.register(params)
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