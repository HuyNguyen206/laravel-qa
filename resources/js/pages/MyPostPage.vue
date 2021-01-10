<template>
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="card text-center">
                   <div class="card-header">
                       <ul class="nav nav-tabs card-header-tabs">
                           <li class="nav-item">
                               <router-link exact :to="{name: 'post'}" class="nav-link" data-toggle="tab" role="tab">All</router-link>
                           </li>
                           <li class="nav-item">
                               <router-link exact :to="{name: 'post', query:{ type: 'Q'}}" class="nav-link" data-toggle="tab" role="tab">Questions</router-link>
                           </li>
                           <li class="nav-item">
                               <router-link exact :to="{name: 'post', query:{ type: 'A'}}" class="nav-link" data-toggle="tab" role="tab">Answers</router-link>
                           </li>
                       </ul>
                   </div>
                   <div class="card-body" v-cloak>
                       <ul class="list-group list-group-flush" v-if="listItems.length > 0" >
                           <object-item v-for="(item, index) in listItems" :object="item" :key="index"></object-item>
                       </ul>
                       <div v-else class="alert alert-warning">
                           <p>You have no answer and question</p>
                           <p>
                               <router-link class="btn btn-outline-secondary" :to="{name: 'question.create'}"><i class="fas fa-plus-circle" title="Add Question"></i></router-link>
                           </p>
                       </div>
<!--                       <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
<!--                       <a href="#" class="btn btn-primary">Go somewhere</a>-->
                   </div>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
    import ObjectItem from "../components/ObjectItem";
    export default {
        name: "MyPostPage",
        components: { ObjectItem },
        data(){
            return{
                listItems:[]
            }
        },
        created() {
          this.fetch()
        },
        methods:{
            fetch()
            {
                axios.get('/posts', {params: this.$route.query})
                    .then(({data}) => {
                        this.listItems = data;
                    })
                    .catch(err => console.log(err))
            }
        },
        watch:{
            $route:'fetch'
        }
    }
</script>

<style scoped>

</style>
