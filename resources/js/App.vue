<template>
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
            <router-view/>
        </div>
      </div>
    </div>
  </div>
  
 </template>
<script>

export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
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
        console.log("created");
        let sessionEmail = sessionStorage.getItem("email");
        let sessionuserId = sessionStorage.getItem("user_id");
        console.log("sessionEmail && sessionuserId");
        console.log(sessionEmail && sessionuserId);
        if(sessionEmail && sessionuserId){
            this.isLoggedIn = true;
            this.$router.push({name: 'Dashboard'});
        }
        else{
            this.isLoggedIn = false;
            console.log("route home");
            this.$router.push({name: 'Home'});
        }

        console.log("Session email: ", sessionEmail);
        console.log("Is logged in: ", this.isLoggedIn);

    },
}
</script>
<style scoped>
  .logo-banner{
    height: 30px;
    width: 70px;
  }
</style>