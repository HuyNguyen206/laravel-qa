<template>
    <div>
        <div class="card-body" v-cloak>
            <spinner v-if="$root.loading"></spinner>
            <div  v-else-if="questions.length > 0" >
                <question-item :question="question" v-for="(question, index) in questions" :key="question.id" @deleteQuestion="removeQuestion(index)"></question-item>
            </div>
            <div v-else class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Sorry</strong> There are no question available at the moment
            </div>
        </div>
        <div class="card-footer">
            <pagination :links="links" :meta="meta"></pagination>
        </div>
    </div>

</template>

<script>
    import QuestionItem from "./QuestionItem";
    import Pagination from './Pagination.vue';
    import EventBus from "../EventBus";
    export default {
        name: "Questions",
        components:{QuestionItem, Pagination},
        data()
        {
            return{
                questions: [],
                links:{},
                meta:{},
                endpoint:'/questions'
            }
        },
        created() {
            this.fetchQuestion();
            EventBus.$on('deleteQuestion', (id) => {
                let index = this.questions.findIndex((question) => {
                    return question.id === id
                })
                this.questions.splice(index, 1)
            })
        },
        methods:{
            fetchQuestion()
            {
                axios.get(this.endpoint, {params: this.$route.query})
                    .then(({data}) => {
                        this.questions = data.data
                        this.links = data.links
                        this.meta = data.meta
                    })
            },
            removeQuestion(index){
                console.log('huy',this.questions,index)
                this.questions.splice(index, 1)
                console.log(this.questions)
            }
        },
        watch:{
            $route: 'fetchQuestion'
        }
    }

</script>

<style scoped>

</style>
