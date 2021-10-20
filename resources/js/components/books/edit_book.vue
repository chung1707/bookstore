<template>
    <div class="container-fluid">
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Sửa thành công
        </h5>
        <div
            class="card card-info"
            style="width: max-content;
                margin: 0px auto;"
        >
            <div class="card-header">
                <h3 class="card-title">Sửa thông tin sản phẩm</h3>
            </div>
            <ValidationObserver v-slot="{ handleSubmit }">
                <form
                    class="form-card"
                    @submit.prevent="handleSubmit(onSubmit)"
                >
                    <div class="card-body">
                        <ValidationProvider
                            rules="required|max:255"
                            name="name"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        style="width: 120px"
                                        >Tên sản phẩm</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Nhập tên sản phẩm"
                                    v-model="book.name"
                                    :class="{
                                        errorInput: error.name
                                    }"
                                />
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            rules="required|max:255|min:7"
                            name="book_code"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        style="width: 120px"
                                        >Mã sản phẩm</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Nhập mã sản phẩm"
                                    v-model="book.book_code"
                                    :class="{
                                        errorInput: error.book_code
                                    }"
                                />
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            rules="required|max:255"
                            name="author"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        style="width: 120px"
                                        >Tác giả</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="author"
                                    placeholder="Tác giả"
                                    v-model="book.author"
                                    :class="{
                                        errorInput: error.author
                                    }"
                                />
                            </div>
                        </ValidationProvider>
                        <div class="row">
                            <div class="col-lg-6">
                                <ValidationProvider
                                    rules="required|numeric|quantityValid"
                                    name="quantity"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text"
                                                style="width: 120px"
                                                >Số lượng</span
                                            >
                                        </div>
                                        <input
                                            type="number"
                                            :min="1"
                                            class="form-control"
                                            name="quantity"
                                            placeholder="Số lượng"
                                            v-model="book.quantity"
                                            :class="{
                                                errorInput: error.quantity
                                            }"
                                        />
                                    </div>
                                </ValidationProvider>
                            </div>
                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <ValidationProvider
                                    rules="required|numeric|quantityValid"
                                    name="price"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text"
                                                style="width: 120px"
                                                >Giá thành</span
                                            >
                                        </div>
                                        <input
                                            type="number"
                                            :min="1"
                                            class="form-control"
                                            name="price"
                                            placeholder="Giá thành"
                                            v-model="book.price"
                                            :class="{
                                                errorInput: error.price
                                            }"
                                        />
                                    </div>
                                </ValidationProvider>
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>
                        <ValidationProvider
                            rules="required"
                            name="description"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        style="width: 120px"
                                        >Mô tả</span
                                    >
                                </div>
                                <textarea
                                    rows="5"
                                    type="text"
                                    class="form-control"
                                    name="description"
                                    placeholder="Mô tả về sản phẩm"
                                    v-model="book.description"
                                    :class="{
                                        errorInput: error.description
                                    }"
                                ></textarea>
                            </div>
                        </ValidationProvider>
                        <div class="input-group mb-3">
                             <span
                                class="input-group-text"
                                style="width: 120px"
                                >Thể loại hiện tại </span
                            >
                            <span class="categoryList ">
                                <span class="categoryItem"
                                v-for="(category) in book.categories" :key="category.id">
                                    {{ category.name }}
                                </span>
                            </span>
                        </div>

                        <div class="form-group">
                            <input
                                type="hidden"
                                v-model="category_ids"
                                name="category_ids"
                            />
                            <categories-select></categories-select>
                        </div>

                        <div
                            class="form-group justify-content-between "
                        > <label class="form-control-label px-3"
                                        >Ảnh của thiết bị</label
                                    >
                            <img
                            v-for="thumbnail in book.thumbnails" :key="thumbnail.id"
                                class="img-fluid"
                                style="width: 200px;"
                                :src="'/storage/thumbnails/' + thumbnail.img"
                                alt="Ảnh sản phẩm"
                            />
                        </div>
                        <div class="form-group">
                            <span class="input-group-text"
                                >Chọn 2 ảnh (Thay thế nếu cần) cho sản phẩm</span
                            >
                            <dropzone-uploader></dropzone-uploader>
                        </div>
                        <!-- /.row -->
                        <div
                            class="form-group"
                            style="
                            display: flex;
                            justify-content: center;"
                        >
                            <div class="form-group col-sm-4">
                                <button class="btn btn-block btn-primary">
                                    Sửa thông tin
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </ValidationObserver>
            <!-- /.card-body -->
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    props: {
        book: {
            required: true,
            type: Object
        },
    },
    computed: {
        ...mapGetters([
            "thumbnails",
            "importBooks",
            "category_ids",
        ])
    },
    data() {
        return {
            suppliers: {},
            categories: {},
            error: {},
            success: false,
            active: false,
            pickSupplier: false
        };
    },
    methods: {
        ...mapActions(['setCategory_ids,setThumbnails']),
        onSubmit() {
            this.book["newThumbnails"] = this.thumbnails;
            this.book["category_ids"] = this.category_ids;
            var formData = new FormData();
            formData.append("_method", "put");
            formData.append("newThumbnails", this.thumbnails);
            formData.append("category_ids", this.category_ids);
            formData.append("name", this.book.name);
            formData.append("author", this.book.author);
            formData.append("book_code", this.book.book_code);
            formData.append("description", this.book.description);
            formData.append("quantity", this.book.quantity);
            formData.append("price", this.book.price);
            axios.post("/admin/book/" + this.book.id,formData).then(response => {
                console.log(response.data);
            }),
            this.success = true;
            this.active = false;
        },
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        }
    },
    mounted(){
    },
};
</script>

<style>
.categoryList {
    margin: 10px 0px;
}
.categoryItem{
    background-color: #dedede;;
    border-radius: 10px;
    color: black;
    padding: 8px;
    margin-left: 15px;
}
.error {
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
.inputErrors {
    color: red;
    display: block;
}
</style>
