<template>
  <div>
      <markdown-editor v-model="reply.body"></markdown-editor>
      <v-card-actions>
        <v-spacer></v-spacer>
        <div>
          <v-btn icon @click="cancelEditing">
            <v-icon>cancel</v-icon>
          </v-btn>
          <v-btn icon @click="update">
            <v-icon>save</v-icon>
          </v-btn>
        </div>
      </v-card-actions>
  </div>
</template>

<script>
export default {
  props:['content'],
  date(){
      return {
          reply : null
      }
  },
  created(){
      this.reply = this.content
  },
  methods:{
      cancelEditing(){
          EventBus.$emit('cancelEditing');
      },
      update(){
        axios.put(`/api/reply/${this.reply.id}`,{'body':this.reply.body})
        .then(res => this.cancelEditing())
      }
  }
}
</script>

