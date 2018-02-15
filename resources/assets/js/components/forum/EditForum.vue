<template>
<v-card>
    <v-form  @submit.prevent="submit">
        <v-card-title primary-title>
            <v-text-field
            label="Title"
            v-model="form.title"
            required
            ></v-text-field>

        </v-card-title>  
        
        <markdown-editor v-model="form.body"></markdown-editor>
        
        <v-card-actions>
            <v-btn icon small @click="cancel">
                <v-icon color="blue">cancel</v-icon>
            </v-btn>
            <v-btn icon small type="submit">
                <v-icon color="success">save</v-icon>
            </v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
</template>

<script>
export default {
  props: ['question'],
  data(){
      return {
          form: {}
      }
  },
  methods:{
      cancel(){
          EventBus.$emit('stopEditing');
      },
      submit(){
          axios.put(`/api/questions/${this.question.slug}`,this.form)
          .then(res => this.cancel())
      }
  },
  mounted() {
    this.form = this.question;
  }
};
</script>

