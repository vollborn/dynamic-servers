<template>
  <v-dialog
    v-model="dialog"
    width="500"
  >
    <template #activator="{ on, attrs }">
      <v-btn
        icon
        small
        color="primary"
        v-bind="attrs"
        v-on="on"
      >
        <v-icon small>fa-eye</v-icon>
      </v-btn>
    </template>

    <v-card>
      <v-card-title>
        {{ label }}
      </v-card-title>
      <v-card-text>
        <v-row>

          <v-col cols="11">
            <v-text-field
              :id="textFieldId"
              class="pt-0 mt-0"
              v-model="token"
              readonly
              hide-details
            />
          </v-col>
          <v-col cols="1" class="d-flex align-center justify-center">
            <v-btn
              @click="copy"
              icon
            >
              <v-icon>
                {{ hasCopied ? 'fa-clipboard-check' : 'fa-clipboard' }}
              </v-icon>
            </v-btn>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-spacer/>
        <v-btn
          color="primary"
          @click="dialog = false"
        >
          Close
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      required: false,
      default: null
    },
    token: {
      type: String,
      required: false,
      default: null
    }
  },
  data() {
    return {
      dialog: false,
      hasCopied: false,
      textFieldId: 'view-token-button-' + Math.floor(Math.random() * 10000)
    }
  },
  watch: {
    dialog(value) {
      if (!value) {
        this.hasCopied = false;
      }
    }
  },
  methods: {
    copy() {
      let textField = document.getElementById(this.textFieldId);
      textField.select();
      textField.setSelectionRange(0,this.token.length);
      document.execCommand('copy');
      this.hasCopied = true;
    }
  }
}
</script>