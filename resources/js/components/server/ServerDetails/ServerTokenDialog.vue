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
        {{ $t('server.properties.dialogs.server_token') }}
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="11">
            <v-text-field
              :label="$t('server.properties.dialogs.server_token')"
              :id="tokenId"
              v-model="server.serverToken"
              readonly
              hide-details
            />
          </v-col>
          <v-col cols="1" class="d-flex align-center justify-center">
            <v-btn
              @click="copyToken"
              class="mt-2"
              icon
            >
              <v-icon>
                {{ hasCopiedToken ? 'fa-clipboard-check' : 'fa-clipboard' }}
              </v-icon>
            </v-btn>
          </v-col>

          <v-col cols="11">
            <v-text-field
              :id="scriptId"
              :label="$t('server.properties.dialogs.curl_script')"
              v-model="script"
              readonly
              hide-details
            />
          </v-col>
          <v-col cols="1" class="d-flex align-center justify-center">
            <v-btn
              @click="copyScript"
              class="mt-2"
              icon
            >
              <v-icon>
                {{ hasCopiedScript ? 'fa-clipboard-check' : 'fa-clipboard' }}
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
          {{ $t('server.properties.dialogs.close') }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    server: {
      type: Object,
      required: true,
      default: () => ({
        serverToken: null
      })
    }
  },
  data() {
    return {
      dialog: false,
      script: this.getScriptURL(),
      hasCopiedToken: false,
      hasCopiedScript: false,
      tokenId: 'server-token-dialog--token-' + Math.floor(Math.random() * 1000),
      scriptId: 'server-token-dialog--script-' + Math.floor(Math.random() * 1000)
    }
  },
  watch: {
    dialog(value) {
      if (!value) {
        this.hasCopiedToken = false;
        this.hasCopiedScript = false;
      }
    }
  },
  methods: {
    getScriptURL() {
      return 'curl '
        + process.env.MIX_APP_URL
        + '/api/status/'
        + this.server.id
        + '/'
        + this.server.serverToken;
    },
    copyToken() {
      let textField = document.getElementById(this.tokenId);
      textField.select();
      textField.setSelectionRange(0, this.server.serverToken.length);
      document.execCommand('copy');
      this.hasCopiedToken = true;
    },
    copyScript() {
      let textField = document.getElementById(this.scriptId);
      textField.select();
      textField.setSelectionRange(0, this.script.length);
      document.execCommand('copy');
      this.hasCopiedScript = true;
    }
  }
}
</script>