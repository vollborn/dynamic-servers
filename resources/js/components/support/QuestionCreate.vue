<template>
  <v-row dense>
    <v-col cols="12" md="10">
      <v-text-field
        v-model="question"
        :label="$t('support.question_create.label')"
        class="mt-0 pt-1"
      />
    </v-col>
    <v-col cols="12" md="2">
      <v-btn
        @click="create"
        :loading="isLoading"
        :disabled="!question"
        block
      >
        {{ $t('support.question_create.submit') }}
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      question: null,
      isLoading: false
    }
  },
  methods: {
    create() {
      this.isLoading = true;
      let params = {
        question: this.question
      };

      window.axios.post('questions', params)
        .then((response) => {
          this.$root.$notification.open(response.data.message);
          this.$emit('reload');
          this.isLoading = false;
          this.question = null;
        })
    }
  }
}
</script>