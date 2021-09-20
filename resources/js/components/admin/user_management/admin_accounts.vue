<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách tài khoản admin</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>email</th>
                            <th>Trạng thái</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr
                        v-for="admin in admins.data" :key="admin.id"
                        >
                            <td>{{ admin.id }}</td>
                            <td>{{ admin.name }}/td>
                            <td>{{ admin.email }}</td>
                            <td><span class="tag tag-success">Hoạt động</span></td>
                            <td>Xem chi tiết</td>
                            <td>Xóa</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    data(){
        return {

        }
    },
    computed: {
        ...mapGetters(['admins']),
    },
    methods: {
        ...mapActions(['getAdmins']),
    },
    mounted(){
        this.getAdmins();
    },
}
</script>

<style>

</style>
