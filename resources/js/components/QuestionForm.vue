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
            <textarea name="body" v-model="body" id="question-body" rows="5" class="form-control" :class="errorClass('body')" ></textarea>
            <div v-if="errors['body'][0]" class="invalid-feedback">
                {{errors['body'][0]}}
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary btn-lg d-inline-block"> {{buttonText}}</button>
    </form>
</template>

<script>
    export default {
        name: "QuestionForm",
        data(){
            return{
                title:'',
                body:'',
                errors:{
                    body:[],
                    title:[]
                },
                isCreate: true
            }
        },
        computed:{
            buttonText()
            {
                return this.isCreate ? 'Ask this question' : 'Update this question'
            }
        },
        methods:{
            handleSubmit(){
                axios.post('/questions', {title: this.title, body:this.body})
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
                    this.errors = response.data.errors
                    // console.log(response)
                })
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
