<template>
  <v-expansion-panels class="mt-2">
    <v-expansion-panel :disabled="!question.answer">
      <v-expansion-panel-header>
        {{ question.question }}
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <div class="text-body-2 text-pre-line">{{ question.answer }}</div>
        <v-subheader class="primary--text justify-center mt-4">
          {{
            $t('support.question_panel.created_at') + ' '
          }}{{
            question.createdAt | date
          }}{{
            question.createdAt !== question.updatedAt
              ? ' • ' + $t('support.question_panel.created_at') + ' ' + parseDate(question.updatedAt)
              : null
          }}
        </v-subheader>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script>
export default {
  props: {
    question: {
      type: Object,
      required: true,
      default: () => ({
        question: null,
        answer: null,
        createdAt: null
      })
    }
  }
}
</script>