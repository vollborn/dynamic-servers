<script>
export default {
  methods: {
    pushRouteTo(route) {
      this.$router.push(route).catch(() => {
        // such emptiness
      });
    }
  }
}
</script>