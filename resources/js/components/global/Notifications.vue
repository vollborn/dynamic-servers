<template>
  <div class="notifications-container">
    <v-alert
      v-for="(notification, index) in notifications"
      :key="index"
      colored-border
      border="right"
      :type="notification.type"
      elevation="4"
    >
      {{ notification.message }}
    </v-alert>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notifications: [],
      notificationVisibleTime: 7000
    }
  },
  methods: {
    open(message, type = 'info') {
      this.notifications.push({
        message: message,
        type: type
      });
      setTimeout(() => {
        this.notifications.shift();
      }, this.notificationVisibleTime)
    }
  }
}
</script>

<style lang="scss">
.notifications-container {
  z-index: 100;
  position: fixed;
  width: 98%;
  max-width: 300px;
  right: 1%;
  bottom: 1%;

  @media only screen and (max-width: 600px) {
    & {
      max-width: unset;
      width: 94%;
      left: 3%;
    }
  }
}
</style>
