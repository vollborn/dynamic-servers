<template>
  <v-container class="py-12">
    <div class="d-flex justify-center">
      <v-btn
        class="mx-1"
        text
      >
        {{ $t('home.footer.imprint') }}
      </v-btn>
      <v-btn
        class="mx-1"
        text
      >
        {{ $t('home.footer.privacy_notice') }}
      </v-btn>
    </div>
    <a
      class="footer-link mt-12"
      href="https://code-experience.org"
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

  .name-container {

  }
}
</style>