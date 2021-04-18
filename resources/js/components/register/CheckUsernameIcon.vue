<template>
  <div
    class="d-flex justify-center align-center"
    style="width: 30px;"
  >
    <check-state-empty v-if="state === 1"/>
    <check-state-loading v-if="state === 2"/>
    <check-state-success v-if="state === 3"/>
    <check-state-error v-if="state === 4"/>
  </div>
</template>

<script>
import CheckStateEmpty from "./states/CheckStateEmpty";
import CheckStateLoading from "./states/CheckStateLoading";
import CheckStateSuccess from "./states/CheckStateSuccess";
import CheckStateError from "./states/CheckStateError";

export default {
  components: {CheckStateError, CheckStateSuccess, CheckStateLoading, CheckStateEmpty},
  props: {
    value: {
      type: Boolean,
      required: true,
      default: false
    },
    username: {
      type: String,
      required: false,
      default: null
    }
  },
  data() {
    return {
      state: 1
    }
  },
  methods: {
    startLoadingWith(value) {
      if (this.username === value) {
        this.state = 2;

        window.axios.post('auth/register/available', {
          username: value
        })
          .then(() => {
            this.$emit('input', true)
            if (this.username === value) {
              this.state = 3;
            }
          })
          .catch(() => {
            this.$emit('input', false)
            if (this.username === value) {
              this.state = 4;
            }
          });
      }
    }
  },
  watch: {
    username(value) {
      if (!value) {
        this.state = 1;
        return;
      }
      setTimeout(this.startLoadingWith, 500, value);
    }
  },
}
</script>