<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Questions</h2>
<!--                            @can('create', App\Question::class)-->
                            <a href="" class="btn btn-outline-secondary"><i class="fas fa-plus-circle" title="Add Question"></i></a>
<!--                            @endcan-->
                        </div>

                    </div>

                    <div class="card-body" v-cloak>
                        <div  v-if="questions.length > 0" >
                            <question-item :question="question" v-for="(question, index) in questions" :key="index"></question-item>
                        </div>
                        <div v-else class="alert alert-warning alert-dismissible fade show" role="alert">
                               <strong>Sorry</strong> There are no question available at the moment
                        </div>
<!--                        @include('components._message-feedback')-->
<!--                        @forelse ($questions as $q)-->
<!--                        <x-question :question="$q"></x-question>-->
<!--                        @empty-->
<!--                        <div class="alert alert-warning alert-dismissible fade show" role="alert">-->
<!--                            <strong>Sorry</strong> There are no question available at the moment-->
<!--                        </div>-->
<!--                        @endforelse-->
                    </div>
                </div>
            </div>

<!--            <div class="col-12 text-center">-->
<!--                {!! $questions->links() !!}-->
<!--            </div>-->

        </div>

    </div>
</template>

<script>
    import QuestionItem from "../components/QuestionItem";
    export default {
        name: "QuestionsPage",
        components:{ QuestionItem },
        data()
        {
            return{
                questions: []
            }
        },
        created() {
          this.fetchQuestion()
        },
         methods:{
            fetchQuestion()
            {
                axios.get('/questions')
                    .then(({data}) => {
                        this.questions = data.data
                    })
            }
         }
    }
</script>

<style scoped>

</style>
