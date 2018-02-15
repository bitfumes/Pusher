<template>
    <div class="mt-2">
        <div v-if="question">
            <edit-forum v-if="editing" :question='question'></edit-forum>
        
            <show-forum v-else :question='question'></show-forum>
        
            <Replies v-if="replies" :content="replies"></Replies>
            <New-Reply :question="question.slug"></New-Reply>
        </div>
    </div>
</template>

<script>
import Replies from '../Reply/Replies';
import NewReply from '../Reply/NewReply';
import EditForum from './EditForum';
import ShowForum from './ShowForum';
export default {
    components:{Replies,EditForum,ShowForum,NewReply},
  data(){
      return {
          editing : false,
          question:null,
          replies:null,
      }
  },
  created(){
      EventBus.$on('stopEditing',() => {
          this.editing = false
      });
      EventBus.$on('startEditing',() => {
          this.editing = true
      });
      
      EventBus.$on('deleteReply',() => {
          this.question.replies_count--
      });

      EventBus.$on('gotReply',()=>{
        this.question.replies_count++
      })

        this.getContent();
  },
  methods:{
      getContent(){
          axios.get(`/api/questions/${this.$route.params.slug}`)
          .then(res => {
              this.question = res.data
              this.replies = res.data.replies
              this.replyCount = res.data.replyCount
            })
      }
  }
}
</script>
