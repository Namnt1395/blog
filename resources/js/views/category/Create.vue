<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form  @submit.prevent="createCategory()">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="input" class="form-control"
                                       placeholder="Enter name category" v-model="form.title" name="title">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" v-model="form.status">
                                    <option>Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">DeActive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..."
                                          v-model="form.description" name="description"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.col -->
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>

    </div>

</template>

<script>
export default {
    data() {
        return {
            selected: {},
            form: new Form({
                id: '',
                title: '',
                description: '',
                status: '',
            }),
        }
    },
    methods: {
        createCategory() {
            console.log("demo.......",this.form.data())
            this.form.post('/api/category')
                .then(data => {
                    if (data.success) {
                        this.$router.back()
                        // this.$swal({
                        //     type: 'success',
                        //     title: 'Created!',
                        //     text: data.message,
                        //     confirmButtonColor: '#3fb984',
                        // });
                    }
                }).catch(error => {
            });
         //   this.$router.back()
        }
    },
    created() {
        console.log(this.selected)
    }
}
</script>

<style scoped>

</style>
