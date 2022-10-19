import {createRouter, createWebHistory} from 'vue-router'
import Home from '../pages/Home.vue'
import Register from '../pages/Register.vue'
import Login from '../pages/Login.vue'
import Dashboard from '../components/Dashboard.vue'
import LikesPokemons from '../pages/LikesPokemons.vue'
import Profile from '../pages/Profile.vue'

const routes = [
    {
        name: 'Home',
        path: '/',
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
   
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'Profile',
        path: '/profile',
        component: Profile
    },

    {
        name: 'Likes',
        path: '/likes-pokemons',
        component: LikesPokemons
    }

]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

export default router