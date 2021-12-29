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
                                    <router-link :to="{ name: 'category.create' }" tag="button"
                                                 class="btn btn-sm btn-primary heading-btn"><span>New</span>
                                    </router-link>
                                    <a class="btn btn-sm btn-primary heading-btn disabled" href="/campaigns/new"><span>Edit</span></a>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><input type='checkbox' @click='checkAll()' v-model='isCheckAll'></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <!--                                        <th>Action</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="cat in listCategory" @mouseover="mouseOver(cat.id)"
                                        @mouseleave="mouseLeave()">
                                        <td><input type="checkbox" v-bind:value="cat.id" v-model="checkedCateIds"
                                                   v-on:change="selectCheckboxId()"></td>
                                        <td>{{ cat.id }}</td>
                                        <td>
                                            <div class="detail-name position-relative">
                                                <div class="name"> {{ cat.title }}</div>
                                                <ul class="position-absolute right-0 top-1"
                                                    v-show="buttonIndex === cat.id">
                                                    <li><a href="#" @click="editCategory(cat)"> <i
                                                        class="fa fa-edit blue"></i></a></li>
                                                    <li><a href="#" @click="deleteCategory(cat.id)"> <i
                                                        class="fa fa-trash red"></i></a></li>
                                                </ul>
                                            </div>

                                        </td>
                                        <td>{{ cat.description }}</td>
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

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
import Pagination from 'laravel-vue-pagination'


export default {

    data() {
        return {
            editMode: false,
            checkedCateIds: [],
            isCheckAll: false,
            active: false,
            buttonIndex: false,
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
    components: {
        Pagination
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
        deleteCategory(id) {
            Swal.fire({
                title: 'Bạn có thực sự muốn xóa?',
                text: "Dữ liệu sẽ không thể khôi phục lại",
                icon: 'warning',
                width: 420,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send request to server
                    this.form.delete('api/category/'+id).then(()=>{
                        Swal.fire({
                            heightAuto: false,
                            width: 300,
                            icon: 'success',
                            title: 'Deleted',
                            showConfirmButton: false,
                            timer: 1000
                            }
                        )
                        this.$emit('completed');
                        // Fire.$emit('AfterCreate');
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });

                }
            })
        },
        updateCategory() {
            this.form.put('/api/category/' + this.form.id)
                .then(data => {
                    if (data.success) {
                        this.$emit('completed');
                        Swal.fire({
                            //   position: 'top-end',
                            heightAuto: false,
                            width: 300,
                            icon: 'success',
                            title: 'Update success',
                            showConfirmButton: false,
                            timer: 1000
                        })

                    }
                }).catch(error => {

            });
        },
        mouseOver: function (id) {
            this.buttonIndex = id
        },
        mouseLeave: function () {
            this.buttonIndex = false
        }
        ,
        checkAll: function () {
            this.isCheckAll = !this.isCheckAll;
            this.checkedCateIds = [];
            if (this.isCheckAll) { // Check all
                for (let key in this.listCategory) {
                    this.checkedCateIds.push(this.listCategory[key].id);
                }
            }
        },
        selectCheckboxId: function () {
            if (this.checkedCateIds.length === this.listCategory.length) {
                this.isCheckAll = true;
            } else {
                this.isCheckAll = false;
            }
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
ul {
    list-style-type: none;
}

.swal-height {
    height: 80px !important;
}

ul li {
    float: left;
    margin: 3px;
}

.position-absolute {
    position: absolute;
}

.position-relative {
    position: relative;
}

.top-1 {
    top: 1px;
}

.right-0 {
    right: 0px;
}

.display {
    display: none;
}

.hidden-action {
    display: none;
}

.position-left {
    margin-right: 7px;
}

.heading-btn {
    margin-right: 4px;
}
</style>
