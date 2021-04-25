<template>
  <div>
    <navigation-bar
      :slim-interface="slimInterface"
      @toggle="toggle"
    />
    <navigation-drawer
      v-if="!slimInterface"
      v-model="isOpen"
      @toggle="toggle"
    />
  </div>
</template>
<script>
import NavigationBar from "./NavigationBar";
import NavigationDrawer from "./NavigationDrawer";

export default {
  components: {NavigationDrawer, NavigationBar},
  data() {
    return {
      isOpen: true
    }
  },
  computed: {
    slimInterface() {
      return this.$route.name === 'status' || this.$route.name === 'home';
    }
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    }
  }
}
</script>