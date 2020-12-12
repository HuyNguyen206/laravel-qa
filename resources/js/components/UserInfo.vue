<template>
    <div class="d-flex flex-column mr-4 float-right">
        <span class="text-muted">  {{ postDate }}</span>
        <div class="answer-info d-flex align-items-center mt-2">
            <a :href="user.url" class="d-inline-block mr-2"> <img :src="user.avatar " alt=""> </a>
            <a :href="user.url "> {{ user.name }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserInfo",
        props:{
            model:Object,
            label: String
        },
        computed:{
            postDate(){
                return this.label + " " + this.model.date_created
            }
        },
        data()
        {
           return {
               user:this.model.user
           }
        }
    }
</script>

<style scoped>

</style>
