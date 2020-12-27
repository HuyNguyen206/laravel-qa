import MarkDownIt from 'markdown-it'
import destroy from "./destroy";
// import Prism from 'prismjs'
// import AutoSize from "autosize";
import prism from 'markdown-it-prism'
const markdown = new MarkDownIt()
markdown.use(prism)
export default {
    mixins: [destroy],
    data(){
        return {
            editing:false,
            originBody: '',
            markdown : new MarkDownIt()
        }
    },
    methods:{
        renderDataMD(data){
          return markdown.render(data)
        },
        edit()
        {
            this.editing = true;
            console.log(this.body)
            this.originBody = this.body;
            this.setOriginTitle()
        },
        setOriginTitle()
        {

        },
        cancel()
        {
            this.editing = false;
            this.body = this.originBody;
            // console.log(this.$refs.body_html)
            console.log('cancel')
            // Prism.highlightAllUnder(document.getElementById('bodyHtml'))
            this.body_html = this.renderDataMD(this.body)
            this.getOriginTitle()
        },
        getOriginTitle()
        {

        },
        successCase(data){
            this.body_html = this.renderDataMD(this.body)
            // Prism.highlightAllUnder(this.$refs.body_html)
            // this.body_html = data.body_html
            this.editing = false;
            this.$toast.success(data.message, 'Success', { timeOut:5000, position:'topRight'})
        },
    }
}
