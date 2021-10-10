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
                                    <tr
                                        role="row"
                                        class="odd"
                                        v-for="book in importBooks"
                                        :key="book.id"
                                    >
                                        <td class="" tabindex="0">
                                            <img
                                                :src="
                                                    '/storage/thumbnails/' +
                                                        book.thumbnails[0]
                                                "
                                                alt="ảnh sản phẩm"
                                                style="max-width: 80px;"
                                            />
                                        </td>

                                        <td class="sorting_1">
                                            {{ book.name }}
                                        </td>
                                        <td>{{ book.book_code }}</td>
                                        <td>{{ book.quantity }}</td>
                                        <td>{{ book.price }}</td>
                                        <td>
                                            <a
                                                class="btn btn-default btn-sm"
                                                @click.prevent="
                                                    removeBook(book)
                                                "
                                                >Xóa</a
                                            >
                                        </td>
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
                            <div>
                                <div class="row justify-content-end"
                                v-if="sumPrice">
                                    <div class="form-group col-sm-6 text-right">
                                        <h3 style="color: red">{{sumPrice}} VNĐ</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="form-group col-sm-2">
                                    <button
                                        class="btn btn-block btn-primary"
                                        @click.prevent="active = true"
                                    >
                                        Thêm sản phẩm
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
            v-if="active"
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
                                    rules="required|max:255|numeric|quantityValid"
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
                                    rules="required|max:255|numeric|quantityValid"
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
                        <ValidationProvider
                            rules="required"
                            name="category_ids"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="form-group">
                                <input
                                    type="hidden"
                                    v-model="category_ids"
                                    name="category_ids"
                                />
                                <categories-select></categories-select>
                            </div>
                        </ValidationProvider>
                        <div class="form-group">
                            <span class="input-group-text"
                                >Chọn 2 ảnh cho sản phẩm</span
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
                                <button
                                    class="btn btn-block btn-danger"
                                    @click.prevent="active = false"
                                >
                                    Huỷ bỏ
                                </button>
                            </div>
                            <div class="form-group col-sm-4">
                                <button class="btn btn-block btn-primary">
                                    Thêm sản phẩm
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </ValidationObserver>
            <!-- /.card-body -->
        </div>
        <div
            v-if="pickSupplier"
            class="card card-info"
            style="width: 500px;
                margin: 0px auto;"
        >
            <div class="card-header">
                <h3 class="card-title">Chọn nhà cung cấp</h3>
            </div>
            <ValidationObserver v-slot="{ handleSubmit }">
                <form
                    class="form-card"
                    @submit.prevent="handleSubmit(onImport)"
                >
                    <div class="card-body">
                        <ValidationProvider
                            name="supplier_id"
                            v-slot="{ errors }"
                        >
                            <span class="inputErrors">{{ errors[0] }}</span>
                            <div class="form-group">
                                <label
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

                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6">
                                <button
                                    class="btn btn-block btn-primary"
                                    @click.prevent="pickSupplier = false"
                                >
                                    Hủy
                                </button>
                            </div>
                            <div class="form-group col-sm-6">
                                <button class="btn btn-block btn-primary">
                                    Nhập kho
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters([
            "thumbnails",
            "importBooks",
            "totalPrice",
            "category_ids",
            "sumPrice"
        ])
    },
    data() {
        return {
            book: {
                name: null,
                author: null,
                description: null,
                supplier_id: null,
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
            this.book["category_ids"] = this.category_ids;
            this.addBook(this.book);
            this.book = {
                name: null,
                author: null,
                description: null,
                supplier_id: null,
                price: null,
                quantity: null,
                book_code: null
            };
            this.success = true;
            this.active = false;
        },
        onImport() {
            let books_import = [
                this.importBooks,
                this.supplier_id,
                this.sumPrice,
            ];
            this.import(books_import);
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
