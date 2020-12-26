<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Edit Question</h2>
                            <router-link :to="{name: 'questions'}" class="btn btn-outline-secondary">Back to all questions</router-link>
                            <!--                            <a href="" class="btn btn-outline-secondary"> Back to all questions</a>-->
                        </div>

                    </div>

                    <div class="card-body">
                        <question-form @updateQuestion="updateQuestion" :isCreate="false"></question-form>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>

<script>
    import QuestionForm from "../components/QuestionForm";
    import EventBus from "../EventBus";
    export default {
        name: "QuestionEditPage",
        components:{QuestionForm },
        // created() {
        //     console.log('edit',this.$route.params)
        // },
        methods:{
            updateQuestion(data){
                axios.put(`/questions/${this.$route.params.id}`, {title: data.title, body:data.body})
                    .then(({data}) => {
                        // console.log(123)
                        if(data.code === 200)
                        {
                            this.$toast.success(data.message, 'Success', { timeOut:3000, position:'topRight'})
                            setTimeout(() => {
                                this.$router.push({name:'questions'})
                            },3000)
                        }
                        else
                        {
                            this.$toast.error(data.message, 'Error', { timeOut:3000, position:'topRight'})
                        }

                    })
                    .catch(({response}) => {
                        EventBus.$emit('error',  response.data.errors)
                        // console.log(response)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
