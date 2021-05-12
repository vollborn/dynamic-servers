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
      <template #prepend>
        <v-icon
          :color="notification.type"
          class="mr-3"
        >
          {{ typeIcons[notification.type] }}
        </v-icon>
      </template>
      <div class="d-flex justify-space-between align-center">
        <div style="width: 100%;">
          {{ notification.message }}
        </div>

        <v-btn
          icon
          v-if="notification.persistent"
          @click="removeNotification(notification.id)"
        >
          <v-icon>fa-times</v-icon>
        </v-btn>
      </div>
    </v-alert>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notificationIdCount: 0,
      notifications: [],
      notificationVisibleTime: 7000,
      allowedTypes: [
        'info',
        'error',
        'success',
        'warning',
      ],
      typeIcons: {
        'info': 'fa-info-circle',
        'error': 'fa-times',
        'success': 'fa-check-circle',
        'warning': 'fa-exclamation-triangle',
      }
    }
  },
  methods: {
    open(message, type = 'info', opt = null) {
      let id = this.notificationIdCount++;
      let options = opt ? opt : {};

      this.notifications.push({
        id: id,
        message: message,
        type: type,
        persistent: options.persistent ?? false,
        callback: options.callback ?? null
      });

      if (!options.persistent) {
        setTimeout(() => {
          this.removeNotification(id);
        }, this.notificationVisibleTime)
      }
    },
    removeNotification(id) {
      let notificationIndex = this.notifications.findIndex(item => item.id === id);
      if (this.notifications[notificationIndex].callback) {
        this.notifications[notificationIndex].callback();
      }
      this.notifications.splice(notificationIndex, 1);
    }
  }
}
</script>

<style lang="scss">
.notifications-container {
  z-index: 10000;
  position: fixed;
  width: 98%;
  max-width: 350px;
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
