<template>
    <div>
        <div v-if="isSignIn" class="d-flex flex-column align-items-center">
            <a href="" title="CLick to mark as favorite question (Click again to undo)"
               :class="['favorite', statusFavorite]"><i class="fas fa-star fa-2x"></i></a>
            <span :class="classes">{{ count }}</span>
            <!--    <form action="/question/{{$question->id}}/favorite" method="post" id="question-{{$question->id}}">-->
            <!--        @csrf-->
            <!--        @if($question->is_favorite)-->
            <!--        @method('delete')-->
            <!--        @endif-->
            <!--    </form>-->
        </div>
        <div v-else class="d-flex flex-column align-items-center">
            <a href="" style="pointer-events: none" class="favorite"><i class="fas fa-star fa-2x"></i></a>
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
            }
        },
         data(){
            return {
                count: this.question.favorite_counts,
                statusFavorite: this.question.status_favorite,
                isSignIn: true
            }
         }
    }
</script>

<style scoped>

</style>
