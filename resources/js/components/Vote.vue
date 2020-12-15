<template>
    <div class="d-flex flex-column align-items-center">
        <a href="" :title="voteUpTitle" :class="classVoteUp" @click.prevent="voteUp"><i><i class="fas fa-caret-up fa-3x"></i></i></a>
        <!--    @can($canVoteUp, $model)-->
        <!--    <form v-if="canVoteUp" action="" method="post" class="d-none"  :id="vote-up-{$formId}}">-->
        <!--        @csrf-->
        <!--        <input type="hidden" name="vote" value="1">-->
        <!--    </form>-->
        <!--    @endcan-->

        <span class="votes-count">{{voteCount}}</span>

        <a href="" :title="voteDownTitle" :class="classVoteDown" @click.prevent="voteDown"><i class="fas fa-caret-down fa-3x"></i></a>
        <!--    @can($canVoteDown, $model)-->
        <!--    <form action="{{route($lowerModel.'.vote', $model)}}" method="post" class="d-none" id="vote-down-{{$formId}}">-->
        <!--        @csrf-->
        <!--        <input type="hidden" name="vote" value="-1">-->
        <!--    </form>-->
        <!--    @endcan-->
    </div>
</template>

<script>
    export default {
        name: "Vote",
        props:{
              voteUpTitle: String,
              model: Object,
              voteDownTitle: String,
              lowerModel:String,
              upperModel: String,
              type: String,
        },
        data(){
            return {
                formId: `${this.lowerModel}-${this.model.id}`,
                // canVoteUp: "voteUp".this.upperModel;
                // canVoteDown: "voteDown".this.upperModel;
                canVoteUp: this.authorize('canVoteUp',this.model),
                canVoteDown:  this.authorize('canVoteDown', this.model),
                voteCount: this.model.hasOwnProperty('votes') ? this.model.votes : this.model.votes_count,
                voteUpStatus:this.model.vote_up_status,
                voteDownStatus:this.model.vote_down_status
            }
        },
        computed:{
            classVoteUp(){
                return ['vote-up', this.voteUpStatus]
            },
            classVoteDown(){
                return ['vote-down', this.voteDownStatus]
            },
            endpoint()
            {
                return  `/${this.type}/${this.model.id}/vote`
            }
        },
        methods:{
            _vote(vote)
            {
                axios.post(this.endpoint, { vote })
                    .then(({data}) => {
                        if(data.code == 200)
                        {
                            this.voteUpStatus = data.model.vote_up_status
                            this.canVoteUp = this.authorize('canVoteUp',data.model)
                            this.voteDownStatus = data.model.vote_down_status
                            this.canVoteDown = this.authorize('canVoteDown',data.model)
                            this.voteCount = data.model.hasOwnProperty('votes') ? data.model.votes : data.model.votes_count
                        }
                        else
                        {
                            this.$toast.error(data.message, 'Error', {timeOut: 5000})
                        }
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.message, 'Error', {timeOut: 5000})
                    })

            },
            voteUp(){
                if(this.canVoteUp)
                {
                   this._vote(1)
                }
                else
                {
                    this.$toast.warning('Please sign in to vote', 'Warning', {timeOut: 5000})
                }
            },
            voteDown(){
                if(this.canVoteDown)
                {
                    this._vote(-1)
                }
                else
                {
                    this.$toast.warning('Please sign in to vote', 'Warning', {timeOut: 5000})
                }
            }
        }
    }
</script>

<style scoped>

</style>
