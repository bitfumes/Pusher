<template>
  <div>
    <Reply 
    v-for="(reply,index) in replies" 
    :key="reply.id" 
    :data="reply"
    :index="index"></Reply>
    
  </div>
</template>

<script>
import Reply from './Reply';


export default {
  props:['content'],
  data(){
    return{
      replies:this.content
    }
  },
  components:{Reply},
  created(){
    EventBus.$on('gotReply',(value)=>{
      this.replies.push(value)
    })
    
    
    EventBus.$on('deleteReply',(value)=>{
      axios.delete(`/api/reply/${value.id}`)
      .then(res => {
        this.replies.splice(value.index,1)
      })
    })

    Echo.private('App.User.' + Auth.userId())
        .notification((notification) => {
            this.replies.push(notification.reply);
            Alert.success('You got new Reply')
        });

    

    this.replies = this.content
  }
}
</script>
