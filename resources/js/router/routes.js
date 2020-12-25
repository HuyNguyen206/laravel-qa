import QuestionsPage from './../pages/QuestionsPage';
import QuestionPage from './../pages/QuestionPage';
import MyPostPage from './../pages/MyPostPage';
import PageNotFound from "../pages/PageNotFound";
const routes = [
    {
        path:'/questions',
        component:QuestionsPage,
        name:'questions'
    },
    {
        path:'/',
        component:QuestionsPage,
        name:'home'
    },
    {
        path:'/questions/:slug',
        component:QuestionPage,
        name:'question.show'
    },
    {
        path:'/my-post',
        component:MyPostPage,
        name:'post',
        meta:{
            requireAuth:true
        }
    },
    {
        path:'*',
        component:PageNotFound
    }
]
export default routes
