<template>
  <v-toolbar color="indigo lighten-1" class="white--text">
    <v-toolbar-title>Bitfumes</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-side-icon class="hidden-md-and-up"></v-toolbar-side-icon>
    <div class="hidden-sm-and-down">

      <app-notification v-if="loggedIn"></app-notification>
      
      <router-link to="/ask" v-if="loggedIn">
        <v-btn class="white--text" flat>Ask Question</v-btn>
      </router-link>
      
      <router-link to="/forum">
        <v-btn class="white--text" flat>Forum</v-btn>
      </router-link>
      
      <v-btn class="white--text" 
        v-if="loggedIn" 
        flat @click="logout">Logout
      </v-btn>

      <router-link to="/login" v-else>
        <v-btn class="white--text" flat>Login</v-btn>
      </router-link>

    </div>
  </v-toolbar>
</template>

<script>
import AppNotification from './notification/AppNotifications'
export default {
  components:{AppNotification},
  data(){
    return {
      loggedIn : Auth.loggedIn()
    }
  },
  created(){
    EventBus.$on('logout',() => {
        Auth.logout()
    })
  },
  methods:{
    logout(){
      EventBus.$emit('logout');
    }
  }
}
</script>