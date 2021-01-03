<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>Question detail</h2>
                        <router-link :to="{ name: 'questions' }" class="btn btn-outline-secondary"> Back to all questions</router-link>
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
                                    <m-editor :body="body" :nameIndex="uniqueName">
                                        <textarea required v-model="body" name="body" id="answer-body" rows="5" class="form-control"></textarea>
                                    </m-editor>
                                </div>

                                <button class="btn btn-outline-primary" type="submit" :disabled="body.length == 0 || title.length === 0">Update</button>
                                <button class="btn btn-outline-primary" type="button" @click="cancel">Cancel</button>
                            </form>
                            <div v-else>
                                <h2>
                                    {{ title }}
                                </h2>
                                <hr>
                                <div v-html="body_html">
                                </div>
                                <div class="d-flex align-items-center">
                                    <button v-if="canUpdate" class="btn" @click="edit" > <i title="Edit question" class="far fa-edit fa-2x"></i></button>
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
    import Modification from './../mixins/modification'
    import Vote from "./Vote";
    import UserInfo from "./UserInfo";
    import Favorite from "./Favorite";
    import MEditor from "./MEditor";

    export default {
        name: "Question",
        props:['question'],
        mixins: [Modification],
        components:{ Vote, UserInfo, Favorite, MEditor },
        data(){
            return {
                originTitle: '',
                body: this.question.body,
                title: this.question.title,
                id: this.question.id,
                originQuestion: {...this.question},
                body_html: this.question.body_html
                // answer_counts: this.question.answers_count
            }
        },
        //Computed function only recalculate with depending data property
        computed:{
            uniqueName()
            {
                return `question-${this.id}`
            },
              canUpdate(){
                  // return this.isSignIn && window.Auth.user.id === this.question.user_id
                  return this.authorize('modify', this.originQuestion)
              },
              canDelete(){
                  // return this.isSignIn && window.Auth.user.id === this.question.user_id &&  this.answer_counts === 0
                  return this.authorize('deleteQuestion', this.originQuestion)
              },
                endpoint(){
                    return `/questions/${this.id}`
                }
        },
        created() {
            EventBus.$on('sync-answer-count', (count) => {
                this.originQuestion.answers_count = count
            })
        },
        methods:{
            setOriginTitle()
            {
                    this.originTitle = this.title
            },
            getOriginTitle()
            {
                    this.title = this.originTitle
            },
            update(){
                axios.put(this.endpoint, {
                    title: this.title,
                    body:this.body
                })
                    .then(({data}) => {
                        // console.log(data)
                      this.successCase(data)
                    })
                    .catch( err => {
                        // console.log(err.response)
                        console.log(err)
                        this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                        // alert(err.response.data.message)
                        // console.log(data.message)
                    })
            },
            destroySuccess(data){
                this.$toast.success(data.message, 'Success', { timeOut:3000, position:'topRight'})
                setTimeout(() => {
                    window.location.href='/questions'
                },3000)
            },
        },
    }
</script>

<style scoped>

</style>
