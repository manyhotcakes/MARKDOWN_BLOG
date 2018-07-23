<template>
  <v-container>
    <v-form id="uploader" :action="url" enctype="multipart/form-data" method="post">
      <v-layout row wrap>
        <v-flex xs12 class="text-sm-center">
          <v-text-field
          v-validate="'required|max:255'"
          v-model="subject"
          :counter="255"
          :error-messages="errors.collect('subject')"
          label="記事タイトル"
          required
          name="subject"
          data-vv-name="subject"/>
        </v-flex>
        <v-flex xs12 class="text-xs-left text-sm-center">
          <file-input label="mdファイル選択" name="file" accept=".md" @change="onChangeMd"/>
        </v-flex>
        <v-flex xs12 class="text-xs-left text-sm-center">
          <file-input label="サムネ選択" name="image" accept="image/*" @change="onChangeThumb"/>
        </v-flex>
        <v-flex xs12 class="text-xs-right">
          <v-btn
            :disabled="!formValid"
            color="blue"
            class="white--text mr-0"
            type="submit"
          >
            Upload
            <v-icon right dark>cloud_upload</v-icon>
          </v-btn>
        </v-flex>
      </v-layout>
      <input type="hidden" name="_token" v-model="token">
    </v-form>
    <div>
      <v-progress-linear
        v-show="uploading"
        :indeterminate="true"
        height="4"
      />
    </div>
  </v-container>
</template>

<style scoped>
.l-wrap {
  width: 80%;
  margin: auto;
  padding: 20px 0;
}
</style>

<script>
import FileInput from './FileInput.vue'
export default {
  $_veeValidate: {
    validator: 'new'
  },
  components: {
    FileInput
  },
  props: {
    token: {},
    url: String
  },
  data: () => ({
    file: null,
    uploading: false,
    subject: '',
    thumbnail: null,
    dictionary: {
      custom: {
        subject: {
          required: '必須フィールドです',
          max: '名前は20文字以内で設定してください'
        }
      }
    }
  }),
  mounted () {
    this.$validator.localize('ja', this.dictionary)
  },
  methods: {
    formClear () {
      this.file = null
      this.subject = null
    },
    onChangeMd (file) {
      if (!file) {
        this.formClear()
      } else {
        this.file = file
      }
    },
    onChangeThumb (file) {
      if (!file) {
        this.formClear()
      } else {
        this.thumbnail = file
      }
    }
  },
  computed: {
    formValid () {
      return Object.keys(this.fields).every(field => {
        return this.fields[field] && this.fields[field].valid;
      }) && !!this.file;
    }
  }
}
</script>
