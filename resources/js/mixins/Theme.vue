<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters('auth', ['user'])
  },
  created() {
    this.tryApplyTheme();
  },
  watch: {
    user: {
      deep: true,
      handler() {
        this.tryApplyTheme();
      }
    }
  },
  methods: {
    tryApplyTheme() {
      if (this.user) {
        this.$vuetify.theme.dark = this.user.settings.theme === 'dark';
      } else {
        this.$vuetify.theme.dark = true;
      }
    }
  }
}
</script>