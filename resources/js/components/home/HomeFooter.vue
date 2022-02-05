<template>
  <v-container class="py-12">
    <div class="d-flex justify-center">
      <v-btn
        v-if="hasLegalNotice"
        class="mx-1"
        @click="pushRouteTo({name: 'legal-notice'})"
        text
      >
        {{ $t('home.footer.legal_notice') }}
      </v-btn>
      <v-btn
        v-if="hasPrivacyNotice"
        class="mx-1"
        @click="pushRouteTo({name: 'privacy-notice'})"
        text
      >
        {{ $t('home.footer.privacy_notice') }}
      </v-btn>
    </div>
    <a
      class="footer-link"
      :class="hasLegalNotice || hasPrivacyNotice ? 'mt-12' : 'mt-6 mb-2'"
      href="https://www.vollborn.dev"
      target="_blank"
    >
      <div class="logo-container">
        <img src="/assets/vollborn.png" alt=""/>
      </div>
      <div class="name-container">
        Vollborn
      </div>
    </a>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      hasLegalNotice: process.env.MIX_HAS_LEGAL_NOTICE === 'true',
      hasPrivacyNotice: process.env.MIX_HAS_PRIVACY_NOTICE === 'true'
    }
  }
}
</script>

<style scoped lang="scss">
.footer-link {
  font-size: 18px;
  text-decoration: none;
  color: #ccc;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;

  .logo-container {
    width: 35px;
    margin-right: 10px;
    height: 35px;

    img {
      width: 100%;
    }
  }
}
</style>