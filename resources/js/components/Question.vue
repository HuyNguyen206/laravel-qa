<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>Question detail</h2>
                        <a href="/questions" class="btn btn-outline-secondary"> Back to all questions</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="media">
                        <div class="vote-info d-flex flex-column align-items-center mr-4">
                            <vote type="question" vote-up-title="This question is useful" vote-down-title="This question is not useful" lower-model="question" upper-model="Question" :model="question"></vote>
                            <favorite :question="question"></favorite>
                        </div>
                        <div class="media-body">
                            <form v-if="editing"  action="" @submit.prevent="update">
                                <div class="form-group">
                                    <label for="answer-body">Title</label>
                                    <input type="text" class="form-control" v-model="title">
                                </div>
                                <div class="form-group">
                                    <label for="answer-body">Content</label>
                                    <textarea required v-model="body" name="body" id="answer-body" rows="5" class="form-control"></textarea>
                                </div>

                                <button class="btn btn-outline-primary" type="submit" :disabled="body.length == 0 || title.length === 0">Update</button>
                                <button class="btn btn-outline-primary" type="button" @click="editing = false, body = originBody, title = originTitle">Cancel</button>
                            </form>
                            <div v-else>
                                <h2>
                                    {{ title }}
                                </h2>
                                <hr>
                                <div v-html="body_html">
                                </div>
                                <div class="d-flex align-items-center">
                                    <button v-if="canUpdate" class="btn" @click="editing = true, originBody = body, originTitle = title" > <i title="Edit question" class="far fa-edit fa-2x"></i></button>
                                    <button v-if="canDelete" class="btn delete-answer-button" @click="destroy()">
                                        <i class="fas fa-trash-alt fa-2x"></i>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                    <user-info :model="question" label="Asked by"></user-info>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from "../EventBus";
    import Vote from "./Vote";
    import UserInfo from "./UserInfo";
    import Favorite from "./Favorite";
    export default {
        name: "Question",
        props:['question'],
        components:{ Vote, UserInfo, Favorite },
        data(){
            return {
                editing:false,
                originBody: '',
                originTitle: '',
                body: this.question.body,
                body_html:this.question.body_html,
                title: this.question.title,
                endpoint: `/questions/${this.question.id}`,
                originQuestion: {...this.question},
                // answer_counts: this.question.answers_count
            }
        },
        //Computed function only recalculate with depending data property
        computed:{
              canUpdate(){
                  // return this.isSignIn && window.Auth.user.id === this.question.user_id
                  return this.authorize('modify', this.originQuestion)
              },
              canDelete(){
                  // return this.isSignIn && window.Auth.user.id === this.question.user_id &&  this.answer_counts === 0
                  return this.authorize('deleteQuestion', this.originQuestion)
              }
        },
        created() {
            EventBus.$on('sync-answer-count', (count) => {
                this.originQuestion.answers_count = count
            })
        },
        methods:{
            update(){
                axios.put(this.endpoint, {
                    title: this.title,
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
                                    if(data.code == 200)
                                    {
                                        this.$toast.success(data.message, 'Success', { timeOut:3000, position:'topRight'})
                                        setTimeout(() => {
                                            window.location.href='/questions'
                                        },3000)
                                    }
                                    else
                                    {
                                        this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                                    }
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
    }
</script>

<style scoped>

</style>
