<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Ask Question</h2>
                            <router-link :to="{name: 'questions'}" class="btn btn-outline-secondary">Back to all questions</router-link>
<!--                            <a href="" class="btn btn-outline-secondary"> Back to all questions</a>-->
                        </div>

                    </div>

                    <div class="card-body">
                        <question-form></question-form>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>

<script>
    import QuestionForm from "../components/QuestionForm";
    export default {
        name: "QuestionCreate",
        components: {QuestionForm}
    }
</script>

<style scoped>

</style>
