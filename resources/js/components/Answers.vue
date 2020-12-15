<template>
    <div class="row justify-content-center mt-2" v-cloak>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>
                            {{title}}
                        </h4>
                    </div>
                    <hr>
                    <answer v-for="answer in answers" :answer="answer" :key="answer.id" ></answer>
                </div>
                <button class="btn btn-outline-secondary d-inline-block mx-auto mb-3" @click="loadMore">Load more answer</button>
            </div>
        </div>


    </div>

</template>

<script>
    import Answer from './Answer';
    export default {
        name: "Answers",
        props: ['question'],
        components: {Answer},
        computed: {
            title() {
                console.log(this.question)
                return this.question.answers_count + " " + (this.question.answers_count > 1 ? "answers" : "answer")
            }
        },
        data() {
            return {
                answers: [],
                // id: this.question.id,
                url: `/questions/${this.question.id}/answers`
            }
        },
        created() {
            this.fetchAnswers()
        },
        methods: {
            loadMore(){

            },
            fetchAnswers() {
                axios.get(this.url)
                    .then(({data}) => {
                        // console.log(data)
                        this.answers = data.data
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.message, 'Error', {timeOut: 5000})
                    })
            }
        }
    }
</script>

<style scoped>

</style>
