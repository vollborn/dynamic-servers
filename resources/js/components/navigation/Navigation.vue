<template>
  <div>
    <navigation-bar @toggle="toggle"/>
    <navigation-drawer v-model="isOpen" @toggle="toggle"/>
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
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    }
  }
}
</script>