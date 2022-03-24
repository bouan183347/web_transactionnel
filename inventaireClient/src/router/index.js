import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/ajout',
      name: 'ajout',
      component: () => import('../views/AjoutView.vue')
    },
    {
      path: '/modification',
      name: 'modification',
      component: () => import('../views/ModificationView.vue')
    },
    {
      path:'/produit',
      name:'produit',
      component: () => import('../views/ProduitView.vue')

    }
  ]
})

export default router
