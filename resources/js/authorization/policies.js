export default {
    modify(user, model)
    {
        if(user == null)
        {
            return false;
        }
        else
        {
            console.log('modify')
            return user.id == model.user_id
        }

    },
    deleteQuestion(user, question)
    {
        if(user == null)
        {
            return false;
        }
        else
        {
            console.log('delete', user.id == question.user_id, question.answers_count === 0)
            console.log('delete', user.id == question.user_id && question.answers_count === 0)

            return user.id == question.user_id && question.answers_count === 0
        }

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
