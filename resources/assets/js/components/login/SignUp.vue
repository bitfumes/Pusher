<template>
  <v-container>
  <v-form  @submit.prevent="submit">
    <v-text-field
      label="Name"
      v-model="form.name"
      required
    ></v-text-field>
    
    <v-text-field
      label="E-mail"
      v-model="form.email"
      required
    ></v-text-field>
    
    
    <v-text-field
      label="Confirm Password"
      v-model="form.password_confirmation"
      required
    ></v-text-field>

    <v-text-field
      label="Password"
      v-model="form.password"
      required
    ></v-text-field>

    <v-btn
    type="submit"
    color="blue"
    >SignUp</v-btn>
    
    <router-link to="/login"><v-btn color="success">Login</v-btn></router-link>

  </v-form>
  </v-container>
</template>


<script>
export default {
  data(){
      return {
          form:{
              name:null,
              email:null,
              password:null,
              password_confirmation:null
          }
      }
  },
  methods:{
      submit(){
        axios.post('/api/signup',this.form)
        .then(res => {
          Auth.respondAfterLogin(res)
          })
      }
  }
}
</script>
