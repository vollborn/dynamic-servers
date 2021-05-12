<script>
import {mapActions, mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters('cookies', ['cookies'])
  },
  methods: {
    ...mapActions('cookies', ['setCookies']),
    checkCookies() {
      if (!this.cookies) {
        this.$root.$notification.open(
          this.$t('cookies.banner'),
          'info',
          {
            persistent: true,
            callback: () => {
              this.setCookies(true);
            }
          }
        )
      }
    }
  }
}
</script>