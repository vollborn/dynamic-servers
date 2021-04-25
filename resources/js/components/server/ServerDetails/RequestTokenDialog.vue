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
        {{ $t('server.properties.dialogs.request_token') }}
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="11">
            <v-text-field
              :label="$t('server.properties.dialogs.request_token')"
              :id="tokenId"
              v-model="server.requestToken"
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
              :id="urlId"
              :label="$t('server.properties.dialogs.access_url')"
              v-model="url"
              readonly
              hide-details
            />
          </v-col>
          <v-col cols="1" class="d-flex align-center justify-center">
            <v-btn
              @click="copyUrl"
              class="mt-2"
              icon
            >
              <v-icon>
                {{ hasCopiedUrl ? 'fa-clipboard-check' : 'fa-clipboard' }}
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
        requestToken: null
      })
    }
  },
  data() {
    return {
      dialog: false,
      url: this.getAccessUrl(),
      hasCopiedToken: false,
      hasCopiedUrl: false,
      tokenId: 'server-token-dialog--token-' + Math.floor(Math.random() * 1000),
      urlId: 'server-token-dialog--url-' + Math.floor(Math.random() * 1000)
    }
  },
  watch: {
    dialog(value) {
      if (!value) {
        this.hasCopiedToken = false;
        this.hasCopiedUrl = false;
      }
    }
  },
  methods: {
    getAccessUrl() {
      return process.env.MIX_APP_URL
        + '/api/status/'
        + this.server.id
        + '/'
        + this.server.requestToken;
    },
    copyToken() {
      let textField = document.getElementById(this.tokenId);
      textField.select();
      textField.setSelectionRange(0, this.server.requestToken.length);
      document.execCommand('copy');
      this.hasCopiedToken = true;
    },
    copyUrl() {
      let textField = document.getElementById(this.urlId);
      textField.select();
      textField.setSelectionRange(0, this.url.length);
      document.execCommand('copy');
      this.hasCopiedUrl = true;
    }
  }
}
</script>