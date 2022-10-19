<template>
    <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <div class="search-input">
                      <form id="search" action="#">
                        <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div>
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav" v-if="!this.isLoggedIn">
                        <li><a href="index.html" class="active">Home</a></li>
                        <li><a href="browse.html">Browse</a></li>
                        <li><a href="details.html">Details</a></li>
                        <li><a href="streams.html">Streams</a></li>
                        <li><a href="profile.html">Profile <img src="assets/images/profile-header.jpg" alt=""></a></li>
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
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Banner Start ***** -->
          <div class="main-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Welcome To PokeGrid</h6>
                  <h4><em>Browse</em> Our Popular Games Here</h4>
                  <div class="main-button">
                    <a href="browse.html">Browse Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Most Popular Start ***** -->
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