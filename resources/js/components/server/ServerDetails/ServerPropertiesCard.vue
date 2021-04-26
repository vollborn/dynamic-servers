<template>
  <v-card>
    <v-card-title>
      <v-row no-gutters>
        <v-col cols="6" class="d-flex align-center">
          <server-status-icon :server="server" class="mr-3"/>
          {{ server.name }}
        </v-col>
        <v-col cols="6" class="d-flex justify-end">
          <server-delete-button :server="server"/>
        </v-col>
      </v-row>
    </v-card-title>
    <v-divider/>
    <v-card-text class="my-2">
      <v-row>
        <v-col cols="12" lg="6">
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
        </v-col>
        <v-col cols="12" lg="6">
          <v-row>
            <v-col cols="6">
              {{ $t('server.properties.last_seen_at') }}
            </v-col>
            <v-col cols="6">
              {{ server.lastSeenAt | dateTime }}
            </v-col>
            <v-col cols="6">
              {{ $t('server.properties.created_at') }}
            </v-col>
            <v-col cols="6">
              {{ server.createdAt | dateTime }}
            </v-col>
            <v-col cols="6">
              {{ $t('server.properties.updated_at') }}
            </v-col>
            <v-col cols="6">
              {{ server.updatedAt | dateTime }}
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider/>
    <v-card-text class="my-2">
      <v-row>
        <v-col cols="6">
          {{ $t('server.properties.dialogs.server_token') }}
        </v-col>
        <v-col cols="6" class="d-flex">
          <span class="d-none d-lg-block">
            {{ getPreview(server.serverToken, 20, true) }}
          </span>
          <span class="d-block d-lg-none">
            {{ getPreview(server.serverToken, 10, true) }}
          </span>
          <v-spacer/>
          <server-token-dialog :server="server"/>
        </v-col>
        <v-col cols="6">
          {{ $t('server.properties.dialogs.request_token') }}
        </v-col>
        <v-col cols="6" class="d-flex">
          {{ getPreview(server.requestToken, 10, true) }}
          <v-spacer/>
          <request-token-dialog :server="server"/>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import ServerStatusIcon from "../parts/ServerStatusIcon";
import ServerTokenDialog from "./ServerTokenDialog";
import RequestTokenDialog from "./RequestTokenDialog";
import ServerDeleteButton from "../parts/ServerDeleteButton";

export default {
  components: {ServerDeleteButton, RequestTokenDialog, ServerTokenDialog, ServerStatusIcon},
  props: {
    server: {
      type: Object,
      required: true,
      default: () => null
    }
  }
}
</script>