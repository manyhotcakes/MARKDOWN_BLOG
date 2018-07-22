<template>
  <div>
  <template>
    <a class="wrap" :href="link" :class="{disabled: isAdmin}">
      <v-list-tile
        avatar
      >
        <v-list-tile-avatar>
          <img :src="image">
        </v-list-tile-avatar>

        <v-list-tile-content>
          <v-list-tile-title v-html="title"></v-list-tile-title>
          <v-list-tile-sub-title v-html="body"></v-list-tile-sub-title>
        </v-list-tile-content>
      </v-list-tile>
      <v-list-tile v-if="isAdmin">
        <v-flex xs12 class="text-xs-right">
          <v-form :action="removeUrl" method="post" @submit.stop="onSubmit($event)">
            <input type="hidden" name="_token" :value="token">
            <v-btn type="submit" color="primary">
              delete<v-icon>delete_forever</v-icon>
            </v-btn>
          </v-form>
        </v-flex>
      </v-list-tile>
    </a>
  </template>
</div>
</template>

<style scoped>
.wrap.disabled {
  cursor: default;
}
</style>

<script>
  export default {
    props: {
      id: Number,
      subject: String,
      image: String,
      body: String,
      articleUrl: String,
      removeUrl: String,
      token: String,
      mode: {
        type: String,
        default: 'normal'
      }
    },
    computed: {
      link() {
        return !this.isAdmin ? this.articleUrl : false
      },
      isAdmin() {
        return this.mode === 'admin'
      },
      title() {
        if (this.isAdmin) {
          return `#${this.id} ${this.subject}`
        } else {
          return this.subject
        }
      }
    },
    methods: {
      onSubmit(event) {
        if (!confirm('Are you sure you want to delete this article?')) {
          if (event) event.preventDefault()
          return false
        }
      }
    }
  }
</script>
