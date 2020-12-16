<template>
    <div v-if="canAcceptBestAnswer">
        <a href="#" title="Mark this answer as best answer" :class="status" @click.prevent="markBestAnswer">
            <i class="fas fa-check fa-2x"></i></a>
<!--        <form action="{{route('answer.accept', $answer->id)}}" method="post" class="d-none"-->
<!--              id="accept-answer-{{$answer->id}}">-->
<!--            @csrf-->
<!--        </form>-->
    </div>
    <div v-else>
        <a v-if="isBest" href="#" title="This answer is best answer" :class="status">
            <i class="fas fa-check fa-2x"></i></a>
    </div>

</template>

<script>
    import EventBus from './../EventBus'
    export default {
        name: "BestAnswer",
        props: {
           answer: Object,
        },
        data(){
            return{
                id: this.answer.id,
                status: this.answer.status,
                isBest: this.answer.is_best,
            }
        },
        computed:{
            canAcceptBestAnswer()
            {
                // return window.Auth.user.id == this.answer.question.user_id
                return this.authorize('acceptBestAnswer', this.answer)
            }
        },
        created() {
            EventBus.$on('mark-best-answer', id => {
                this.isBest = this.id === id;
                this.status = this.isBest ? 'vote-accepted' : ''
            })
        },
        methods:{
            markBestAnswer()
            {
                axios.post(`/answer/${this.id}/accept`)
                .then(({data}) => {
                    if(data.code == 200)
                    {
                        EventBus.$emit('mark-best-answer', this.id)
                        this.status = data.status
                    }
                    else
                    {
                        this.$toast.error(data.message, 'Error', {timeOut: 5000})
                    }
                })
                .catch($err => {
                    this.$toast.error($err.response.data.message, 'Error', {timeOut: 5000})
                })
            }
        }
    }
</script>

<style scoped>

</style>
