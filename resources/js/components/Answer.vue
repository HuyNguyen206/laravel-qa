<template>
    <div class="media horizon-except-last">
        <div class="vote-info d-flex flex-column align-items-center mr-4">
            <vote type="answer" vote-up-title="This answer is useful" vote-down-title="This answer is not useful" lower-model="answer" upper-model="Answer" :model="answer"></vote>
            <best-answer :answer="answer"></best-answer>
        </div>
        <div class="media-body">
            <form action="" v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <label for="answer-body">Content</label>
                    <textarea required v-model="body" name="body" id="answer-body" rows="5" class="form-control"></textarea>
                </div>

                <button class="btn btn-outline-primary" type="submit" :disabled="body.length == 0">Update</button>
                <button class="btn btn-outline-primary" type="button" @click="editing = false">Cancel</button>
            </form>
            <div v-else>
                <div v-html="body_html"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex align-items-center">
                            <button v-if="authorize('modify', answer)" class="btn" @click="editing = true, body = body_html" > <i title="Edit question" class="far fa-edit fa-2x"></i></button>
                            <button v-if="authorize('modify', answer)" class="btn delete-answer-button" @click="destroy()">
                                <i class="fas fa-trash-alt fa-2x"></i>
                            </button>
                        </div>

                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="answer" label="Answered by"></user-info>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>
<script>
    import BestAnswer from './BestAnswer';
    export default {
        name: "answer",
        components:{
            BestAnswer
        },
        props:{
            answer:Object
        },
        data()
        {
            return{
                editing:false,
                body:this.answer.body,
                body_html:this.answer.body_html,
                questionId: this.answer.question_id,
                id: this.answer.id
            }
        },
        methods:{
            update(){
                axios.patch(this.endpoint, {
                    body:this.body
                })
                .then(({data}) => {
                    // console.log(data)
                    this.body_html = data.body_html;
                    this.editing = false;
                    this.$toast.success(data.message, 'Success', { timeOut:5000, position:'topRight'})
                })
                .catch( err => {
                    // console.log(err.response)
                    this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                    // alert(err.response.data.message)
                    // console.log(data.message)
                })
            },
            destroy()
            {
                this.$toast.question('Are you sure?', 'Delete', {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', (instance, toast) => {
                            axios.delete(this.endpoint)
                                .then(({data}) => {
                                    // console.log(data);
                                    // console.log(this);
                                    //
                                    // console.log(this.$el)
                                    // console.log($(this.$el));
                                    // alert(data.message);

                                    // $(this.$el).fadeOut(500, () => {
                                    //     this.$toast.success(data.message, 'Success', { timeOut:5000, position:'topRight'})
                                    // })
                                    this.$emit('delete-answer')
                                })
                                .catch(err => {
                                    this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                                })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });



            }
        },
        computed:{
            endpoint(){
                return `/questions/${this.questionId}/answers/${this.id} `
            }
        }
    }
</script>

<style scoped>

</style>
