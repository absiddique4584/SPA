<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <!-- left column -->
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" @submit.prevent="addnewPost()">
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="postId">Add New Post Title</label>
                                    <input type="text" class="form-control" id="postId" placeholder="Add New Post" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <has-error :form="form" field="title"></has-error>
                                </div>


                                <div class="form-group">
                                    <label for="description">Add New Description</label>
                                    <textarea class="form-control" id="description" placeholder="Add New description"
                                    v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>

                                    <has-error :form="form" field="description"></has-error>
                                </div>

                                <div class="form-group" >
                                    <label>Select Category</label>
                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('cat_id') }" v-model="form.cat_id">
                                        <option disabled value="">Select One</option>
                                        <option :value="category.id" v-for="category in getallCategory">option {{category.cat_name}}</option>
                                    </select>
                                    <has-error :form="form" field="cat_id"></has-error>
                                </div>

                                <div class="form-group" >
                                    <input @change = "changePhoto($event)" name="photo" type="file" :class="{ 'is-invalid': form.errors.has('photo') }">
                                    <img :src="form.photo" alt="" width="80" height="80">
                                    <has-error :form="form" field="photo"></has-error>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</template>

<script>
export default {
    name: "New",
    data(){
        return{
            form: new Form({
                title:'',
                description:'',
                cat_id:'',
                photo:'',
            })
        }
    },
    mounted(){
        this.$store.dispatch("allCategory")
    },
    computed:{
        getallCategory(){
            return this.$store.getters.getCategory
        }
    },
    methods:{
        changePhoto(event){
            let file = event.target.files[0];

            if(file.size>1048576){
                swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>This File Is Too Much Big</a>'
                })
            }else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }

        },
        addnewPost(){
            this.form.post('/savepost')
                .then(()=>{
                    this.$router.push('/post-list')
                    toast.fire({
                        type: 'success',
                        title: 'Post Added successfully'
                    })
                })
                .catch(()=>{

                })
        }
    }

}
</script>

<style scoped>


</style>
