<template>
  <v-app>
    <the-navigation/>
    <v-main>
      <notifications ref="notification" />
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import TheNavigation from './components/navigation/Navigation';
import Notifications from "./components/global/Notifications";

export default {
  components: {
    TheNavigation,
    Notifications
  },
  mounted() {
    this.$root.$notification = this.$refs.notification;
  }
}
</script>
