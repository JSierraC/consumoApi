<template>
  <div class="account-view">
    <div class="container">
      <h4>Welcome, {{this.loggedInEmail}}!</h4>
      <p class="text-primary">Double-click form to register and/or update information.</p>
      <div class="row shadow-lg">
        <div class="col rounded-start form-side">
          <h5 class="heading text-white">User Information</h5>

            <!-- form -->
            <div class="form">
            <div class="mb-3">
              <label class="form-label text-white">Name</label>
              <input
                type="text"
                id="name"
                :disabled="true"
                class="form-control"
                v-model="this.userdetails.name"
              />
            </div>
            <div class="mb-3">
              <label class="form-label text-white">Email</label>
              <input
                type="text"
                id="email"
                :disabled="true"
                class="form-control"
                v-model="this.userdetails.email"
              />
            </div>
            <div class="mb-3">
              <label class="form-label text-white">Address</label>
              <input
                type="text"
                id="address"
                autocomplete="off"
                class="form-control"
                v-model="this.userdetails.address"
              />
            </div>
            <div class="mb-3">
              <label class="form-label text-white">Birth Date</label>
              <input
                type="date"
                id="birthdate"
                class="form-control"
                v-model="this.userdetails.birthdate"
              />
            </div>
            <div class="mb-3">
              <label class="form-label text-white">City</label>
              <input
                type="text"
                id="city"
                autocomplete="off"
                class="form-control"
                :class="editableTrue"
                v-model="this.userdetails.city"
              />
            </div>
            <button :class="text-white" :onClick="updateDetails">
              Update
            </button>
          </div><!--end .form -->


        </div>

        <div class="col rounded-end image-side"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return{
      userdetails:{
        user_id: 0,
        name:"",
        email:"",
        address: "",
        birthdate: "",
        city: ""
      },
      editable: false,
      user_id: 0,
      loggedInEmail: ""
    }
  },

  methods: {

    fetchDetails(){
      axios.get("/sanctum/csrf-cookie").then((response) => {
      axios.get('api/userDetails/'+this.user_id)
        .then(result => {
          console.log("userdetail: ", result.data);

          if(!result.data){
            this.userdetails.user_id = this.user_id;
            this.userdetails.name = "";
            this.userdetails.email = "";
            this.userdetails.address = "",
            this.userdetails.birthdate = "",
            this.userdetails.city = ""

          }
          else{
            this.userdetails = result.data;
          }

          
        })


        .catch((err) => {
         console.log(err);
      });

      })    
    },

    updateDetails(){
      axios.put('api/userDetails/'+ this.user_id, {
         detail : this.userdetails
      })
      .then(result => {
        if(result.status == 200){
          alert("Information Updated");
          this.editable = false

        }
      }).catch(err => {
        console.log(err)
      });
     }

  },
  mounted() {
     this.user_id = sessionStorage.getItem("user_id");
     this.loggedInEmail = sessionStorage.getItem("email");
     this.fetchDetails();
     console.log("user ID: ", this.user_id);

  },
};
</script>
<style scoped>
  .account-view {
    padding-bottom: 100px;
    font-family: "Poppins";

  }
  .form {
    width: 50%;
    display: block;
    margin: auto;
  }
  .form-side,
  .image-side {
    height: 600px;
  }
  .form-side {
    background-image: linear-gradient(-225deg, #f77361 0%, #e1341e 75%);
  }
  .image-side {
    background-image: url("http://localhost:8000/image/21003.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
  }

  .heading {
    margin: 30px;
  }
  .container {
    padding-left: 100px;
    padding-right: 100px;
    padding-bottom: 50px;
  }
  .editableTrue{
    background-color: transparent;
    border: 0px;
    font-weight: bold;
    color: #61E5F7;
  }
  .editableBG{
    background-color: azure;
  }
</style>