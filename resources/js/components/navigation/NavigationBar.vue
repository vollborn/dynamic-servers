<template>
  <v-app-bar
    clipped-left
    app
    color="header"
    elevation="2"
    :style="getToolbarStyle()"
  >
    <v-app-bar-nav-icon
      v-if="isAuth && !slimInterface"
      class="mr-2"
      @click="toggle"
      color="navigationColor"
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
      <server-create-button v-if="showAddServerButton"/>
      <v-divider vertical v-if="showAddServerButton"/>
      <navigation-profile-button/>
    </div>
    <div
      class="d-flex align-center mr-md-2"
      v-else
    >
      <navigation-language-button />
      <navigation-login-button class="ml-2 mr-3" />
      <navigation-register-button />
    </div>
  </v-app-bar>
</template>

<script>
import ServerCreateButton from "../server/ServerCreate/ServerCreateButton";
import NavigationProfileButton from "./NavigationProfileButton";
import {mapGetters} from "vuex";
import Toolbar from "../../mixins/Toolbar";
import NavigationLanguageButton from "./NavigationLanguageButton";
import NavigationLoginButton from "./NavigationLoginButton";
import NavigationRegisterButton from "./NavigationRegisterButton";

export default {
  components: {
    NavigationRegisterButton,
    NavigationLoginButton, NavigationLanguageButton, NavigationProfileButton, ServerCreateButton},
  mixins: [Toolbar],
  props: {
    slimInterface: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  methods: {
    toggle() {
      this.$emit('toggle')
    },
    redirect(name) {
      this.pushRouteTo({name: name})
    }
  },
  computed: {
    ...mapGetters('auth', ['isAuth', 'user']),
    ...mapGetters('server', ['servers', 'loadingServers']),
    showAddServerButton() {
      return !this.loadingServers
        && !this.slimInterface
        && this.servers.length < this.user.serverLimit;
    }
  }
}
</script>
