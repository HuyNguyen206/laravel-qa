<template>
    <div>
        <div v-if="isSignIn" class="d-flex flex-column align-items-center">
            <a href="" title="CLick to mark as favorite question (Click again to undo)"
               :class="['favorite', statusFavorite]" @click.prevent="createOrUpdate"><i class="fas fa-star fa-2x"></i></a>
            <span :class="classes">{{ count }}</span>
            <!--    <form action="/question/{{$question->id}}/favorite" method="post" id="question-{{$question->id}}">-->
            <!--        @csrf-->
            <!--        @if($question->is_favorite)-->
            <!--        @method('delete')-->
            <!--        @endif-->
            <!--    </form>-->
        </div>
        <div v-else class="d-flex flex-column align-items-center">
            <a href="" class="favorite" @click.prevent="$toast.warning('Please sign in to favorite question', 'Warning', {timeOut:5000})"><i class="fas fa-star fa-2x"></i></a>
            <span class="favorite-count">{{ count }}</span>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Favorite",
        props:{
            question: Object,
        },
        computed:{
            classes(){
                return ['favorite-count', this.statusFavorite]
            },
            // isSignIn()
            // {
            //     return window.Auth.isSignIn;
            // }
        },
         data(){
            return {
                count: this.question.favorite_counts,
                statusFavorite: this.question.status_favorite,
                endPoint: `/questions/${this.question.id}/favorite`
            }
         },
        methods:{
            createOrUpdate()
            {

                if(this.statusFavorite =='')
                {
                    this.favorite()
                }
                else
                {
                    this.unFavorite();
                }
            },
            favorite()
            {
                axios.post(this.endPoint)
                .then(({data}) => {
                    if(data.code == 200)
                    {
                        this.statusFavorite = 'on';
                        this.count = data.count
                    }
                    else
                    {
                        this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                    }
                })
                .catch(err => {
                    this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                })
            },
            unFavorite()
            {
                axios.delete(this.endPoint)
                    .then(({data}) => {
                        if(data.code == 200)
                        {
                            this.statusFavorite = ''
                            this.count = data.count
                        }
                        else
                        {
                            this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                        }
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                    })
            }
        }
    }
</script>

<style scoped>

</style>
