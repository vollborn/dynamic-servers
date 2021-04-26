<template>
  <v-dialog
    v-model="isVisible"
    max-width="450"
    @keydown.esc="cancel"
  >
    <v-card>
      <v-card-title>
        <v-icon
          color="primary"
          class="mr-2"
          v-if="icon"
        >
          {{ icon }}
        </v-icon>
        {{ title }}
      </v-card-title>
      <v-divider/>
      <v-card-text
        v-if="message"
        class="my-4 py-0"
      >
        {{ message }}
      </v-card-text>
      <v-card-actions>
        <v-btn @click="cancel">
          {{ $t('dialogs.confirm.cancel') }}
        </v-btn>
        <v-spacer/>
        <v-btn color="primary" @click="confirm">
          {{ $t('dialogs.confirm.confirm') }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      isVisible: false,
      resolve: null,
      reject: null,
      message: null,
      title: null,
      type: null
    };
  },
  computed: {
    icon() {
      switch (this.type) {
        case 'info':
          return 'fa-info-circle';
        case 'alert':
          return 'fa-exclamation-circle';
      }
      return null;
    }
  },
  methods: {
    open(title, message, type = null) {
      this.isVisible = true;
      this.title = title;
      this.message = message;
      this.type = type;

      return new Promise((resolve, reject) => {
        this.resolve = resolve;
        this.reject = reject;
      });
    },
    confirm() {
      this.resolve(true);
      this.isVisible = false;
    },
    cancel() {
      this.resolve(false);
      this.isVisible = false;
    }
  }
};
</script>
