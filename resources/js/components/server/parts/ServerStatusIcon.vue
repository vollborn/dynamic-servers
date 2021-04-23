<template>
  <div class="server-status-icon">
    <div class="foreground" :style="style"/>
    <div class="background" :style="style"/>
  </div>
</template>

<script>
export default {
  props: {
    server: {
      type: Object,
      required: true,
      default: () => null
    }
  },
  computed: {
    style() {
      return "background: " + this.getTheme();
    }
  },
  methods: {
    getTheme() {
      if (this.server.disabledAt) {
        return this.$vuetify.theme.currentTheme.disabled;
      }

      return this.server.isAvailable
        ? this.$vuetify.theme.currentTheme.active
        : this.$vuetify.theme.currentTheme.inactive;
    }
  }
}
</script>

<style lang="scss">
.server-status-icon {
  width: 25px;
  height: 25px;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;

  .foreground {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 10px;
    height: 10px;
    border-radius: 50%;
  }

  @keyframes server-status-icon {
    0% {
      width: 0;
      height: 0;
      opacity: 0.75;
    }
    70% {
      width: 100%;
      height: 100%;
      opacity: 0;
    }
    100% {
      width: 100%;
      height: 100%;
      opacity: 0;
    }
  }

  .background {
    animation: server-status-icon 2s infinite;
    border-radius: 50%;
  }
}
</style>