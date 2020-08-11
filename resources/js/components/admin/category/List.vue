<template>
    <div>
        <section class="content" >
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-10 ">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title ">Category List</h3>
                                <div class="card-tools">
                                    <router-link to="/add-category"><button class="btn btn-primary ">Add Category</button></router-link>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SI NO</th>
                                            <th>Category Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(category,index) in getallCategory" :key='category.id' >
                                            <td>{{index+1}}</td>
                                            <td>{{category.cat_name}}</td>
                                            <td>{{category.created_at|timeFormat}}</td>
                                            <td>
                                                <router-link :to="`/edit-category/${category.id}`">Edit</router-link>
                                                <a href="" @click.prevent="deleteCategory(category.id)">Delete</a>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "List",
        mounted() {
            this.$store.dispatch("allCategory")
        },
        computed:{
            getallCategory(){
                return this.$store.getters.getCategory

            }
        },
        methods:{
            deleteCategory(id){
                //alert(id);
                axios.get('/category/'+id)
                .then(()=>{
                    this.$store.dispatch("allCategory")
                    toast.fire({
                        icon: 'success',
                        title: 'Yah! A Category has been successfully Deleted'
                    })
                })
            }
        }
    }
</script>

<style scoped>


</style>
