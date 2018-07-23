<template>
<section>
  <v-parallax :src="backgroundPath" height="400">
    <v-layout
      column
      align-center
      justify-center
      class="white--text"
    >
      <img :src="logoPath" alt="Vuetify.js" height="150">
      <h1 class="toptitle white--text mb-2 display-1 text-xs-center" v-text="title"/>
    </v-layout>
    <div class="l-login login pa-2">
      <v-icon color="white" @click="login">lock</v-icon>
    </div>
  </v-parallax>
</section>
</template>

<style scoped lang="scss">
.toptitle {
  text-shadow: #000 0 0 5px;
}
.l-login {
  position: absolute;
  top: 0;
  right: 0;
}
.login {
  text-shadow: #000 0 0 5px;
  a {
    text-decoration: none;
  }
  &:hover {
    color: primary;
  }
}
</style>

<script>
export default {
  props: [
    'title',
    'logoPath',
    'backgroundPath',
    'loginPageUrl'
  ],
  methods: {
    login() {
      const newwindow = window.open();
      newwindow.opener = null;
      newwindow.location = this.loginPageUrl;
    }
  }
}
</script>
