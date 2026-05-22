import { createRouter, createWebHistory } from 'vue-router'

import BaseLayout from '@/shared/layouts/baseLayout.vue'

import HomeView from '@/modules/home/views/homeView.vue'
import PropertyDetails from '@/modules/properties/views/propertyDetails.vue'

const routes = [
  {
    path: '/',
    component: BaseLayout,
    children: [
      {
        path: '',
        name: 'home',
        component: HomeView
      },
      {
        path: 'property-details',
        name: 'propertyDetails',
        component: PropertyDetails
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
