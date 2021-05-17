<script>
export default {
  methods: {
    pushRouteTo(route) {
      this.$router.push(route).catch(() => {
        // Scroll to top anyways
        window.scrollTo(0, 0);
      });
    }
  }
}
</script>