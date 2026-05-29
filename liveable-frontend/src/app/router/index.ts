import { createRouter, createWebHistory } from 'vue-router'
import { isAuthenticated } from '@/services/auth'

import BaseLayout from '@/shared/layouts/baseLayout.vue'

import HomeView from '@/modules/home/views/homeView.vue'
import PropertyDetails from '@/modules/properties/views/propertyDetails.vue'
import BaseLogin from '@/shared/layouts/baseLogin.vue'
import LoginView from '@/modules/login/views/loginView.vue'
import ImoveisPendentes from '@/modules/properties/views/imoveisPendentes.vue'
import MinhasProps from '@/modules/properties/views/minhasProps.vue'
import CadastroView from '@/modules/login/views/cadastroView.vue'
import ViewProfile from '@/modules/profile/views/viewProfile.vue'

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
        path: '/property-details/:id',
        name: 'propertyDetails',
        component: PropertyDetails
      },
      {
        path: 'pendencias',
        name: 'pendenciasPage',
        component: ImoveisPendentes,
        meta: { requiresAuth: true } // ← protegida
      },
      {
        path: 'minhasProps',
        name: 'minhasPropspage',
        component: MinhasProps,
        meta: { requiresAuth: true } // ← protegida
      },
      {
        path: 'perfil',
        name: 'perfilPage',
        component: ViewProfile,
        meta: { requiresAuth: true } // ← protegida
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
        component: LoginView,
        meta: { guestOnly: true } // ← adiciona isso
      },
      {
        path: 'cadastrar',
        name: 'cadastrarPage',
        component: CadastroView,
        meta: { guestOnly: true } // ← e isso
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  // rota protegida sem token → vai pro login
  if (to.meta.requiresAuth && !isAuthenticated()) {
    next('/baselogin')
  }
  // rota de guest com token → vai pro perfil
  else if (to.meta.guestOnly && isAuthenticated()) {
    next('/') // ou '/perfil' se tiver essa rota
  }
  else {
    next()
  }
})


export default router
