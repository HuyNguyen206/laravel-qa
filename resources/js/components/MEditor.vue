<template>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#write">Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#preview">Preview</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div id="write" class="tab-pane active" role="tabpanel">
                <slot></slot>
            </div>
            <div id="preview" class="tab-pane"  role="tabpanel" v-html="preview"></div>

        </div>
    </div>
</template>

<script>
    // import MarkDownIt from 'markdown-it'
    import AutoSize from 'autosize'
    // import prism from 'markdown-it-prism'
    // const markdown = new MarkDownIt()
    // markdown.use(prism)
    import modification from "../mixins/modification";
    export default {
        name: "MEditor",
        props:['body'],
        mixins:[modification],
        computed:{
            preview(){
                return this.renderDataMD(this.body)
            }
        },
        mounted() {
            AutoSize(document.querySelector('textarea'))
        },
        watch:{
            body:function(){
                AutoSize(document.querySelector('textarea'))
                console.log('Watch body')
            }
        }
    }
</script>

<style scoped>

</style>
