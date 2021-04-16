<script>
import dayjs from 'dayjs';
import customParseFormat from 'dayjs/plugin/customParseFormat';
dayjs.extend(customParseFormat);

export default {
  filters: {
    date: function (date, defaultVal = '-') {
      return date ? dayjs(date).format('DD.MM.YYYY') : defaultVal;
    },
    dateTime: function (date, defaultVal = '-') {
      return date ? dayjs(date).format('DD.MM.YYYY HH:mm:ss') : defaultVal;
    },
    monthYear: function (date, defaultVal = '-') {
      return date ? dayjs(date).format('MMMM YYYYY') : defaultVal;
    }
  },
  methods: {
    parseDate(date, defaultVal = null) {
      return date ? dayjs(date).format('DD.MM.YYYY') : defaultVal;
    },
    today() {
      return dayjs();
    }
  }
};
</script>
