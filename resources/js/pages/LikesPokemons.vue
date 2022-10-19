<template>
  <div class="liked-pokemons">
    <h4 class="mb-5">Pokemons you liked</h4>
    <div class="container">
    <table class="table table-hover liked-table shadow-lg">
      <thead>
        <tr class="text-center">
          <th>Pokemon ID</th>
          <th>Pokemon Name</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center" v-for="(pokemon, index) in this.likedPokemons" :key="index">
          <td>{{pokemon.pokemon_id}}</td>
          <td class="text-success fw-bold">{{pokemon.name}}</td>
        </tr>
      </tbody>
    </table>
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