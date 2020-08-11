export default {
    state:{
        category:[],
        post:[],
        blogpost:[],
        singlepost:[],
        allcategories:[],
        latestpost:[],
    },
    getters:{
        getCategory(state){
            return state.category
        },
        getallPost(state){
            return state.post
        },
        getblogPost(state){
            return state.blogpost
        },
        singlepost(state){
            return state.singlepost
        },
        allcategories(state){
            return state.allcategories
        },
        latestpost(state){
            return state.latestpost
        }
    },
    actions:{
        allCategory(context){
            axios.get("/category")
                .then((response)=>{
                    //console.log(response.data.categories)
                    context.commit('categories',response.data.categories)
                })
        },
        gelAllPost(context){
            axios.get('/post')
                .then((response)=>{
                    context.commit('allPost',response.data.posts)
                })
        },
        getblogPost(context){
            axios.get('/blogpost')
                .then((response)=>{
                    context.commit('findBlogpost',response.data.posts)
                })
        },
        getPostById(context,payload){
            axios.get('/singlepost/'+payload)
                .then((response)=>{
                    context.commit('singlePost',response.data.post)
                })
        },
        allcategories(context){
            axios.get('/categories')
                .then((response)=>{
                    context.commit('allCategories',response.data.categories)
                })
        },
        latestPost(context){
            axios.get('/latestpost')
                .then((response)=>{
                    context.commit('latestpost',response.data.posts)
                })
        },
        getPostByCatId(context,payload){
            axios.get('/categorypost/'+payload)
                .then((response)=>{
                    console.log(response.data.posts)
                    context.commit('getPostByCat',response.data.posts)
                })
        },
        SearchPost(context,payload){
            axios.get('/search?s='+payload)
                .then((response)=>{
                    //console.log(response.data.posts)
                    context.commit('getSearchPost',response.data.posts)
                })
        }
    },
    mutations:{
        categories(state,data){
            return state.category = data
        },
        allPost(state,payload){
            return state.post = payload
        },
        findBlogpost(state,payload){
            return state.blogpost = payload
        },
        singlePost(state,payload){
            return state.singlepost = payload
        },
        allCategories(state,payload){
            return state.allcategories = payload
        },
        latestpost(state,payload){
            return state.latestpost = payload
        },
        getPostByCat(state,payload){
            return state.blogpost = payload
        },
        getSearchPost(state,payload){
            return state.blogpost = payload
        },

    }
}
