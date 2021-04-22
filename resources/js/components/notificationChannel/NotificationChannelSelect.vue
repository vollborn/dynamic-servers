<template>
  <v-select
    v-model="channel"
    label="Channel"
    :items="notificationChannels"
    item-text="name"
    item-value="id"
    :loading="isLoadingNotificationChannels"
  />
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  props: {
    value: {
      type: Number,
      required: false,
      default: null
    }
  },
  data() {
    return {
      channel: this.value
    }
  },
  watch: {
    value(value) {
      this.channel = value;
    },
    channel(value) {
      this.$emit('input', value)
    }
  },
  created() {
    if (this.notificationChannels.length === 0) {
      this.getNotificationChannels();
    }
  },
  computed: {
    ...mapGetters('notificationChannel', ['notificationChannels', 'isLoadingNotificationChannels'])
  },
  methods: {
    ...mapActions('notificationChannel', ['getNotificationChannels'])
  }
}
</script>