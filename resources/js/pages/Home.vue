<template>
  <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Welcome To Pokegrid</h6>
                  <h4><em>Browse</em> Our Popular Games Here</h4>
                  <div class="main-button">
                    <router-link to="/register" >Register Now</router-link>
                  </div>
                </div>
                <br/>
                
              </div>
            </div>
</template>

<script>
export default {
  name: "Home",
  mounted() {
    console.log("mounted home");
  },

  created() {
    console.log("created home");
  }
};
</script>
<style scoped>
</style>