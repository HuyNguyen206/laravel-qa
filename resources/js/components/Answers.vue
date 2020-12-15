<template>
    <div class="row justify-content-center mt-2" v-cloak>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>
                            {{title}}
                        </h4>
                    </div>
                    <hr>
                    <answer v-for="answer in question.answers" :answer="answer" :key="answer.id" ></answer>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
    import Answer from './Answer';
    export default {
        name: "Answers",
        props:['question'],
        components:{ Answer },
        computed:{
            title()
            {
                console.log(this.question)
                return this.question.answers_count + " " + (this.question.answers_count > 1 ? "answers" : "answer")
            }
        }
    }
</script>

<style scoped>

</style>
