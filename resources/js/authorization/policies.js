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
    }
}
