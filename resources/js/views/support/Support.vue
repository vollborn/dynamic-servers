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
          />
        </div>
      </v-col>
      <v-col cols="12" lg="8" offset-lg="2">
        <div
          class="text-center text-body-2 mt-4"
          v-if="!filteredQuestions.length"
        >
          {{ $t('support.no_results') }}
        </div>
        <div v-else>
          <v-expansion-panels
            v-for="(question, index) in filteredQuestions"
            :key="index"
            :class="index > 0 ? 'mt-2' : ''"
          >
            <v-expansion-panel>
              <v-expansion-panel-header>
                {{ question.question }}
              </v-expansion-panel-header>
              <v-expansion-panel-content class="text-body-2">
                {{ question.answer }}
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import {cloneDeep} from "lodash";

export default {
  data() {
    return {
      search: null,
      filteredQuestions: [],
      questions: [
        {
          question: 'Test Question 1',
          answer: 'This is the answer!'
        },
        {
          question: 'Test Question 2',
          answer: 'This is the answer 2!'
        }
      ],
    }
  },
  created() {
    this.applySearch()
  },
  watch: {
    search() {
      this.applySearch();
    }
  },
  methods: {
    applySearch() {
      if (!this.search) {
        this.filteredQuestions = cloneDeep(this.questions);
        return;
      }

      let exploded = this.search.split(' ');
      this.filteredQuestions = this.questions.filter(item => {
        for (let index in exploded) {
          if (
            exploded.hasOwnProperty(index)
            && !item.question.toUpperCase().includes(exploded[index].toUpperCase())
          ) {
            return false;
          }
        }
        return true;
      });
    }
  }
}
</script>