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
    import MarkDownIt from 'markdown-it'
    const markdown = new MarkDownIt()
    export default {
        name: "MEditor",
        props:['body'],
        computed:{
            preview(){
                console.log(this.body)
                return markdown.render(this.body)
            }
        }
    }
</script>

<style scoped>

</style>
