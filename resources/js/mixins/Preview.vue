<script>
export default {
  methods: {
    getPreview(content, length, ignoreWhitespace = false) {
      if (content.length <= length) {
        return content;
      }

      let cut = content.slice(0, length);

      if (!ignoreWhitespace) {
        let index = cut.lastIndexOf(' ');
        if (index !== -1) {
          cut = cut.slice(0, index);
        }
      }

      return cut + '...';
    }
  }
}
</script>