import { createRouter, createWebHistory } from 'vue-router'
import Register from '../components/Pages/User/Register.vue'
import Home from '../components/Pages/User/Home.vue'
import Profile from '../components/Pages/User/Profile.vue'
import Pinjam from '../components/Pages/User/Pinjam.vue'
import About from '../components/Pages/About.vue'
import History from '../components/Pages/User/History.vue'
import Detail from '../components/Pages/User/Detail.vue'
import Add from '../components/Pages/Admin/Add.vue'
import Category from '../components/Pages/User/Category.vue'
import Loading from '../components/layouts/Loading.vue'
import Confirm from '../components/Pages/User/ConfirmBuku.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/Profile', component: Profile },
  { path: '/Pinjam/:username', component: Pinjam },
  { path: '/Confirm/:username', component: Confirm },
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
