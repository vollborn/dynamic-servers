<template>
  <v-card>
    <dashboard-card-title
      :title="$t('dashboard.cards.support.title')"
      :subtitle="$t('dashboard.cards.support.subtitle')"
    />
    <v-card-text class="text-center pb-8">
      <div>
        <div>
          <v-icon
            size="60"
            color="secondary"
            class="mb-6"
          >
            fa-question-circle
          </v-icon>
        </div>
        <div>
          {{ $t('dashboard.cards.support.line1') }}
          <br/>{{ $t('dashboard.cards.support.line2') }}
        </div>
        <div>
          <v-btn
            class="mt-6"
            color="primary"
            @click="pushRouteTo({name : 'support'})"
          >
            {{ $t('dashboard.cards.support.button') }}
          </v-btn>
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
import DashboardCardTitle from "./DashboardCardTitle";

export default {
  components: {DashboardCardTitle}
}
</script>