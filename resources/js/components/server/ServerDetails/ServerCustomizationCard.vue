<template>
  <v-card>
    <v-card-title>
      {{ $t('server.customization.title') }}
    </v-card-title>
    <v-divider/>
    <v-card-text>
      <server-customization-form
        v-model="server"
        :expanded="expanded"
      />
    </v-card-text>
    <v-divider/>
    <v-card-actions>
      <v-btn
        @click="expanded = !expanded"
        color="primary"
        icon
      >
        <v-icon>{{ expanded ? 'fa-chevron-up' : 'fa-chevron-down' }}</v-icon>
      </v-btn>
      <v-btn
        @click="reset"
        :disabled="!canSave"
        color="primary"
        icon
      >
        <v-icon>fa-redo</v-icon>
      </v-btn>
      <v-spacer/>
      <v-btn
        @click="save"
        :disabled="!canSave"
        :loading="isLoading"
        color="primary"
        class="px-6"
      >
        {{ $t('server.customization.save') }}
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import ServerCustomizationForm from "../parts/ServerCustomizationForm";
import {cloneDeep} from "lodash";

export default {
  components: {ServerCustomizationForm},
  props: {
    value: {
      type: Object,
      required: true,
      default: () => null
    }
  },
  data() {
    return {
      server: cloneDeep(this.value),
      expanded: false,
      isLoading: false
    }
  },
  computed: {
    canSave() {
      return JSON.stringify(this.server) !== JSON.stringify(this.value)
    }
  },
  watch: {
    value: {
      deep: true,
      handler(value) {
        this.server = cloneDeep(value);
      }
    }
  },
  methods: {
    reset() {
      this.server = cloneDeep(this.value);
    },
    save() {
      this.isLoading = true;

      window.axios.put('servers/' + this.server.id, {
        customLabels: JSON.stringify(this.server.customLabels),
        backgroundImageId: this.server.backgroundImageId
      })
        .then((response) => {
          this.$emit('input', this.server);
          this.expanded = false;
          this.$root.$notification.open(response.data.message);
        })
        .finally(() => this.isLoading = false)
    }
  }
}
</script>