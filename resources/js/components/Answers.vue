<template>
    <div>
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
                        <answer v-for="(answer, index) in answers" @delete-answer="getDeletedAnswerId(index)" :answer="answer" :key="answer.id" ></answer>
                    </div>
                    <button class="btn btn-outline-secondary d-inline-block mx-auto mb-3" :disabled="!hasMoreAnswer" @click="fetchAnswers">Load more answer</button>
                </div>
            </div>


        </div>
        <answer-input @add-new-answer='addNewAnswer' :question="question"></answer-input>
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
                // console.log(this.question)
                return this.count + " " + (this.count > 1 ? "answers" : "answer")
            }
        },
        data() {
            return {
                answers: [],
                // id: this.question.id,
                url: `/questions/${this.question.id}/answers`,
                hasMoreAnswer: true,
                count: this.question.answers_count,
                tempAnswer:[],
                newAnswerId: []
            }
        },
        created() {
            this.fetchAnswers()
        },
        methods: {
            addNewAnswer(answer)
            {
                this.answers.push(answer)
                this.newAnswerId.push(answer.id)
                this.count++

            },
            getDeletedAnswerId(index){
                console.log('receive answer index', index)
                // this.answers = this.answers.filter(ans => {
                //     return ans.id != id;
                // })
                this.answers.splice(index, 1)
                this.count =  this.answers.length
            },
            fetchAnswers() {
                axios.get(this.url)
                    .then(({data}) => {
                        // console.log(data)
                        this.answers.push(...(data.data.filter(answer => {
                            let index = this.newAnswerId.findIndex(id =>{
                                return answer.id === id
                            })
                            return index === -1
                        })))
                        this.hasMoreAnswer = (data.next_page_url != null && this.answers.length < this.count)
                        this.url = data.next_page_url
                    })
                    .catch(err => {
                        // console.log(123, err)
                        this.$toast.error(err.response.data.message, 'Error', {timeOut: 5000})
                    })
            }
        }
    }
</script>

<style scoped>

</style>
