<template>
  <div class="mt-2 ml-4 mr-4">
    <v-card >
      <v-card-title primary-title>
        <div class="headline">{{reply.user.name}}</div>
        <div class="ml-4">Said {{reply.created_at}}</div>
        <v-spacer></v-spacer>
        <favorite class="ml-4" :content="reply"></favorite>
      </v-card-title>
      <v-divider></v-divider>

      <edit-reply 
        v-if="editing"
        :content="data"
        ></edit-reply>
      
        <v-card-text v-else v-html="body"></v-card-text>
        
        <v-divider></v-divider>
        <div v-if="!editing">
      <v-card-actions v-if="owns">
        <v-spacer></v-spacer>
        <div>
          <v-btn icon @click="editing = true">
            <v-icon color="orange">edit</v-icon>
          </v-btn>
          <v-btn icon @click="destroy">
            <v-icon color="red">delete</v-icon>
          </v-btn>
        </div>
      </v-card-actions>
      </div>
    </v-card>
    </div>
</template>

<script>
import Favorite from './favorite'
import EditReply from './EditReply'
export default {
  props:['data','index'],
  components:{Favorite,EditReply},
  data(){
    return {
      owns: Auth.owns(this.data.user.id),
      editing:false,
      reply:{}
    }
  },
  created(){
    this.reply = this.data

    EventBus.$on('cancelEditing', () =>{
      this.editing = false
    })
  },
  computed:{
    body(){
      return md.render(this.data.body)
    }
  },
  methods:{
    destroy(){
      EventBus.$emit('deleteReply',{id:this.data.id,index:this.index})
    }
  }
}
</script>
