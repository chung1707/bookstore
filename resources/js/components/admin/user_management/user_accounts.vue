<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách tài khoản admin --</h3>
                    <h4 class="card-title">
                        Trang: {{ users.current_page }}/ {{ users.last_page }}
                    </h4>
                    <div class="card-tools">
                        <div
                            class="input-group input-group-sm"
                            style="width: 150px;"
                        >
                            <input
                                type="text"
                                name="table_search"
                                class="form-control float-right"
                                placeholder="Search"
                            />

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
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
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <span class="tag tag-success"
                                        >Hoạt động</span
                                    >
                                </td>
                                <td>Xem chi tiết</td>
                                <td>Xóa</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="card">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item" v-for="(link, index) in links" :key="index">
                                <a class="page-link" href="#">{{ link.label }}</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data() {
        return {
            totalPage: null,
            page: 1
        };
    },
    computed: {
        ...mapGetters(["users",'links'])
    },
    methods: {
        ...mapActions(["getUsers"])
    },
    mounted() {
        this.getUsers(this.page);
    },
    watch: {
        page() {
            this.getUsers(this.page);
        }
    }
};
</script>

<style scoped></style>
