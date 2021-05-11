<script>
export default {
  methods: {
    getToolbarStyle() {
      return 'background: ' + this.getToolbarBackground() + ';'
        + 'color: ' + this.getToolbarColor() + ';'
        + 'z-index: ' + this.getToolbarIndex() + ';';
    },
    getToolbarBackground() {
      return this.$vuetify.theme.currentTheme.navigationBackground;
    },
    getToolbarColor() {
      return this.$vuetify.theme.currentTheme.navigationColor;
    },
    getToolbarIndex() {
      return 100;
    }
  }
}
</script>