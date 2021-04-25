<template>
  <v-navigation-drawer
    v-if="isAuth"
    v-model="isOpen"
    clipped
    app
    class="elevation-2"
  >
    <v-list
      nav
      class="mt-2"
      dense
    >
      <v-list-item-group>
        <v-subheader class="primary--text">
          {{ $t('navigation.drawer.overview') }}
        </v-subheader>

        <v-list-item @click="redirect('dashboard')" link>
          <v-list-item-icon class="mr-2">
            <div class="d-flex justify-center align-center" style="width: 40px">
              <v-icon size="20">fa-border-all</v-icon>
            </div>
          </v-list-item-icon>
          <v-list-item-content>
            {{ $t('navigation.drawer.dashboard') }}
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="redirect('support')" link>
          <v-list-item-icon class="mr-2">
            <div class="d-flex justify-center align-center" style="width: 40px">
              <v-icon size="20">fa-envelope</v-icon>
            </div>
          </v-list-item-icon>
          <v-list-item-content>
            {{ $t('navigation.drawer.support') }}
          </v-list-item-content>
        </v-list-item>

        <v-subheader class="primary--text mt-4">
          {{ $t('navigation.drawer.servers') }}
        </v-subheader>

        <div v-if="servers.length > 0">
          <v-list-item
            v-for="server in servers"
            :key="server.id"
            @click="openServer(server.id)"
            link
          >
            <v-list-item-icon class="mr-2">
              <div class="d-flex justify-center align-center" style="width: 40px">
                <navigation-server-icon :server="server" />
              </div>
            </v-list-item-icon>
            <v-list-item-content>
              {{ server.name }}
            </v-list-item-content>
          </v-list-item>
        </div>
        <div
          v-else-if="loadingServers"
          class="mt-4 d-flex justify-center align-center"
        >
          <v-progress-circular
            indeterminate
            size="22"
            width="2"
          />
        </div>
        <v-subheader
          v-else
          class="mx-auto mt-2 text-center"
          style="width: 80%"
        >
          {{ $t('navigation.drawer.no_servers') }}
        </v-subheader>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import NavigationServerIcon from "./NavigationServerIcon";

export default {
  components: {NavigationServerIcon},
  props: {
    value: {
      type: Boolean,
      required: true,
      default: false
    }
  },
  data() {
    return {
      isOpen: this.value
    }
  },
  computed: {
    ...mapGetters('auth', ['isAuth']),
    ...mapGetters('server', ['loadingServers', 'servers'])
  },
  created() {
    if (this.isAuth && this.servers.length === 0) {
      this.getServers();
    }
  },
  watch: {
    isOpen(value) {
      this.$emit('input', value)
    },
    value(value) {
      this.isOpen = value;
    },
    isAuth(value) {
      if (value === true) {
        this.getServers();
      }
    }
  },
  methods: {
    ...mapActions('server', ['getServers']),
    redirect(name) {
      this.pushRouteTo({name: name})
    },
    openServer(id) {
      this.pushRouteTo('/server/' + id);
    }
  }
}
</script>