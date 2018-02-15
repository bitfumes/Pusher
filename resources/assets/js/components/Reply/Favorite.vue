<template>
  <div>
      <v-btn icon @click="favoriteIt">
        <v-icon :color="color" >favorite</v-icon>{{reply.favorite_count}}
      </v-btn>
  </div>
</template>
<script>
export default {
  props:['content'],
  data(){
    return {
      reply : {},
      favorited : this.content.favorited,
    }
  },
  created(){
    this.reply = this.content
      Echo.channel('Favorited')
          .listen('FavoritedEvent', (e) => {
          if(e.id == this.reply.id){
            e.type == 1 ? this.incre() : this.decre();
          }
        });
  },
  methods:{
      incre(){
          this.reply.favorite_count ++
      },
      decre(){
          this.reply.favorite_count --
      },
      favoriteIt(){
        if(Auth.loggedIn){
          this.favorited ? this.unFavIt() : this.favIt()  
        }
      },
      unFavIt(){
        axios.delete(`/api/reply/${this.reply.id}/favorite`)
        .then(res => {
          this.favorited = !this.favorited
          this.reply.favorite_count --
        })
        .catch((err) => Exception.handle(err.response.data))
      },
      favIt(){
        axios.post(`/api/reply/${this.reply.id}/favorite`)
        .then(res => {
          this.favorited = !this.favorited
          this.reply.favorite_count ++
        })
        .catch((err) => Exception.handle(err.response.data))
      }
  },
  computed:{
    color(){
      return this.favorited ? 'red' :'red lighten-4';
    }
  }
}
</script>
