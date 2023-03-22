import { createRouter, createWebHistory } from 'vue-router'
import Register from '../components/Pages/Register.vue'
import Home from '../components/Pages/Home.vue'
import Profile from '../components/Pages/Profile.vue'
import Pinjam from '../components/Pages/Pinjam.vue'
import About from '../components/Pages/About.vue'
import History from '../components/Pages/History.vue'
import Detail from '../components/Pages/Detail.vue'
import Add from '../components/Pages/Add.vue'
import Category from '../components/Pages/Category.vue'
import Loading from '../components/layouts/Loading.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/Profile', component: Profile },
  { path: '/Pinjam/:username', component: Pinjam },
  { path: '/Register', component: Register },
  { path: '/About', component: About },
  { path: '/History', component: History },
  { path: '/Detail/:id', component: Detail },
  { path: '/Add', component: Add },
  { path: '/Kategori', component: Category },
  { path: '/Loading', component: Loading },
  { path: '/:pathMatch(.*)*', redirect: '/' },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})
export default router
