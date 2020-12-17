<template>
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>
                            Answer
                        </h4>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="media-body">
<!--                            <form action="{{route('questions.answers.store', $question->id)}}" method="post">-->
                                <div class="form-group">
                                    <label for="answer-body">Content</label>
                                    <textarea name="body" v-model="body" id="answer-body" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="button" :disabled="body===''" @click="addAnswer" class="form-control btn btn-outline-primary btn-lg">Submit</button>
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
    export default {
        name: "AnswerInput",
        props:['question'],
        data(){
            return {
                body:'',
            }
        },
        methods:{
            addAnswer(){
                axios.post(`/questions/${this.question.id}/answers`, {body: this.body})
                .then(({data}) => {
                    if(data.code == 200)
                    {
                        this.$emit('add-new-answer', data.answer)
                        this.body = ''
                        this.$toast.success(data.message, 'Success', {timeOut:5000})
                    }
                    else
                    {
                        this.$toast.error(data.message, 'Error', {timeOut:5000})
                    }
                })
                .catch(err => {
                    console.log(err)
                    this.$toast.error(err.response.data.message, 'Error', {timeOut:5000})
                })
            }
        }

    }
</script>

<style scoped>

</style>
