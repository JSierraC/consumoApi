<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-success text-white">Register</div>
          <div class="card-body">
            <form>
              <div class="alert alert-danger" role="alert" v-if="error !== null">
                {{ error }}
              </div>      
              <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label text-md-right"
                  >Username</label
                >
                <div class="col-md-6">
                  <input
                    id="name"
                    type="email"
                    class="form-control"
                    v-model="name"
                    required
                    autofocus
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right"
                  >E-Mail Address</label
                >
                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="email"
                    required
                    autofocus
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Password</label
                >
                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="password"
                    required
                    autocomplete="off"
                  />
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button
                    type="submit"
                    class="btn btn-success"
                    @click="handleSubmit"
                  >
                    Register
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      error: null,
    };
  },
  methods: {

    handleSubmit(e) {
      var self = this;
      e.preventDefault();
      if (this.password.length > 0) {
        axios.get("/sanctum/csrf-cookie").then((response) => {
          axios
            .post("api/register", {
              name: this.name,
              email: this.email,
              password: this.password,
            })
            .then((response) => {
              if (response.data.access_token) {
                //window.location.href = "/login"
                this.$router.push({ name: "Login" });
              } else {
                this.error = response.data.message;
              }
            })
            .catch(function (errors) {
              var erro = "";
              var a = JSON.stringify(errors.response.data.errors);
              a = JSON.parse(a);
              for (const property in a) {
                erro += `${property}: ${a[property]} \n`;
              }
              self.error = erro;
            });
        });
      }
    },
  },
};
</script>
<style scoped>
.form-group {
  margin-bottom: 5px;
}
</style>
