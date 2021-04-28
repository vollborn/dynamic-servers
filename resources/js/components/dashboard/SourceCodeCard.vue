<template>
  <v-card>
    <dashboard-card-title
      :title="$t('dashboard.cards.source.title')"
      :subtitle="$t('dashboard.cards.source.subtitle')"
    />
    <v-card-text class="text-center pb-8">
      <div>
        <div>
          <v-icon
            size="60"
            color="secondary"
            class="mb-6"
          >
            fab fa-github
          </v-icon>
        </div>
        <div>
          {{ $t('dashboard.cards.source.line1') }}
          <br/>{{ $t('dashboard.cards.source.line2') }}
        </div>
        <div>
          <v-btn
            class="mt-6"
            color="primary"
            @click="redirectToGithub"
          >
            {{ $t('dashboard.cards.source.button') }}
          </v-btn>
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
import DashboardCardTitle from "./DashboardCardTitle";

export default {
  components: {DashboardCardTitle},
  methods: {
    redirectToGithub() {
      window.location.href = 'https://github.com/vollborn/dynamic-servers';
    }
  }
}
</script>