<template>
  <v-app>
    <the-navigation/>
    <v-main>
      <notifications ref="notification" />
      <confirm ref="confirm" />
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import TheNavigation from './components/navigation/Navigation';
import Notifications from "./components/global/Notifications";
import Confirm from "./components/global/Confirm";

export default {
  components: {
    TheNavigation,
    Notifications,
    Confirm
  },
  mounted() {
    this.$root.$notification = this.$refs.notification;
    this.$root.$confirm = this.$refs.confirm;
  }
}
</script>
