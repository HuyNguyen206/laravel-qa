import MarkDownIt from 'markdown-it'
// import Prism from 'prismjs'
// import AutoSize from "autosize";
import prism from 'markdown-it-prism'
const markdown = new MarkDownIt()
markdown.use(prism)
export default {
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
        destroySuccess(data = null)
        {

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
                                if(data.code == 200)
                                {
                                    this.destroySuccess(data)
                                }
                                else
                                {
                                    this.$toast.error(err.response.data.message, 'Error', { timeOut:5000, position:'topRight'})
                                }
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
    }
}
