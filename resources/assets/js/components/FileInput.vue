<template>
  <v-layout wrap>
      <v-btn class="ml-0" :disabled="disabled" color="white" @click="onFocus" v-text="label"></v-btn>
      <input type="file" :name="name" :accept="accept" :multiple="false" :disabled="disabled"
             ref="fileInput" @change="onFileChange" style="display:none;">
     <v-text-field
     class="filename"
     flat
     v-model="filename"
     disabled/>
  </v-layout>
</template>

<style scoped>
.filename {
  flex-basis: 0;
}
</style>

<script>
  export default {
    props: [
      'disabled',
      'name',
      'accept',
      'label'
    ],
    data: () => ({
      filename: null
    }),
    mounted () {
      // this.queryAndIndeterminate()
    },

    beforeDestroy () {
      clearInterval(this.interval)
    },

    methods: {
      onFocus () {
        if (!this.disabled) {
          this.$refs.fileInput.click()
        }
      },
      onFileChange ($event) {
        const target = $event.target
        const files = target.files
        this.filename = files[0].name
        this.$emit('change', files[0])
      }
    }
  }
</script>
