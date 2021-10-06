<template>
    <div class="card">
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Sửa đổi thông tin thành công
        </h5>
        <h5 class="text-center mb-4">Thông tin danh mục</h5>
        <form class="form-card">
            <div class="row justify-content-between text-left">
                <span class="inputErrors" v-if="error.name">{{ error.name[0] }}</span>
                <div class="form-group col-sm-12 flex-column d-flex">
                    <label class="form-control-label px-3">Tên danh mục</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Nhập tên danh mục"
                        v-model="category.name"
                        :class="{ errorInput: error.name }"
                    />
                </div>
            </div>
            <div class="row justify-content-between text-left">
                <span class="inputErrors" v-if="error.description">{{ error.description[0] }}</span>
                <div class="form-group col-sm-12 flex-column d-flex">
                    <label class="form-control-label px-3">Mô tả</label>
                    <textarea
                        rows="5" cols="20"
                        type="text"
                        id="description"
                        name="description"
                        v-model="category.description"
                        :class="{ errorInput: error.description }"
                    ></textarea>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group col-sm-6" style="margin-top: 5px;">
                        <a
                            href="/category"
                            class="btn btn-block btn-primary"
                            style="line-height: 30px;"
                            >Hủy</a
                        >
                    </div>
                    <div class="form-group col-sm-6">
                        <button @click.prevent="updateInfos()" class="btn btn-block btn-primary">
                            Cập nhập
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            error: {},
            success: false
        };
    },

    props: {
        category: {
            type: Object
        },
    },
    methods: {
        updateInfos() {
            var formData = new FormData();
            formData.append("_method", "put");
            formData.append("name", this.category.name);
            formData.append("description", this.category.description);
            axios
                .post("/category/" + this.category.id, formData)
                .then(() => {
                    this.success = true;
                    this.error = {};
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
                });
        }
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        }
    },
};
</script>

<style scoped>
.inputErrors {
    color: red;
    display: block;
}
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
.errorInput {
    border-color: red;
}
</style>
