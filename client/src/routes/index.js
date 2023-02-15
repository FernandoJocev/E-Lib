import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Pages/Home.vue'
import About from '../components/Pages/About.vue'
import History from '../components/Pages/History.vue'
import Detail from '../components/Pages/Detail.vue'
import Add from '../components/Pages/Add.vue'
import Category from '../components/Pages/Category.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/About', component: About },
  { path: '/History', component: History },
  { path: '/Detail/:id', component: Detail },
  { path: '/Add', component: Add },
  { path: '/Kategori', component: Category },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
