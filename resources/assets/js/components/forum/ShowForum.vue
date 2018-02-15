<template>
  <v-card>
        <v-card-title primary-title>
          <div>
              <div class="headline">
                  <a href="" @click.prevent>{{content.title}}</a>
              </div>
            <span class="grey--text">{{content.askedBy}} Said {{content.created_at}}</span>
          </div>
          <v-spacer></v-spacer>
          <v-btn flat color="success">{{content.replies_count}} Replies</v-btn>
        </v-card-title>  
        <v-card-text v-html="body"></v-card-text>
        <v-card-actions v-if="owns">
            <v-btn icon small @click="edit">
                <v-icon color="orange">edit</v-icon>
            </v-btn>
            <v-btn icon small @click="destroy">
                <v-icon color="red">delete</v-icon>
            </v-btn>
        </v-card-actions>
      </v-card>
</template>

<script>
export default {
    props:['question'],
  data(){
      return {
          content:null
      }
  },
  created(){
      this.content = this.question
  },
  computed:{
      owns(){
          return Auth.owns(this.question.user_id)
      },
      body(){
          return md.render(this.content.body)
      }
  },
  methods:{
      edit(){
          EventBus.$emit('startEditing')
      },
      destroy(){
          axios.delete(`/api/questions/${this.question.slug}`)
          .then( res => Auth.redirect('/forum'))
          .catch(err => Exception.handle(err.response.data))
      }
  }
}
</script>
