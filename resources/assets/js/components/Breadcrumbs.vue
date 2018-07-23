<template>
  <v-breadcrumbs class="pb-0">
    <v-icon slot="divider">chevron_right</v-icon>

    <v-breadcrumbs-item
      v-for="(item, index) in items"
      :href="item.url"
      :key="index"
    >
    {{item.text}}
    </v-breadcrumbs-item>
  </v-breadcrumbs>
</template>

<script>
export default {
  props: {
    list: {
      default: []
    }
  },
  computed: {
    items() {
      return JSON.parse(this.list)
    }
  }
}
</script>
