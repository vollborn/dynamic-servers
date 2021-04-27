<template>
  <v-card-title>
    <div>
      <div>
        {{ title }}
      </div>
      <div class="text-body-2 primary--text">
        {{ subtitle }}
      </div>
    </div>
  </v-card-title>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: false,
      default: null
    },
    subtitle: {
      type: String,
      required: false,
      default: null
    }
  }
}
</script>