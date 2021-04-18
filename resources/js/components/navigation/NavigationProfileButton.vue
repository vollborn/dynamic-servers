<template>
  <v-menu
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
      >
        <v-icon>
          fa-user
        </v-icon>
      </v-btn>
    </template>

      <v-card>
        <v-list>
          <v-list-item-group>
            <v-list-item>
              <v-list-item-avatar>
                {{ this.getProfileAvatar() }}
              </v-list-item-avatar>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-card>
  </v-menu>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters('auth', ['user'])
  },
  methods: {
    getProfileAvatar() {
      let name = this.user.firstName.slice(0,1) + this.user.lastName.slice(0,1);
      return name.toUpperCase();
    }
  }
}

</script>