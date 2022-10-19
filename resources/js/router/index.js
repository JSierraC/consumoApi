import {createRouter, createWebHistory} from 'vue-router'
import Home from '../pages/Home.vue'
import Register from '../pages/Register.vue'
import Login from '../pages/Login.vue'

/*  import AccountView from '../components/account/AccountView.vue'
import Dashboard from '../components/Dashboard.vue'
import LikedPokemons from '../components/LikedPokemons.vue'
import HatedPokemons from '../components/HatedPokemons.vue'
import OtherUsers from '../components/OtherUsers.vue'
*/
const routes = [
    {
        name: 'Home',
        path: '/revisar',
        component: Home
    },
    {
        name: 'Register',
        path: '/register',
        component: Register
    },
    {
        name: 'Login',
        path: '/login',
        component: Login
    },
  /*  
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'AccountView',
        path: '/account-view',
        component: AccountView
    },

    {
        name: 'LikedPokemons',
        path: '/liked-pokemons',
        component: LikedPokemons
    },

    {
        name: 'HatedPokemons',
        path: '/hated-pokemons',
        component: HatedPokemons
    },
    {
        name: 'OtherUsers',
        path: '/other-users',
        component: OtherUsers
    }
*/
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

export default router