
<script>
    import BestAnswer from './BestAnswer';
    export default {
        name: "answer",
        components:{
            BestAnswer
        },
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
                axios.patch(this.endpoint, {
                    body:this.body
                })
                .then(({data}) => {
                    console.log(data)
                    this.body_html = data.body_html;
                    this.editing = false;
                    this.$toast.success(data.message, 'Success', { timeOut:5000, position:'topRight'})
                })
                .catch( err => {
                    console.log(err.response)
                    this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                    // alert(err.response.data.message)
                    // console.log(data.message)
                })
            },
            destroy()
            {
                this.$toast.question('Are you sure?', 'Delete', {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', (instance, toast) => {
                            axios.delete(this.endpoint)
                                .then(({data}) => {
                                    // console.log(data);
                                    // console.log(this);
                                    //
                                    // console.log(this.$el)
                                    // console.log($(this.$el));
                                    // alert(data.message);
                                    $(this.$el).fadeOut(500, () => {
                                        this.$toast.success(data.message, 'Success', { timeOut:5000, position:'topRight'})
                                    })
                                })
                                .catch(err => {
                                    this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                                })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });



            }
        },
        computed:{
            endpoint(){
                return `/questions/${this.questionId}/answers/${this.id} `
            }
        }
    }
</script>

<style scoped>

</style>
