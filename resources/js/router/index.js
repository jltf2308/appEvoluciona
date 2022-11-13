import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
const Clientes = () => import('@/components/Clientes.vue')
const Profesionales = () => import('@/components/Profesionales.vue')
const ProfesionalForm = () => import('@/components/forms/ProfesionalForm.vue')
const ClienteForm = () => import('@/components/forms/ClienteForm.vue')
const profesionalesAsociados = () => import('@/components/ProfesionalesAsociados.vue')
const asociarProfesionales = () => import('@/components/forms/AsociarProfesionalesForm.vue')
/* Authenticated Component */


const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
        ]
    },
    {
        path: "/clientes",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "clientes",
                path: '',
                component: Clientes,
                meta: {
                    title: `Clientes`
                }
            },
            {
                name: "clientesForm",
                path: 'create',
                component: ClienteForm,
                meta: {
                    title: `Agregar Cliente`
                }
            },
            {
                path: 'profesionales/:companyId',
                name: "profesionalesAsociados",
                component: profesionalesAsociados,
                props: true,
                meta: {
                    title: `Profesionales Asociados`
                }
            },
            {
                path: 'profesionales/:companyId/asociarProfesionales',
                name: "asociarProfesionalesForm",
                component: asociarProfesionales,
                props: true,
                meta: {
                    title: `Asociar Profesionales`
                }
            },
        ]
    },
    {
        path: "/profesionales",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "profesionales",
                path: '',
                component: Profesionales,
                meta: {
                    title: `Profesionales`
                }
            },
            {
                name: "profesionalForm",
                path: 'create',
                component: ProfesionalForm,
                meta: {
                    title: `profesionalForm`
                }
            },
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router