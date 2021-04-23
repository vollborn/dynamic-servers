<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    transition="dialog-bottom-transition"
  >
    <template #activator="{on, attrs}">
      <div>
        <div v-if="backgroundImage" class="background-image-picker-container">
          <div class="image-container">
            <img :src="backgroundImage.path" alt=""/>
          </div>
          <div class="button">
            <v-btn
              color="primary"
              v-bind="attrs"
              v-on="on"
              :loading="openButtonDisabled"
              :disabled="openButtonDisabled"
              class="mb-1"
            >
              <v-icon
                small
                class="mr-3"
              >
                fa-camera
              </v-icon>
              {{ $t('background_image.picker.select') }}
            </v-btn>
          </div>
        </div>

        <v-btn
          v-else
          color="primary"
          v-bind="attrs"
          v-on="on"
          :loading="openButtonDisabled"
          :disabled="openButtonDisabled"
        >
          <v-icon
            small
            class="mr-3"
          >
            fa-camera
          </v-icon>
          {{ $t('background_image.picker.select') }}
        </v-btn>
      </div>
    </template>

    <background-image-selection
      v-model="backgroundImageId"
      @close="dialog = false"
    />
  </v-dialog>
</template>

<script>
import BackgroundImageSelection from "./BackgroundImageSelection";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {BackgroundImageSelection},
  props: {
    value: {
      type: Number,
      required: false,
      default: null
    }
  },
  data() {
    return {
      dialog: false,
      backgroundImageId: this.value,
      backgroundImage: null,
      backgroundImageLoaded: false
    }
  },
  created() {
    if (this.backgroundImages.length === 0) {
      this.getBackgroundImages()
        .then(() => this.updateBackgroundImage());
    } else {
      this.updateBackgroundImage();
    }
  },
  computed: {
    ...mapGetters('backgroundImage', ['backgroundImages', 'isLoadingBackgroundImages']),
    openButtonDisabled() {
      return this.isLoadingBackgroundImages || this.backgroundImages.length === 0
    }
  },
  watch: {
    value(value) {
      this.backgroundImageId = value;
      this.updateBackgroundImage();
    },
    backgroundImageId(value) {
      this.$emit('input', value);
    }
  },
  methods: {
    ...mapActions('backgroundImage', ['getBackgroundImages']),
    updateBackgroundImage() {
      this.backgroundImageLoaded = false;
      this.backgroundImage = null;
      if (!this.backgroundImageId || !this.backgroundImages) {
        return;
      }

      let filtered = this.backgroundImages.filter(item => item.id === this.backgroundImageId);
      if (filtered) {
        this.backgroundImageLoaded = true;
        this.backgroundImage = filtered[0];
      }
    }
  }
}
</script>

<style lang="scss">
.background-image-picker-container {
  position: relative;
  width: 100%;

  .image-container {
    width: 100%;
    z-index: -1;

    img {
      width: 100%;
    }
  }

  .button {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: flex-end;
    padding: 10px;
  }
}
</style>