<template>
  <Header/>
  <div>
    <h4>Welcome, {{this.loggedInEmail}}</h4>
    <div class="container">
      <div class="row">
                  <div class="col-lg-12">
                    <div class="clips">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="heading-section">
                            <h4><em>Your Most Popular</em> Clips</h4>
                          </div>
                        </div>
                        <div v-for="(value, index) in pokemonsData" :key="index" class="col-lg-3 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img :src="value.imageLink" alt="" style="border-radius: 23px;" width="200" height="200">
                            </div>
                            <div class="down-content">
                              <h4>{{value.name}}</h4>
                              <span @click="likePokemon(value)"><i class="notlike fa fa-star fa-2xl"></i></span>
                              <span data-bs-toggle="modal" :data-bs-target="`#detailsModal-${value.id }`"><i class="fa fa-eye fa-2xl" style="color: white"></i></span>
                            </div>
                          </div>
                          <DetailsModal
                        :id="`detailsModal-${value.id }`"
                        :name="value.name"
                        :height="value.height"
                        :weight="value.weight"
                        :abilities="value.abilities"
                        :type="value.type"
                      />
                      </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="main-button">
                            <button class="btn btn-info text-white" @click="loadMore">Load More Pokemons</button>
                          </div>
                        </div>
                  </div>
              </div>
          </div>
    </div>
  </div>
</template>

<script>
import Header from './Header.vue'
import DetailsModal from "./DetailsModal.vue";

export default {
  props: ["pokemons"],
  components:{Header,DetailsModal},

  data() {
    return {
      pokemonsData: [],
      limit : 28,
      loggedInEmail: "",
      user_id: 0,

      next:"",

      thisPokemon:{
        id: 0,
        name: "",
        imageLink: "",
        height: "",
        weight: "",
        abilities: [],
        type: "",
      },

      newPokemon: {
        pokemon_id: null,
        name: "",
        user_id: null,
      },

      liked: false,
      hated: false,

    };
  },

  methods: {
    
     setData(data) {
      var pokemon = {
        id: 0,
        name: "",
        imageLink: "",
        height: "",
        weight: "",
        abilities: [],
        type: "",
      };

      pokemon.id = data.id;
      pokemon.name = data.name;
      pokemon.imageLink = data.sprites.other.dream_world.front_default;
      pokemon.height = data.height;
      pokemon.weight = data.weight;
      pokemon.type = data.types[0].type.name;

      data.abilities.forEach((ability) => {
        pokemon.abilities = [...pokemon.abilities, ability.ability.name];
      });

      this.pokemonsData.push(pokemon);

    },

    fetchIndivData(data) {
      var self = this;

      data.forEach(function(element){
        axios.get(`https://pokeapi.co/api/v2/pokemon/${element.name}`)
      .then(result => {
          self.setData(result.data);
      }).catch((err) => {
        console.log("Error ",err);
        }); 
      });

       
    },


    fetchData(next) {
      let url;
      if(next == undefined){
        url = "https://pokeapi.co/api/v2/pokemon"
      }else{
        url = next;
      }
      console.log(url);


      axios.get(url)
      .then((result)=>{
        const data = result.data;
        this.fetchIndivData(data.results)
        this.next = data.next
      })
      .catch((error) => {
          console.log("There is a problem: ", error);
      });
    },

    loadMore(){
      this.fetchData(this.next);
    },
    likePokemon(value) {
      
      

      this.newPokemon.pokemon_id = value.id;
      this.newPokemon.name = value.name;
      this.newPokemon.user_id = this.user_id;

     axios
        .post("api/pokemons/like/"+this.user_id+"/"+value.id, {
          pokemon: this.newPokemon,
        })
        .then((response) => {
          if (response.status == 200) {
            alert( response.data);
          }
        })
        .catch((error) => {
          console.log("There is a problem: ", error);
        })

    },

  },
  mounted() {

    if (localStorage.getItem('reloaded')) {
        localStorage.removeItem('reloaded');
    } else {
        localStorage.setItem('reloaded', '1');
        location.reload();
    }

    this.fetchData();
    this.loggedInEmail = sessionStorage.getItem("email");
    this.user_id = sessionStorage.getItem("user_id");
    //console.log("session email: ", sessionStorage.getItem("email"));
  },

  created(){
      console.log(sessionStorage.getItem("user_id"))
  }
};
</script>

<style scoped> 
  .like{
      color: yellow !important;
  }

  .notlike{
      color: gray !important;
      cursor: pointer;
  }
</style>