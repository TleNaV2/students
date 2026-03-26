import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import ContactView from '../views/ContactView.vue'
import ShowStudentView from '../views/show_student.vue'
import AddStudentView from '../views/AddStudentView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    component: AboutView
  },
  {
    path: '/contact',
    name: 'contact',
    component: ContactView
  },
  {
    path: '/show_student',
    name: 'show_student',
    component: ShowStudentView
  },
  {
    path: '/add_student',
    name: 'add_student',
    component: AddStudentView
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router