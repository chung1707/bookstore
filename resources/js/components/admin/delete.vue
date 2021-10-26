<template>
    <div>
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Đã xóa: {{name}}!
        </h5>
        <h5 class="unsuccessful" v-if="error">
            <i class="fas fa-times-octagon">Đã có lỗi sãy ra, Xóa không thành công!</i>
        </h5>
        <form @submit.prevent="show = true" method="post">
            <button class="btn-flat btn-danger btn-sm" type="submit">
                Xóa
            </button>
        </form>
        <div v-show="show"
            class="card card-success card-outline"
            style="    z-index: 9999 !important;
                        position: absolute;
                        text-align: center;
                        z-index: 2;
                        position: fixed;
                        top: 20%;
                        left: 40%;"
        >
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-minus-circle"></i>
                    Cảnh báo
                </h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-danger swalDefaultSuccess" @click="onDelete">
                    Xóa
                </button>
                <button
                    type="button"
                    class="btn btn-success swalDefaultSuccess"
                    @click="show = false"
                >
                    Hủy
                </button>

                <div class="text-muted mt-3" v-if="item.name">
                    Những dữ liệu liên quan đến: {{item.name}}  cũng sẽ bị xóa!
                </div>
                <div class="text-muted mt-3" v-if="item.transaction_id">
                    Những dữ liệu liên quan đến: {{item.transaction_id}}  cũng sẽ bị xóa!
                </div>
                 <div class="text-muted mt-3" v-else>
                    Những dữ liệu liên quan cũng sẽ bị xóa!
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            required: true,
            type: Object
        },
        link: {
            required: true,
            type: String
        },
    },
    data(){
        return {
            show: false,
            success: false,
            error: false,
            name: null,
        }
    },
    methods: {
        onDelete() {
            var formData = new FormData();
            formData.append("_method", "delete");
            this.show = false;
            axios.post(this.link +this.item.id ,formData).then(response => {
                if(response.data.status == 201){
                    this.name = response.data.name;
                    this.success = true;
                    window.location.reload();
                }
                else{
                    this.error = true;
                }
            });
        }
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        },
        error() {
            setTimeout(() => (this.error = false), 2000);
        }
    },
};
</script>

<style scoped>
.success {
    color: green;
    padding: 20px;
    background-color: rgba(0, 255, 0, 0.3);
    text-align: center;
    z-index: 2;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
.unsuccessful {
    color: rgb(228, 155, 152);
    padding: 20px;
    background-color:rgba(255, 34, 34, 0.3);
    text-align: center;
    z-index: 2;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}

</style>
