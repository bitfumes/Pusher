<template>
    <div class="mt-2">
      <v-card>
        <v-card-title primary-title>
          <div>
            <router-link :to='`${question.path}`'>
              <div class="headline">{{question.title}}</div>
            </router-link>
            <span class="grey--text">{{ question.user }} {{question.created_at}}</span>
          </div>
          <v-spacer></v-spacer>
          <v-btn flat color="purple">Read More</v-btn>
        </v-card-title>  
        <v-card-text>
            {{question.body}}
        </v-card-text>
      </v-card>
    </div>
</template>

<script>
export default {
  props:['question'],
  data(){
      return {
          user: Auth.user()
      }
  }
}
</script>
