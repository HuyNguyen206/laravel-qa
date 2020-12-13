

<script>
    export default {
        name: "answer",
        props:{
            answer:Object
        },
        data()
        {
            return{
                editing:false,
                body:this.answer.body,
                body_html:this.answer.body_html,
                questionId: this.answer.question_id,
                id: this.answer.id
            }
        },
        methods:{
            update(){
                axios.patch(`/questions/${this.questionId}/answers/${this.id} `, {
                    body:this.body
                })
                .then(({data}) => {
                    console.log(data)
                    this.body_html = data.body_html;
                    this.editing = false;
                })
                .catch( err => {
                    console.log(err.response)
                    alert(err.response.data.message)
                    // console.log(data.message)
                })
            }
        }
    }
</script>

<style scoped>

</style>
