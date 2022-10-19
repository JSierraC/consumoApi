<template>
	<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="logo.png" alt="">
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
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
</template>
<script>
export default {
  	name: "Header",
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
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },

        checkIfLoggedIn(){


        }
    },

    created() {

        let sessionEmail = sessionStorage.getItem("email");
        let sessionuserId = sessionStorage.getItem("user_id");

        if(sessionEmail && sessionuserId){
            this.isLoggedIn = true;
            this.$router.push({name: 'Dashboard'});
        }
        else{
            this.isLoggedIn = false;
            this.$router.push({name: 'Home'});
        }

        console.log("Session email: ", sessionEmail);
        console.log("Is logged in: ", this.isLoggedIn);

    },
};
</script>
<style scoped>

</style>