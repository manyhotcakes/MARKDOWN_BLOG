<template>
  <v-card v-if="data">
    <!-- 画像部分 -->
    <v-card-media
      class="white--text"
      height="40vh"
      :src="data.image_path"
    >
      <v-container fill-height fluid>
        <v-layout xs12>
          <v-flex xs-8 align-end d-flex>
            <!-- タイトル -->
            <span class="headline">
              {{ data.subject }}</span>
          </v-flex>
          <v-flex xs-4 class="datetime">
            <p class="text-xs-right my-0">post: {{ data.created_at }}</p>
            <p class="text-xs-right my-0">update: {{ data.updated_at }}</p>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-media>
    <!-- パンくずメニューが親要素からslotで登録されていれば表示 -->
    <v-layout>
      <!-- 日付 -->
      <v-flex>
        <slot name="breadcrumbs"></slot>
      </v-flex>
    </v-layout>
    <!-- 本文 -->
    <v-card-text class="markdown-body" v-html="compiledMarkdown">
    </v-card-text>
  </v-card>
</template>

<style lang="scss" scoped>
.l-wrap {
  width: 100%;
}
.l-image {
  height: 40vh;
}
.l-image_in {
  height: 100%;
  position: relative;
}
.l-subject {
  position: absolute;
  z-index: 1000;
  top: 0;
  left: 0;
  right: 0;
}
.image {
  background-size: cover;
  background-position: center;
  z-index: 0;
  text-align: center;
  &::before {
    content: '';
    position: absolute;
    top: -7px;
    left: -7px;
    right: -7px;
    bottom: -7px;

    background: inherit;
    filter: grayscale(100%) blur(7px) brightness(50%);
    z-index: -1;
  }
  &_content {
    position: static;
    width: 100%;
    height: 100%;
    vertical-align: middle;
    object-fit: contain;
    & > img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
}
.headline {
  text-shadow: #000 0 0 4px;
  word-break: break-all;
}
.datetime {
  text-shadow: #000 0 0 4px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  flex: 1 0 auto;
}
</style>

<script>
export default {
  data: () => ({
    data: null
  }),
  props: {
    rowdata: String
  },
  mounted() {
    this.data = JSON.parse(this.rowdata)
  },
  methods: {
  },
  computed: {
    imageStyle() {
      console.log(this.data)
      return `background-image: url(${this.data.image_path})`
    },
    compiledMarkdown: function () {
      return this.$marked(this.data.body, { sanitize: true })
    }
  }
}
</script>
