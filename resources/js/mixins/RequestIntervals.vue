<script>
export default {
  data() {
    return {
      requestIntervals: []
    }
  },
  created() {
    for (let index = 4; index <= 20; index++) {
      this.requestIntervals.push({
        key: index + 's',
        value: index * 1000
      });
    }
  }
}
</script>