<template>
  <div class="mt-2 ml-4 mr-4">
      <markdown-editor v-model="body"></markdown-editor>
      <v-btn color="success" @click.prevent="submit">Reply</v-btn>
  </div>
</template>

<script>
export default {
    props:['question'],
  data(){
      return {
          body:null
      }
  },
  methods:{
      submit(){
          axios.post(`/api/${this.question}/reply`,{body:this.body})
          .then(res => {
              this.body = ''
              EventBus.$emit('gotReply',res.data.reply)
            })
      }
  }
}
</script>

