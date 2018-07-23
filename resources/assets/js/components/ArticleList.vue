<template>
  <v-card>
    <v-list two-line>
      <template v-for="(item, index) in items" v-if="items.length">
        <article-list-item
          :id="item.id"
          :subject="item.subject"
          :image="item.image_path"
          :body="item.body"
          :key="item.id"
          :article-url="item.article_url"
          :remove-url="item.remove_url"
          :token="token"
          :mode="mode"
        >
        </article-list-item>
        <v-divider v-if="items.length - 1 !== index"></v-divider>
      </template>
      <template v-if="!items.length">
        <v-list-tile class="text-xs-center">
          <v-flex>
          No Entries
          </v-flex>
        </v-list-tile>
      </template>
    </v-list>
  </v-card>
</template>
<script>
import ArticleListItem from './ArticleListItem.vue'
  export default {
    props: {
      rowdata: String,
      token: String,
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
