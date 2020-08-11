

//import ExampleComponent from "./components/ExampleComponent";
import AdminHome from './components/admin/AdminHome'
import CategoryList from './components/admin/category/List.vue'
import AddCategory from './components/admin/category/New.vue'
import EditCategory from './components/admin/category/Edit.vue'
//post
import PostList from './components/admin/post/List.vue'
import AddPost from './components/admin/post/New.vue'
import EditPost from './components/admin/post/Edit.vue'




//FRONT END ROUTE
import PublicHome from './components/public/publicHome'
import BlogPost from './components/public/blog/BlogPost'
import SinglePost from "./components/public/blog/SingleBlog";



export const routes = [
    {
        path: '/home',
        component: AdminHome
    },

    {
        path: '/category-list',
        component: CategoryList
    },
    {
        path:'/add-category',
        component:AddCategory
    },
    {
        path:'/edit-category/:categoryid',
        component:EditCategory
    },

    //Post
    {
        path: '/post-list',
        component: PostList
    },
    {
        path:'/add-post',
        component:AddPost
    },
    {
        path:'/edit-post/:postid',
        component:EditPost
    },



    //FRONT END ROUTE
    {
        path:'/',
        component:PublicHome
    },

    {
        path:'/blog',
        component:BlogPost
    },

    {
        path:'/blog/:id',
        component:SinglePost
    },

    {
        path:'/categories/:id',
        component:BlogPost
    },



]


