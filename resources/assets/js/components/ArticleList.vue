<template>
  <v-card>
    <v-list two-line>
      <template v-for="(item, index) in items">
        <article-list-item
          :id="item.id"
          :subject="item.subject"
          :image="item.image_path"
          :body="item.body"
          :key="item.id"
          :articleUrl="item.article_url"
          :mode="mode"
        >
        </article-list-item>
        <v-divider v-if="items.length - 1 !== index"></v-divider>
      </template>
    </v-list>
  </v-card>
</template>
<script>
import ArticleListItem from './ArticleListItem.vue'
  export default {
    props: {
      rowdata: String,
      mode: {
        type: String,
        default: 'normal'
      }
    },
    data: () => ({
      data: []
    }),
    components: {
      ArticleListItem
    },
    mounted() {
      this.data = JSON.parse(this.rowdata)
    },
    computed: {
      items() {
        return (this.data.data || [])
      },
      isAdmin() {
        return this.mode === 'admin'
      }
    }
  }
</script>
