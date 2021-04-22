<script>
export default {
  methods: {
    getLabel(id) {
      switch (id) {
        case 1:
          return this.$t('mixins.notification_channels.discord')
        case 2:
          return this.$t('mixins.notification_channels.email')
        default:
          return this.$t('mixins.notification_channels.default')
      }
    }
  }
}
</script>