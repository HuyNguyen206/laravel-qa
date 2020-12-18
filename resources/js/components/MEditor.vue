<template>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" :href='tabId("write", "#")' >Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" :href='tabId("preview", "#")'>Preview</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div :id='tabId("write")' class="tab-pane active" role="tabpanel">
                <slot></slot>
            </div>
            <div :id='tabId("preview")' class="tab-pane"  role="tabpanel" v-html="preview"></div>

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
        props:['body', 'nameIndex'],
        mixins:[modification],
        methods:{
            tabId(tabName, hash='')
            {
                return `${hash}${tabName}${this.nameIndex}`
            }
        },
        computed:{
            preview(){
                return this.renderDataMD(this.body)
            },

            // writeHref()
            // {
            //     return `#write-${this.nameIndex}`
            // },
            // previewHref()
            // {
            //     return `#preview-${this.nameIndex}`
            // },
            // writeId()
            // {
            //     return `write-${this.nameIndex}`
            // },
            // previewId()
            // {
            //     return `preview-${this.nameIndex}`
            // }
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
