<template>
  <v-card>
    <v-card-title>
      <server-status-icon :server="server" class="mr-3" />
      {{ server.name }}
    </v-card-title>
    <v-divider />
    <v-card-text class="my-2">
      <v-row>
        <v-col cols="6">
          {{ $t('server.properties.server_name') }}
        </v-col>
        <v-col cols="6">
          {{ server.name }}
        </v-col>
        <v-col cols="6">
          {{ $t('server.properties.server_id') }}
        </v-col>
        <v-col cols="6">
          {{ server.id }}
        </v-col>
        <v-col cols="6">
          {{ $t('server.properties.ip_address') }}
        </v-col>
        <v-col cols="6">
          {{ server.ipAddress ? server.ipAddress : '-' }}
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider/>
    <v-card-text class="my-2">
      <v-row>
        <v-col cols="6">
          {{ $t('server.properties.server_token') }}
        </v-col>
        <v-col cols="6" class="d-flex">
          {{ getPreview(server.serverToken, 20, true) }}
          <v-spacer/>
          <view-token-button :label="'Server Token'" :token="server.serverToken"/>
        </v-col>
        <v-col cols="6">
          {{ $t('server.properties.request_token') }}
        </v-col>
        <v-col cols="6" class="d-flex">
          {{ getPreview(server.requestToken, 10, true) }}
          <v-spacer/>
          <view-token-button :label="'Request Token'" :token="server.requestToken"/>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import ViewTokenButton from "./ViewTokenButton";
import ServerStatusIcon from "../parts/ServerStatusIcon";

export default {
  components: {ServerStatusIcon, ViewTokenButton},
  props: {
    server: {
      type: Object,
      required: true,
      default: () => null
    }
  }
}
</script>