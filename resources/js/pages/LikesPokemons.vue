<template>
  <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Pokemons you</em>  like</h4>
              </div>
              <div class="item"  v-for="(pokemon, index) in this.likedPokemons" :key="index">
                <ul>
                  <li><img src="assets/images/game-01.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>Dota 2</h4><span>{{pokemon.pokemon_id}}</span></li>
                  <li><h4>Date Added</h4><span>24/08/2036</span></li>
                  <li><h4>Hours Played</h4><span>{{pokemon.name}}</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <router-link to="/dashboard" >Back List</router-link>
              </div>
            </div>
          </div>
</template>

<script>


export default {
  data(){
    return{
      user_id: 0,
      likedPokemons : [],
    }
  },
  methods:{

     fetchData() {
        axios.get("/api/pokemons/likes/"+this.user_id)
        .then((result)=>{
          const data = result.data;
          this.likedPokemons = data;
          console.log("Liked: ", this.likedPokemons);
        })
        .catch((error) => {
            console.log("There is a problem: ", error);
        });
    },

    
  },

  mounted(){
    this.loggedInEmail = sessionStorage.getItem("email");
    this.user_id = sessionStorage.getItem("user_id");
    this.fetchData()
  }

};
</script>

<style scoped>
  .liked-pokemons{
    font-size: 20px;
  }
  .liked-table{
    background-color: bisque;
  }

</style>