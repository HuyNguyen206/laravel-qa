export default {
    data(){
        return {
            editing:false,
            originBody: '',
        }
    },
    methods:{
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
            this.getOriginTitle()
        },
        getOriginTitle()
        {

        },
        successCase(data){
            this.body_html = data.body_html;
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