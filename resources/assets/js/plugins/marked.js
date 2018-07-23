import marked from 'marked'

export default {
  install: function(Vue) {
    Object.defineProperty(Vue.prototype, '$marked', { value: marked })
  }
}
