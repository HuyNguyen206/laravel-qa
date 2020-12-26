<template>
    <form action="" @submit.prevent="handleSubmit" method="post">
        <!--                            @csrf-->
        <div class="form-group">
            <label for="question-title">Title</label>
            <input type="text" name="title" v-model='title' id="question-title" class="form-control" :class="errorClass('title')" value="">
            <div v-if="errors['title'][0]" class="invalid-feedback">
                {{errors['title'][0]}}
            </div>
<!--            <input type="text" name="title" id="question-title" class="form-control @error('title') is-invalid @enderror" :class="" value="{{old('title')}}">-->
<!--            @error('title')-->

<!--            @enderror-->

        </div>
        <div class="form-group">
            <label for="question-body">Explain your question</label>
            <m-editor :body="body" nameIndex="question">
                <textarea name="body" v-model="body" id="question-body" rows="5" class="form-control" :class="errorClass('body')" ></textarea>
                <div v-if="errors['body'][0]" class="invalid-feedback">
                    {{errors['body'][0]}}
                </div>
            </m-editor>
        </div>
        <button type="submit" class="btn btn-outline-primary btn-lg d-inline-block"> {{buttonText}}</button>
    </form>
</template>

<script>
    import EventBus from "../EventBus";
    import MEditor from "./MEditor";
    export default {
        name: "QuestionForm",
        components:{MEditor},
        props:{
            isCreate:{
                type:Boolean,
                default:true
            }
        },
        data(){
            return{
                errors:{
                    body:[],
                    title:[]
                },
                title: '',
                body: '',
            }
        },
        created() {
            EventBus.$on('error', (errors) => {
                console.log('error',errors )
                this.errors = errors
            })

            if(!this.isCreate)
            {
                this.fetchQuestion()
            }

        },
        computed:{
            buttonText()
            {
                return this.isCreate ? 'Ask this question' : 'Update this question'
            }
        },
        methods:{
            fetchQuestion()
            {
                axios.get(`/questions/${this.$route.params.id}`)
                .then(({data}) => {
                    this.title = data.data.title
                    this.body = data.data.body
                })
            },
            handleSubmit(){
                if(this.isCreate)
                {
                    this.$emit('createQuestion', {title: this.title, body: this.body})
                }
                else
                {
                    this.$emit('updateQuestion', {title:this.title, body: this.body})
                }

            },
            errorClass(data){
                console.log(5,  this.errors[data])
                return {
                    // typeof myVar !== 'undefined'
                    'is-invalid': this.errors[data]  && this.errors[data][0]
                };
            }
        }
    }
</script>

<style scoped>

</style>
