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
              @click="copy(tokenId)"
              class="mt-2"
              icon
            >
              <v-icon>
                fa-clipboard
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
              @click="copy(scriptId)"
              class="mt-2"
              icon
            >
              <v-icon>
                fa-clipboard
              </v-icon>
            </v-btn>
          </v-col>
          <v-col cols="11">
            <v-text-field
              :id="cronId"
              :label="$t('server.properties.dialogs.cron_label')"
              v-model="cron"
              readonly
              hide-details
            />
          </v-col>
          <v-col cols="1" class="d-flex align-center justify-center">
            <v-btn
              @click="copy(cronId)"
              class="mt-2"
              icon
            >
              <v-icon>
                fa-clipboard
              </v-icon>
            </v-btn>
          </v-col>
          <v-col cols="12">
            {{ $t('server.properties.dialogs.server_token_description_pre') }}
            {{ getRequestTimeout() }}
            {{ $t('server.properties.dialogs.server_token_description_post') }}
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
      cron: this.getCronjob(),
      tokenId: 'server-token-dialog--token-' + Math.floor(Math.random() * 1000),
      scriptId: 'server-token-dialog--script-' + Math.floor(Math.random() * 1000),
      cronId: 'server-token-dialog--cron-' + Math.floor(Math.random() * 1000)
    }
  },
  methods: {
    getScriptURL() {
      return 'curl -X POST '
        + process.env.MIX_APP_URL
        + '/api/status/'
        + this.server.id
        + '/'
        + this.server.serverToken;
    },
    copy(id) {
      let textField = document.getElementById(id);
      textField.select();
      textField.setSelectionRange(0, textField.value.length);
      document.execCommand('copy');
    },
    getRequestTimeout() {
      return this.server.requestInterval / 1000 - 1;
    },
    getCronjob() {
      let timeout = this.getRequestTimeout();
      let counter = 300 / timeout;

      if (counter > Math.floor(counter)) {
        counter = Math.floor(counter);
      } else {
        counter--;
      }

      return '*/5 * * * * counter=' + counter + '; while [[ $counter > 0 ]]; do ' + this.getScriptURL() + '; counter=$(($counter-1)); sleep ' + timeout + 's; done';
    }
  }
}
</script>