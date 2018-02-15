<template>
  <v-container class="mb-4">
    <h1>Ask new Question</h1>
  <v-form  @submit.prevent="submit">
    <v-text-field
      label="Title"
      v-model="form.title"
      required
    ></v-text-field>

    <v-select
        :items="categories"
        v-model="form.category_id"
        item-text="name"
        item-value="id"
        label="Select"
        autocomplete
    ></v-select>
    
    <markdown-editor v-model="form.body"></markdown-editor>

    <v-btn
    type="submit"
    color="indigo"
    class="white--text"
    >Submit</v-btn>
    
    <router-link to="/login"><v-btn color="success">All </v-btn></router-link>

  </v-form>
  </v-container>
</template>

<script>
  export default {
      methods:{
        submit(){
          axios.post('/api/questions',this.form)
          .then(res => {
            Auth.redirect(res.data)
          })
          .catch((err) => {
            Exception.handle(err.response.data)
            // Auth.logout()
          })
          // window.location = '/forum'
        },
        getChannel(){
          axios.post('/api/category/all')
          .then(res => this.categories = res.data.data)
        }
      },
      created(){
        if(!Auth.loggedIn()){
          this.$router.push({name: 'forum' });
        }
        this.getChannel()
      },
    data () {
      return {
          form:{
              title:null,
              body:null,
              category_id:null
          },
          categories:{
            id:null,
            name:null
          },
      }
    }
  }
</script>