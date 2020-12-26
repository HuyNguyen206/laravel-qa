<template>
    <div class="row align-items-center">
        <div class="col">
            <button class="btn btn-outline-secondary" @click="prev" :disabled="links.prev === null">Newer</button>
        </div>
        <!-- 1st column -->

        <div class="col text-center">
            Page {{meta.current_page}} of {{meta.last_page}}
        </div>
        <!-- 2nd column -->

        <div class="col text-right">
            <button class="btn btn-outline-secondary"  @click="next" :disabled="links.next === null">Older</button>
        </div>
        <!-- 3rd column -->
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props:['links', 'meta'],
        methods:{
            switchPage(){
              this.$router.push({
                  name: 'questions',
                  query:{
                      page: this.meta.current_page
                  }
              })
            },
            prev(){
                if(this.links.prev !== null)
                {
                    this.meta.current_page--
                    this.switchPage()
                }

            },
            next(){
                if(this.links.next !== null)
                {
                    this.meta.current_page++
                    this.switchPage()
                }

            },
            // previousPage(){
            //     this.$emit('previousPage')
            // },
            // nextPage(){
            //     this.$emit('nextPage')
            // }
        }
    }
</script>

<style scoped>

</style>
