<template>
  <v-menu
    v-model="isOpen"
    bottom
    offset-y
    open-on-hover
  >
    <template #activator="{ on, attrs }">
      <v-btn
        icon
        v-bind="attrs"
        v-on="on"
        class="mr-0 ml-3"
        @click="isOpen = !isOpen"
      >
        <v-icon>
          fa-user
        </v-icon>
      </v-btn>
    </template>

    <v-card>
      <v-list>
        <v-list-item-group>
          <v-list-item
            inactive
          >
            <v-list-item-avatar>
              <v-avatar
                color="secondary"
                size="56"
              >
                {{ this.getProfileAvatar() }}
              </v-avatar>
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>
                {{ user.firstName }} {{ user.lastName }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-divider class="my-2"/>

          <v-list-item @click="redirect('settings')">
            <v-list-item-icon class="mr-2">
              <div class="d-flex justify-center align-center" style="width: 40px">
                <v-icon size="20">fa-cog</v-icon>
              </div>
            </v-list-item-icon>
            <v-list-item-content>
              {{ $t('navigation.profile.settings') }}
            </v-list-item-content>
          </v-list-item>

          <v-list-item @click="performLogout">
            <v-list-item-icon class="mr-2">
              <div class="d-flex justify-center align-center" style="width: 40px">
                <v-icon size="20">fa-sign-out-alt</v-icon>
              </div>
            </v-list-item-icon>
            <v-list-item-content>
              {{ $t('navigation.profile.logout') }}
            </v-list-item-content>
          </v-list-item>

        </v-list-item-group>
      </v-list>
    </v-card>
  </v-menu>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  data() {
    return {
      isOpen: false
    }
  },
  computed: {
    ...mapGetters('auth', ['user'])
  },
  methods: {
    ...mapActions('auth', ['logout']),
    getProfileAvatar() {
      let name = this.user.firstName.slice(0, 1) + this.user.lastName.slice(0, 1);
      return name.toUpperCase();
    },
    redirect(name) {
      this.$router.push({name: name});
    },
    performLogout() {
      this.logout();
    }
  }
}

</script>