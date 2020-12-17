<template>
    <div>
        <question :question="question"></question>
        <answers :question="question"></answers>
    </div>
</template>

<script>
    import Question from "../components/Question";
    import Answer from "../components/Answer";
    import Answers from "../components/Answers";
    export default {
        name: "QuestionPage",
        props:['question'],
        components: { Question, Answer, Answers }
    }
</script>

<style scoped>

</style>
