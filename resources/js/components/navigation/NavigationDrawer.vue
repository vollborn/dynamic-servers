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
          Übersicht
        </v-subheader>

        <v-list-item link>
          <v-list-item-icon class="mr-2">
            <div class="d-flex justify-center align-center" style="width: 40px">
              <v-icon size="20">fa-border-all</v-icon>
            </div>
          </v-list-item-icon>
          <v-list-item-content>
            Dashboard
          </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-icon class="mr-2">
            <div class="d-flex justify-center align-center" style="width: 40px">
              <v-icon size="20">fa-envelope</v-icon>
            </div>
          </v-list-item-icon>
          <v-list-item-content>
            Support
          </v-list-item-content>
        </v-list-item>

        <v-subheader class="primary--text mt-4">
          Server
        </v-subheader>
        <v-list-item link>
          <v-list-item-icon class="mr-2">
            <div class="d-flex justify-center align-center" style="width: 40px">
              <v-icon size="20">fa-envelope</v-icon>
            </div>
          </v-list-item-icon>
          <v-list-item-content>
            Server 1
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import {mapGetters} from "vuex";

export default {
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
    ...mapGetters('auth', ['isAuth'])
  },
  watch: {
    isOpen(value) {
      this.$emit('input', value)
    },
    value(value) {
      this.isOpen = value;
    }
  }
}
</script>