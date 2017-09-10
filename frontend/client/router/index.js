import Vue from 'vue'
import Router from 'vue-router'
import Index from '../components/searcher/index.vue'
import List from '../components/searcher/list.vue'
import Item from '../components/searcher/item.vue'

Vue.use(Router)

export default new Router({
  mode: 'hash',
  routes: [
      {
        path: '/',
        component: Index
      },
      {
        path: '/list',
        component: List
      },
      {
          path: '/item/:id',
          component: Item
      }
  ]
})
