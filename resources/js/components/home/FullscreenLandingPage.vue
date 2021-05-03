<template>
  <div class="fullscreen-background">
    <div class="app-name-label text-center">
      <div class="text-h1">
        Dynamic Servers
      </div>
      <div class="primary--text text-h6 mt-2">
        Free. Open Source.
      </div>
      <div class="mt-2">
        <v-btn
          @click="pushRouteTo({name: 'register'})"
          color="primary"
        >
          Register now
        </v-btn>
      </div>
    </div>
    <div class="down-arrow-container">
      <div class="down-arrow" />
    </div>
  </div>
</template>

<style lang="scss">
.fullscreen-background {
  width: 100%;
  height: calc(100vh - 64px);
  background: url("/assets/background.jpg") no-repeat center center fixed;
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;

  @media (max-width: 960px) {
    & {
      height: calc(100vh - 56px);
    }
  }

  .app-name-label {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  @keyframes down-arrow-blink {
    0% {
      opacity: 0;
    }
    50% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  }

  .down-arrow-container {
    position: absolute;
    bottom: 5%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 50px;
    width: 50px;
    background: #111a;
    border-radius: 50%;

    .down-arrow {
      width: 20px;
      height: 20px;
      border-right: 5px solid #fff;
      border-bottom: 5px solid #fff;
      position: absolute;
      top: 42.5%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(45deg);
      animation: down-arrow-blink infinite 2s;
    }
  }

}
</style>