import QuestionsPage from './../pages/QuestionsPage';
import QuestionPage from './../pages/QuestionPage';
import MyPostPage from './../pages/MyPostPage';
import PageNotFound from "../pages/PageNotFound";
import QuestionCreatePage from "../pages/QuestionCreatePage";
import QuestionEditPage from "../pages/QuestionEditPage";
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
        name:'question.show',
        props:true
    },
    {
        path:'/question-create',
        component:QuestionCreatePage,
        name:'question.create',
        meta:{
            requireAuth:true
        }
    },
    {
        path:'/question-edit/:id/edit',
        component:QuestionEditPage,
        name:'question.edit',
        meta:{
            requireAuth:true
        }
    },
    {
        path:'/my-post',
        component:MyPostPage,
        name:'post',
        // meta:{
        //     requireAuth:true
        // }
    },
    {
        path:'*',
        component:PageNotFound
    }
]
export default routes
