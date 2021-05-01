<template>
  <div>
    <question-create @reload="reload"/>
    <v-divider class="mb-8 mt-4"/>
    <div
      v-if="!isLoading && !questions.length"
      class="text-center text-body-2 mt-4"
    >
      {{ $t('support.no_own_questions') }}
    </div>
    <div v-else>
      <question-panel
        v-for="(question, index) in questions"
        :question="question"
        :key="index"
      />
    </div>
    <div class="text-center mt-6 mb-4">
      <v-progress-circular
        v-if="isLoading"
        color="primary"
        indeterminate
        class="mt-2"
      />
      <v-btn
        v-else-if="canLoadMore"
        @click="getQuestions"
      >
        {{ $t('support.load_more') }}
      </v-btn>
    </div>
  </div>
</template>

<script>
import QuestionPanel from "./QuestionPanel";
import QuestionCreate from "./QuestionCreate";

export default {
  components: {QuestionPanel, QuestionCreate},
  props: {
    search: {
      type: String,
      required: false,
      default: null
    }
  },
  data() {
    return {
      questions: [],
      isLoading: false,
      canLoadMore: true,
      page: 1
    }
  },
  watch: {
    search(value) {
      setTimeout(this.checkForSearch, 500, value);
    }
  },
  created() {
    this.getQuestions();
  },
  methods: {
    checkForSearch(value) {
      if (this.search === value) {
        this.reload();
      }
    },
    reload() {
      this.page = 1;
      this.getQuestions();
    },
    getQuestions() {
      this.isLoading = true;
      let params = {
        page: this.page,
        search: this.search
      };

      window.axios.get('questions/own', {params})
        .then((response) => {
          if (response.data.meta.current_page === 1) {
            this.questions = response.data.data;
          } else {
            this.questions = this.questions.concat(response.data.data);
          }
          this.canLoadMore = ++this.page <= response.data.meta.last_page;
          this.isLoading = false;
        })
    }
  }
}
</script>