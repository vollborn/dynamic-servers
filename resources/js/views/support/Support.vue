<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <div class="text-center text-h2 mt-16">
          {{ $t('support.heading') }}
        </div>
        <div class="mx-auto mt-12" style="max-width: 500px;">
          <v-text-field
            solo
            v-model="search"
            :label="$t('support.search')"
            append-icon="fa-search"
            hide-details
          />
        </div>
        <div class="text-center mt-4">
          <v-btn
            @click="switchPage"
            color="primary"
          >
            <v-icon small class="mr-2">{{ leftIcon }}</v-icon>
            {{ buttonLabel }}
            <v-icon small class="ml-2">{{ rightIcon }}</v-icon>
          </v-btn>
        </div>
      </v-col>
      <v-col cols="12" lg="8" offset-lg="2">
        <all-questions-column
          v-if="page === 'all'"
          :search="search"
          class="mt-6"
        />
        <own-questions-column
          v-if="page === 'own'"
          :search="search"
          class="mt-6"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AllQuestionsColumn from "../../components/support/AllQuestionsColumn";
import OwnQuestionsColumn from "../../components/support/OwnQuestionsColumn";

export default {
  components: {OwnQuestionsColumn, AllQuestionsColumn},
  data() {
    return {
      search: null,
      page: 'all'
    }
  },
  computed: {
    leftIcon() {
      return this.page === 'own' ? 'fa-arrow-left' : null;
    },
    rightIcon() {
      return this.page === 'all' ? 'fa-arrow-right' : null;
    },
    buttonLabel() {
      return this.page === 'all' ? this.$t('support.my_questions') : this.$t('support.all_questions')
    }
  },
  methods: {
    switchPage() {
      this.page = this.page === 'all' ? 'own' : 'all';
    }
  }
}
</script>