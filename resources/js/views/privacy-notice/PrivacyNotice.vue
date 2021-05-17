<template>
  <div>
    <v-container style="min-height: 100vh;">
      <v-card
        class="text-pre-line mx-auto mt-4"
        style="max-width: 1200px;"
      >
        <v-card-text
          v-if="loadingPrivacy"
        >
          <v-skeleton-loader
            type="card"
            class="mx-auto"
          />
        </v-card-text>
        <v-card-text
          v-else
          class="py-6"
          v-html="privacy"
        />
      </v-card>
    </v-container>
    <v-divider/>
    <home-footer/>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import HomeFooter from "../../components/home/HomeFooter";

export default {
  components: {HomeFooter},
  computed: {
    ...mapGetters('locale', ['locale']),
    ...mapGetters('privacy', ['privacy', 'loadingPrivacy'])
  },
  watch: {
    locale() {
      this.getPrivacy();
    }
  },
  created() {
    this.getPrivacy();
  },
  methods: {
    ...mapActions('privacy', ['getPrivacy'])
  }
}
</script>