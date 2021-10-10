<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách sản phẩm chờ nhập kho</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div
                    id="example1_wrapper"
                    class="dataTables_wrapper dt-bootstrap4"
                >
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                id="example1"
                                class="table table-bordered table-striped dataTable dtr-inline"
                                role="grid"
                                aria-describedby="example1_info"
                            >
                                <thead>
                                    <tr role="row">
                                        <th
                                            class="sorting"
                                            tabindex="0"
                                            aria-controls="example1"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="Rendering engine: activate to sort column ascending"
                                        >
                                            Ảnh
                                        </th>
                                        <th
                                            class="sorting_desc"
                                            tabindex="0"
                                            aria-controls="example1"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="Browser: activate to sort column ascending"
                                            aria-sort="descending"
                                        >
                                            Tên sản phẩm
                                        </th>
                                        <th
                                            class="sorting"
                                            tabindex="0"
                                            aria-controls="example1"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="Platform(s): activate to sort column ascending"
                                        >
                                            Mã sản phẩm
                                        </th>
                                        <th
                                            class="sorting"
                                            tabindex="0"
                                            aria-controls="example1"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="Engine version: activate to sort column ascending"
                                        >
                                            Số lượng
                                        </th>
                                        <th
                                            class="sorting"
                                            tabindex="0"
                                            aria-controls="example1"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="CSS grade: activate to sort column ascending"
                                        >
                                            Giá thành
                                        </th>
                                        <th
                                            class="sorting"
                                            tabindex="0"
                                            aria-controls="example1"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="CSS grade: activate to sort column ascending"
                                        >
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td class="" tabindex="0">Gecko</td>
                                        <td class="sorting_1">Seamonkey 1.1</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                        <td>A</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">
                                            Ảnh
                                        </th>
                                        <th rowspan="1" colspan="1">
                                            Tên sản phẩm
                                        </th>
                                        <th rowspan="1" colspan="1">
                                            Mã sản phẩm
                                        </th>
                                        <th rowspan="1" colspan="1">
                                            Số lượng
                                        </th>
                                        <th rowspan="1" colspan="1">
                                            Giá thành
                                        </th>
                                        <th rowspan="1" colspan="1">
                                            Thao tác
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row justify-content-end">
                                <div class="form-group col-sm-2">
                                    <button
                                        class="btn btn-block btn-primary"
                                        @click.prevent="active = true"
                                    >
                                        Thêm thiết bị
                                    </button>
                                </div>
                                <div
                                    class="form-group col-sm-2"
                                    v-if="this.importBooks.length >= 1"
                                >
                                    <button
                                        class="btn btn-block btn-primary"
                                        @click.prevent="pickSupplier = true"
                                    >
                                        Lập hóa đơn
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thêm thành công
        </h5>
        <div
            class="card card-info"
            style="width: max-content;
                margin: 0px auto;"
        >
            <div class="card-header">
                <h3 class="card-title">Thêm sản phẩm vào hàng chờ nhập</h3>
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
                                    <span class="input-group-text" style="width: 120px"
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
                                    <span class="input-group-text" style="width: 120px"
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
                            rules="required|max:255|quantityValid"
                            name="author"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 120px"
                                        >Tác giả</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="author"
                                    placeholder="Nhập mã sản phẩm"
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
                                    rules="required|max:255|quantityValid"
                                    name="quantity"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 120px"
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
                                    rules="required|max:255"
                                    name="price"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 120px"
                                                >Giá thành</span
                                            >
                                        </div>
                                        <input
                                            type="number"
                                            :min="1"
                                            class="form-control"
                                            name="price"
                                            placeholder="Nhập tên sản phẩm"
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
                            rules="required|max:255"
                            name="description"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 120px"
                                        >Mô tả</span
                                    >
                                </div>
                                <textarea
                                    rows="5"
                                    type="text"
                                    class="form-control"
                                    name="description"
                                    placeholder="Nhập tên sản phẩm"
                                    v-model="book.description"
                                    :class="{
                                        errorInput: error.description
                                    }"
                                ></textarea>
                            </div>
                        </ValidationProvider>
                        <div class="form-group">
                            <categories-select></categories-select>
                        </div>
                        <div class="form-group">
                            <span class="input-group-text"
                                        >Chọn 2 ảnh cho sản phẩm</span
                                    >
                            <dropzone-uploader></dropzone-uploader>
                        </div>
                        <!-- /.row -->
                        <div class="form-group"
                            style="
                            display: flex;
                            justify-content: center;">
                            <div class="form-group col-sm-4">
                                <button
                                    class="btn btn-block btn-danger"
                                    @click.prevent="active = true"
                                >
                                    Huỷ bỏ
                                </button>
                            </div>
                            <div class="form-group col-sm-4">
                                <button
                                    class="btn btn-block btn-primary"

                                >
                                    Thêm thiết bị
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </ValidationObserver>
            <!-- /.card-body -->
        </div>
        <div class="container-fluid px-1 py-5 mx-auto" v-if="pickSupplier">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <div class="card">
                        <ValidationObserver v-slot="{ handleSubmit }">
                            <h5 class="text-center mb-4">Chọn nhà cung cấp</h5>
                            <form
                                class="form-card"
                                @submit.prevent="handleSubmit(onImport)"
                            >
                                <div
                                    class="form-group col-sm-12 flex-column d-flex text-left"
                                >
                                    <ValidationProvider
                                        rules="required"
                                        name="supplier"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                        <div class="form-group">
                                            <label for="role"
                                                >Nhà cung cấp</label
                                            >
                                            <select
                                                class="form-control"
                                                name="supplier_id"
                                                :class="{
                                                    errorInput:
                                                        error.supplier_id
                                                }"
                                                v-model="supplier_id"
                                            >
                                                <option
                                                    v-for="supplier in suppliers"
                                                    :key="supplier.id"
                                                    :value="supplier.id"
                                                >
                                                    {{ supplier.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="form-group col-sm-6">
                                        <button
                                            class="btn btn-block btn-primary"
                                            @click.prevent="
                                                pickSupplier = false
                                            "
                                        >
                                            Hủy
                                        </button>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button
                                            class="btn btn-block btn-primary"
                                        >
                                            Nhập kho
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </ValidationObserver>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(["thumbnails", "importBooks", "totalPrice"])
    },
    data() {
        return {
            book: {
                name: null,
                author: null,
                description: null,
                supplier_id: null,
                category_id: [],
                price: null,
                quantity: null,
                book_code: null
            },
            supplier_id: 1,
            suppliers: {},
            categories: {},
            error: {},
            success: false,
            active: false,
            pickSupplier: false
        };
    },
    methods: {
        ...mapActions(["addBook", "removeBook", "import"]),
        getSuppliers() {
            axios.get("/api/suppliers").then(response => {
                this.suppliers = response.data.suppliers;
            });
        },
        onSubmit() {
            this.book["thumbnails"] = this.thumbnails;
            // this.addBook(this.book);
            // this.book = {
            //     name: null,
            //     description: null,
            //     supplier_id: 1,
            //     category_id: 1,
            //     price: null,
            //     quantity: null
            // };
            // this.success = true;
            // this.active = false;
            console.log(this.book);
        },
        cancel() {
            this.active = false;
        },
        onImport() {
            let equipments_import = [
                this.importBooks,
                this.supplier_id,
                this.totalPrice
            ];
            this.import(equipments_import);
            this.success = true;
            this.pickSupplier = false;
        }
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        }
    },
    mounted() {
        this.getSuppliers();
    }
};
</script>

<style>
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
