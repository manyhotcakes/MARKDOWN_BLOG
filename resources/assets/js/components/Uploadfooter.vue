<template>
  <div>
    <v-footer id="footer" :fixed="true" height="auto" app class="footer pt-4" :style="footerStyle">
      <uploader :token="token" :url="url"/>
    </v-footer>
    <v-btn class="close" fab medium color="orange" @click="onButtonClick" :style="buttonStyle">
      <v-icon v-if="isDisplay" color="white">close</v-icon>
      <v-icon v-else color="white">cloud_upload</v-icon>
    </v-btn>
  </div>
</template>

<style lang="scss" scoped>
.footer {
  z-index: 1000;
  box-shadow: 0px -3px 5px -1px rgba(0, 0, 0, .2),
    0px -6px 10px 0px rgba(0, 0, 0, .14),
    0px -1px 18px 0px rgba(0, 0, 0, .12);
}
.close {
  z-index: 1001;
  position: fixed;
  bottom: 5px;
  right: 5px;
  opacity: 1;
  outline: none;
}
</style>

<script>
import Uploader from './Uploader.vue'
export default {
  components: {
    Uploader
  },
  props: [
    'token',
    'url'
  ],
  data: () => ({
    isDisplay: false
  }),
  methods: {
    onButtonClick () {
      this.isDisplay = !this.isDisplay
    }
  },
  computed: {
    footerStyle () {
      const style = []
      if (!this.isDisplay) {
        style.push({
          transform: 'translateY(300px)'
          // bottom: '-300px'
        })
      }
      return style
    },
    buttonStyle () {
      const style = []
      if (this.isDisplay) {
        style.push({
          bottom: `${document.querySelector('#footer').offsetHeight}px`
        })
        style.push({
          transform: 'translateY(50%)'
        })
      }
      return style
    }
  }
}
</script>
