<template>
  <v-card tile>
    <v-toolbar
      tile
      class="px-2"
    >
      <v-toolbar-title>
        {{ $t('background_image.picker.header')}}
      </v-toolbar-title>
      <v-spacer/>
      <v-btn
        fab
        icon
        dark
        @click="close"
      >
        <v-icon>
          fa-times
        </v-icon>
      </v-btn>
    </v-toolbar>
    <v-card-text class="mt-6">
      <v-row>
        <v-col
          v-for="(image, index) in backgroundImages"
          :key="index"
          @click="selectImage(image.id)"
          cols="12"
          sm="6"
          md="4"
          class="cursor-pointer"
        >
          <v-img :src="image.path" />
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  props: {
    value: {
      type: Number,
      required: false,
      default: null
    }
  },
  data() {
    return {
      backgroundImageId: this.value
    }
  },
  computed: {
    ...mapGetters('backgroundImage', ['backgroundImages'])
  },
  watch: {
    value(value) {
      this.backgroundImageId = value;
    },
    backgroundImageId(value) {
      this.$emit('input', value);
    }
  },
  methods: {
    close() {
      this.$emit('close')
    },
    selectImage(id) {
      this.backgroundImageId = id;
      this.close();
    }
  }
}
</script>