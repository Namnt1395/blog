<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>AD TAG</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Performance</th>
                                        <th>Funnel</th>
                                        <th>Advertiser</th>
                                        <th>Paid Imps</th>
                                        <th>Pub Rev ($)</th>
                                        <th>Account Manager</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="adTag in listAdTag.data">
                                        <td>{{ adTag.id }}</td>
                                        <td>{{ adTag.name }}</td>
                                        <td>10</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
                                    last-text="Last"
                                 @page-click="loadListTag()"></b-pagination>
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
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            listAdTag: {},
            rows: 10,
            perPage: 3,
            currentPage: 1,
        }
    },
    created() {
        this.loadListTag()
    },
    methods: {
        demo() {
          console.log("demo")
        },
        loadListTag(page = 1) {
            console.log(page)
            axios.get('api/tag/list?page=' + page).then(({data}) => (this.listAdTag = data.data))
        },

    }
}
</script>

<style scoped>

</style>
