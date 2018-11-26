import VueRouter from 'vue-router'

import Home from '../components/Home.vue'
import Book from '../components/Book.vue'
import Author from '../components/Author.vue'
import Genre from '../components/Genre.vue'
import Quest from '../components/Quest.vue'



const routes = [
  { path: '/', component: Home },
  {
    path: '/book',
    component: Book
  },
  {
    path: '/author',
    component: Author
  },
  {
    path: '/genre',
    component: Genre
  },
  {
    path: '/quest',
    component: Quest
  }
]

export default new VueRouter({
  routes,
  mode: 'history'
})
