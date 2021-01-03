<template>
    <div class="container">
        <question :question="question" v-if="question.id"></question>
        <answers :question="question" v-if="question.id"></answers>
    </div>
</template>

<script>
    import Question from "../components/Question";
    import Answer from "../components/Answer";
    import Answers from "../components/Answers";
    export default {
        name: "QuestionPage",
        props:['slug'],
        data(){
            return{
                question:{}
            }
        },
        components: { Question, Answer, Answers },
        created() {
            axios.get(`/questions/${this.slug}`)
            .then(({data}) => {
                this.question = data.data
            })
        }
    }
</script>

<style scoped>

</style>
