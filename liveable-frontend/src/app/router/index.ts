import { createRouter, createWebHistory } from 'vue-router'

import BaseLayout from '@/shared/layouts/baseLayout.vue'

import HomeView from '@/modules/home/views/homeView.vue'
import PropertyDetails from '@/modules/properties/views/propertyDetails.vue'
import BaseLogin from '@/shared/layouts/baseLogin.vue'
import LoginView from '@/modules/login/views/loginView.vue'
import ImoveisPendentes from '@/modules/properties/views/imoveisPendentes.vue'
import MinhasProps from '@/modules/properties/views/minhasProps.vue'

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
      },
      {
        path: 'login',
        name: 'loginPage',
        component: LoginView
      },
      {
        path: 'pendencias',
        name: 'pendenciasPage',
        component: ImoveisPendentes
      },
      {
        path: 'minhasProps',
        name: 'minhasPropspage',
        component: MinhasProps
      }
    ]
  },

  {
    path: '/baselogin',
    component: BaseLogin,
    children: [
      {
        path: '',
        name: 'loginPage',
        component: LoginView
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
