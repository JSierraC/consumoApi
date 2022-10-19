<template>
    <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="#" class="logo">
                        <img :src="img" alt="">
                    </a>
                    
                    <ul class="nav" v-if="!this.isLoggedIn">
                        <li><router-link to="/login" >Login</router-link></li>
                        <li><router-link to="/register" >Register</router-link></li>
                    </ul>   
                    <ul class="nav" v-if="this.isLoggedIn">
                        <li><router-link to="/likes-pokemons" >My Favorite</router-link></li>
                        <li><router-link to="/profile" >My Profile</router-link></li>
                        <li><a @click="this.logout">Logout</a></li>
                    </ul>
                    
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
            {{this.isLoggedIn}}
            <router-view/>
            
        </div>
      </div>
    </div>
  </div>
  
 </template>
<script>
import img from "../statics/images/logo.png"

export default {
    name: "App",
    data() {
        return {
            isLoggedIn: true,
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            sessionStorage.clear();
                            this.isLoggedIn = false;
                            this.$router.push({name: 'Home'});
                        } else {
                        
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },

        checkIfLoggedIn(){
            let sessionEmail = sessionStorage.getItem("email");
            let sessionuserId = sessionStorage.getItem("user_id");
            if(sessionEmail==null && sessionuserId==null){
                this.isLoggedIn = false;
                this.$router.push({name: 'Home'});
            }else{
                this.isLoggedIn = true;
                this.$router.push({name: 'Dashboard'});
            }
        }
    },

    created() {
        this.checkIfLoggedIn();
    },
}
</script>
<style scoped>
  .logo-banner{
    height: 30px;
    width: 70px;
  }
</style>