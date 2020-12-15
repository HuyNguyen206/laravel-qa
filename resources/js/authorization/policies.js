export default {
    modify(user, model)
    {
        if(user == null)
        {
            return false;
        }
        return user.id == model.user_id
    },
    acceptBestAnswer(user, answer)
    {
        if(user == null)
        {
            return false;
        }
        return user.id == answer.question.user_id
    },
    canVoteUp(user, model)
    {
        if(user == null)
        {
            return false;
        }
        return model.vote_up_status != 'on'
    },
    canVoteDown(user, model)
    {
        if(user == null)
        {
            return false;
        }
        return model.vote_down_status != 'on'
    }
}
