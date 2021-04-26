<template>
  <v-btn
    icon
    color="primary"
    @click="confirmDelete"
    :loading="isLoading"
  >
    <v-icon small>fa-trash</v-icon>
  </v-btn>
</template>

<script>
import {mapActions} from "vuex";

export default {
  props: {
    server: {
      type: Object,
      required: true,
      default: () => ({
        id: null,
        name: null
      })
    }
  },
  data() {
    return {
      isLoading: false
    }
  },
  methods: {
    ...mapActions('server', ['getServers']),
    confirmDelete() {
      this.$root.$confirm.open(
        this.$t('server.delete.title'),
        this.$t('server.delete.pre_name') + this.server.name + this.$t('server.delete.post_name')
      ).then(() => {
        this.delete();
      })
    },
    delete() {
      this.isLoading = true;
      window.axios.delete('servers/' + this.server.id)
        .then((response) => {
          this.$root.$notification.open(response.data.message);
          this.pushRouteTo({name: 'dashboard'})
          this.getServers();
        })
        .catch((error) => {
          this.$root.$notification.open(error.response.data.message);
        })
        .finally(() => {
          this.isLoading = false;
        })
    }
  }
}
</script>