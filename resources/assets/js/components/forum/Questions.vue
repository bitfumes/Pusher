<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <question 
                v-for="question in questions" 
                :key="question.id"
                :question='question'></question>
            </v-flex>
            <sidebar></sidebar>
        </v-layout>
    </v-container>
</template>

<script>
import question from './question'
import sidebar from './sidebar'
export default {
    data(){
        return{
            questions:{}
        }
    },
    components:{question,sidebar},
    created(){
        axios({
            method:'get',
            url : '/api/questions',
        })
        .then(res => this.questions = res.data.data)
    }
}
</script>

