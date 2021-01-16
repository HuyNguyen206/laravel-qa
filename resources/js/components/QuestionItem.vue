<template>
    <div class="media horizon-except-last">
        <div class="question-info d-flex flex-column counters mr-5">
            <div class="votes">
                <b>
                    {{votes}}
                </b>
                {{ votes > 1 ? 'votes' : 'vote' }}
            </div>
            <div class="answer mt-3" :class="status">
                <b>
                    {{answers_count}}
                </b>
                {{ answers_count > 1 ? 'answers' : 'answer' }}
            </div>
            <div class="view mt-2">
                {{ views +  (views > 1 ? ' views' : ' view') }}
            </div>

        </div>

        <div class="question media-body">
            <div class="question-title d-flex align-items-center justify-content-between">
                <h5>
                    <router-link :to="{name: 'question.show', params:{slug} }"> {{title}}</router-link>
                </h5>
                <div class="btn-group">
<!--                    @can('modify',question)-->
                    <router-link v-if="authorize('modify',question)" class="btn btn-outline-info btn-sm d-inline-block" :to="{name: 'question.edit', params:{ 'id' : question.id}}"><i title="Edit question" class="far fa-edit"></i></router-link>
<!--                    <a v-if="authorize('modify',question)" href="" class="btn btn-outline-info btn-sm d-inline-block">  </a>-->
<!--                    @endcan-->
<!--                    @can('delete', $question)-->
                    <form v-if="authorize('deleteQuestion',question)" @submit.prevent="destroy">
                        <button type="submit" class="btn btn-outline-danger d-inline-block btn-sm" ><i title="Delete question" class="fas fa-trash-alt"></i></button>
                    </form>
<!--                    @endcan-->
                </div>

            </div>

            <span>Asked by <b> <a
                :href="user.url">{{ user.name  }}</a></b></span>
            <small class="text-muted">
                {{date_created}}
            </small>
            <div class="mt-4" v-html="body_html">
            </div>
        </div>
    </div>

</template>
<h3></h3>
<script>
    import destroy from '../mixins/destroy';
    import EventBus from "../EventBus";
    export default {
        name: "QuestionItem",
        props:['question'],
        mixins:[destroy],
        data(){
            return{
                votes: this.question.votes,
                status: this.question.status,
                answers_count: this.question.answers_count,
                views: this.question.views,
                id: this.question.id,
                user: this.question.user,
                body_html:this.question.body_html,
                title:this.question.title,
                date_created: this.question.date_created,
                slug:  this.question.slug
            }
        },
        computed:{
          endpoint(){
              return `/questions/${this.id}`
          }
        },
        methods:{
            destroySuccess(data){
                this.$toast.success(data.message, 'Success');
                EventBus.$emit('deleteQuestion', this.id)
            },
            // deleteQuestion(){
            //     axios.delete(`/questions/${this.id}`)
            //     .then(({data}) => {
            //         if(data.data.code === 200)
            //         {
            //
            //         }
            //         else
            //         {
            //             this.$toast.error(data.error, 'Success')
            //         }
            //     })
            //     .catch(({response}) => {
            //         console.log(response)
            //         this.$toast.error(response.data.message, 'Success')
            //     })
            // }
        }
    }
</script>

<style scoped>

</style>
