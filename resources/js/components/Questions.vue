<template>
    <div>
        <div class="card-body" v-cloak>
            <div  v-if="questions.length > 0" >
                <question-item :question="question" v-for="(question, index) in questions" :key="question.id"></question-item>
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
            this.fetchQuestion()
        },
        methods:{
            fetchQuestion()
            {
                axios.get(this.endpoint, {params: this.$route.query})
                    .then(({data}) => {
                        this.questions = data.data
                        this.links = data.links
                        this.meta = data.meta
                        // this.endpoint = data.link.next
                    })
            }
        },
        watch:{
            $route: 'fetchQuestion'
        }
    }

</script>

<style scoped>

</style>
