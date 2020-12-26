<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Questions</h2>
<!--                            @can('create', App\Question::class)-->
                            <router-link class="btn btn-outline-secondary" :to="{name: 'question.create'}"><i class="fas fa-plus-circle" title="Add Question"></i></router-link>
<!--                            <a href="" class="btn btn-outline-secondary"><i class="fas fa-plus-circle" title="Add Question"></i></a>-->
<!--                            @endcan-->
                        </div>

                    </div>
                <questions></questions>
                </div>
            </div>

<!--            <div class="col-12 text-center">-->
<!--                {!! $questions->links() !!}-->
<!--            </div>-->

        </div>

    </div>
</template>

<script>
    // import Question from "../components/Question";
    import Questions from "../components/Questions";
    export default {
        name: "QuestionsPage",
        components:{ Questions },
    }
</script>

<style scoped>

</style>
