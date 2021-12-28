<template>
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="btn-group">
                                    <router-link :to="{ name: 'category.create' }" tag="button" class="btn btn-sm btn-primary heading-btn"><span>New</span></router-link>
                                    <a class="btn btn-sm btn-primary heading-btn disabled" href="/campaigns/new"><span>Edit</span></a>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" @click="selectAll()" v-model="allSelected"></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="cat in listCategory">
                                        <td><input type="checkbox"></td>
                                        <td>{{ cat.id }}</td>
                                        <td>{{ cat.title }}</td>
                                        <td>{{ cat.description }}</td>
                                        <td>
                                            <a href="#" @click="editCategory(cat)">
                                                <i class="fa fa-edit blue"></i>
                                            </a>
                                            <a href="#" @click="" class="purple">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="overflow-auto">
                                <b-pagination
                                    v-model="currentPage"
                                    :total-rows="rows"
                                    :per-page="perPage"
                                    first-text="First"
                                    prev-text="Prev"
                                    next-text="Next"
                                    last-text="Last"></b-pagination>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editMode">Create New Product</h5>
                            <h5 class="modal-title" v-show="editMode">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="updateCategory()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.title" type="text" name="title"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input v-model="form.description" type="text" name="title"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                                <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editMode: false,
            form: new Form({
                id: '',
                title: '',
                description: ''
            }),
            selected: [],
            allSelected: false,
            cateIds: [],
            listCategory: {},
            rows: 0,
            perPage: 5,
            currentPage: 1,
        }
    },
    created() {
        this.loadListCategory()
        this.$on('completed', () => {
            $('#addNew').modal('hide');
            this.loadListCategory(this.currentPage)
        });
    },
    methods: {
        loadListCategory(page = 1) {
            console.log(page)
            axios.get('/api/category/list?page=' + page).then(({data}) => (this.listCategory = data.data, this.rows = data.count))
        },
        editCategory(category) {
            this.editMode = true;
            this.form.reset()
            $('#addNew').modal('show');
            this.form.fill(category)
        },
        updateCategory() {
            this.form.put('/api/category/' + this.form.id)
                .then( data => {
                    if (data.success) {
                        this.$emit('completed');
                        this.swal({
                            type: 'success',
                            title: 'Updated',
                            text: data.success
                        })
                    }
                }).catch(error => {

            });
        },
        selectAll: function() {

        },
    },
    watch: {
        currentPage: {
            handler: function (value) {
                this.loadListCategory(value)
            }
        }
    }
}
</script>

<style scoped>
.position-left {
    margin-right: 7px;
}
.heading-btn{
    margin-right: 4px;
}
</style>
