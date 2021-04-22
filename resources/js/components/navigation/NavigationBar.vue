<template>
  <v-app-bar
    clipped-left
    app
    color="header"
    elevation="2"
  >
    <v-app-bar-nav-icon
      v-if="isAuth"
      class="mr-2"
      @click="toggle"
    />

    <div
      style="height: 75%"
      class="cursor-pointer d-flex align-center"
      @click="redirect(isAuth ? 'dashboard' : 'home')"
    >
      <img
        src="/assets/logo.png"
        alt=""
        style="height: 100%"
      />
      <span class="ml-2 text-h6 d-none d-md-block">
        Dynamic Servers
      </span>
    </div>

    <v-spacer/>

    <div
      v-if="isAuth"
      class="d-flex align-center"
    >
      <server-create-button v-if="showAddServerButton" />
      <v-divider vertical v-if="showAddServerButton"/>
      <navigation-profile-button/>
    </div>
    <div v-else>
      <v-btn
        class="mr-2"
        text
        @click="redirect('login')"
      >
        {{ $t('navigation.labels.login') }}
      </v-btn>
      <v-btn
        color="primary"
        @click="redirect('register')"
      >
        {{ $t('navigation.labels.register') }}
      </v-btn>
    </div>
  </v-app-bar>
</template>

<script>
import ServerCreateButton from "../server/ServerCreate/ServerCreateButton";
import NavigationProfileButton from "./NavigationProfileButton";
import {mapGetters} from "vuex";

export default {
  components: {NavigationProfileButton, ServerCreateButton},
  methods: {
    toggle() {
      this.$emit('toggle')
    },
    redirect(name) {
      this.$router.push({name: name})
    }
  },
  computed: {
    ...mapGetters('auth', ['isAuth', 'user']),
    ...mapGetters('server', ['servers', 'isLoadingServers']),
    showAddServerButton() {
      return !this.isLoadingServers && this.servers.length < this.user.serverLimit;
    }
  }
}
</script>
