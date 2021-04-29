<script>
export default {
  methods: {
    getToolbarStyle() {
      return 'background: ' + this.getToolbarBackground() + '; color: ' + this.getToolbarColor();
    },
    getToolbarBackground() {
      return this.$vuetify.theme.currentTheme.navigationBackground;
    },
    getToolbarColor() {
      return this.$vuetify.theme.currentTheme.navigationColor;
    },
  }
}
</script>