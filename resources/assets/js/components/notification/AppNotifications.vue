<template>
    <v-menu offset-y v-if="reads.length || unreads.length">
        <v-btn icon class="white--text" slot="activator">
            <v-icon color="red">add_alert</v-icon>{{unreads.length}}
        </v-btn>
      <v-list>
        <v-list-tile v-for="unread in unreads" @click="read(unread)" :key="unread.id">
            <v-list-tile-title>
                {{unread.repliedBy}} has replied on {{unread.question}}
            </v-list-tile-title>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile @click="read(read)" v-for="read in reads" :key="read.id">
            <v-list-tile-title>
                {{read.repliedBy}} has replied on {{read.question}}
            </v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
</template>

<script>
export default {
  data(){
      return {
          reads : {},
          unreads : {}
      }
  },
    methods:{
        getNotifications(){
            axios.post('/api/notification')
            .then(res => {
                this.reads = res.data.read
                this.unreads = res.data.unread
                })
            .catch((err) => Exception.handle(err.response.data))
        },
        read(notification){
            axios.post('/api/markAsRead',{id:notification.id})
            .then(res => window.location = notification.path)
        }
    },
    created(){
        if(Auth.loggedIn()){
            this.getNotifications()
        }

        Echo.private('App.User.' + Auth.userId())
        .notification((notification) => {
            this.unreads.push(notification);
            Alert.success('You got new notification')
        });
    }
}
</script>

