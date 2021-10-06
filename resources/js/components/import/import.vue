<template>
    <div class="container-fluid">
        <div class="card-body">
            <div class="table-responsive">
                <div
                    id="dataTable_wrapper"
                    class="dataTables_wrapper dt-bootstrap4"
                >
                    <h3>Nhập thiết bị</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                class="table table-bordered dataTable"
                                id="dataTable"
                                width="100%"
                                cellspacing="0"
                                role="grid"
                                aria-describedby="dataTable_info"
                                style="width: 100%;"
                            >
                                <thead>
                                    <tr role="row">
                                        <th
                                            class="sorting sorting_asc"
                                            aria-controls="dataTable"
                                            aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending"
                                            style="width: 194px;"
                                        >
                                            Ảnh
                                        </th>
                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: 296px;"
                                        >
                                            Tên thiết bị
                                        </th>
                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            colspan="1"
                                            aria-label="Age: activate to sort column ascending"
                                            style="width: 141x;"
                                        >
                                            Số lượng
                                        </th>
                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            colspan="1"
                                            aria-label="Age: activate to sort column ascending"
                                            style="width: 141px;"
                                        >
                                            Giá trị
                                        </th>

                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 50px;"
                                        >
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(item, index) in equipments"
                                        :key="index"
                                    >
                                        <td class="sorting_1">
                                            <img
                                                style="max-width: 80px;"
                                                :src="
                                                    '/storage/thumbnails/' +
                                                        item.thumbnails[0]
                                                "
                                                alt=""
                                            />
                                        </td>

                                        <td>{{ item.name }}</td>
                                        <td>{{ item.quantity }}</td>
                                        <td>{{ item.price }}</td>
                                        <td class="table__content">
                                            <button
                                                class="btn btn-danger btn-sm"
                                                @click.prevent="
                                                    removeEquipment(item)
                                                "
                                            >
                                                Xóa
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div
                                class="row justify-content-between text-right"
                                v-if="totalPrice !== null"
                            >
                                <h3>{{ totalPrice }} VNĐ</h3>
                            </div>

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
                                    v-if="this.equipments.length >= 1"
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
        </div>

        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thêm thành công
        </h5>

        <div class="container-fluid px-1 py-5 mx-auto" v-if="active">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <div class="card">
                        <ValidationObserver v-slot="{ handleSubmit }">
                            <h5 class="text-center mb-4">Thêm thiết bị nhập</h5>
                            <form
                                class="form-card"
                                @submit.prevent="handleSubmit(onSubmit)"
                            >
                                <div
                                    class="row justify-content-between text-left"
                                >
                                    <ValidationProvider
                                        rules="required|max:255"
                                        name="name"
                                        v-slot="{ errors }"
                                    >
                                        <div
                                            class="form-group col-sm-12 flex-column d-flex"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <label
                                                class="form-control-label px-3"
                                                >Tên thiết bị</label
                                            >
                                            <input
                                                type="text"
                                                id="name"
                                                name="name"
                                                placeholder="Nhập tên thiết bị"
                                                v-model="equipment.name"
                                                :class="{
                                                    errorInput: error.name
                                                }"
                                            />
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div
                                    class="row justify-content-between text-left"
                                >
                                    <ValidationProvider
                                        rules="required|max:255|min:7"
                                        name="device_code"
                                        v-slot="{ errors }"
                                    >
                                        <div
                                            class="form-group col-sm-12 flex-column d-flex"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <label
                                                class="form-control-label px-3"
                                                >Mã thiết bị</label
                                            >
                                            <input
                                                type="text"
                                                id="name"
                                                name="device_code"
                                                placeholder="Nhập mã thiết bị"
                                                v-model="equipment.device_code"
                                                :class="{
                                                    errorInput:
                                                        error.device_code
                                                }"
                                            />
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div
                                    class="row justify-content-between text-left"
                                >
                                    <div
                                        class="form-group col-sm-6 flex-column d-flex"
                                    >
                                        <ValidationProvider
                                            rules="required|quantityValid|numeric"
                                            name="price"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <label
                                                class="form-control-label px-3"
                                                >Giá thành</label
                                            >
                                            <input
                                                type="text"
                                                id="price"
                                                name="price"
                                                placeholder="Nhập giá thành (VNĐ)"
                                                v-model="equipment.price"
                                                :class="{
                                                    errorInput: error.price
                                                }"
                                            />
                                        </ValidationProvider>
                                    </div>

                                    <div
                                        class="form-group col-sm-6 flex-column d-flex"
                                    >
                                        <ValidationProvider
                                            rules="required|numeric|quantityValid:1"
                                            name="quantity"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <label
                                                class="form-control-label px-3"
                                                >Số lượng</label
                                            >
                                            <input
                                                type="number"
                                                id="name"
                                                name="quantity"
                                                placeholder="Nhập số lượng"
                                                v-model="equipment.quantity"
                                                :class="{
                                                    errorInput: error.name
                                                }"
                                            />
                                        </ValidationProvider>
                                    </div>
                                </div>
                                <div
                                    class="form-group col-sm-12 flex-column d-flex text-left"
                                >
                                    <ValidationProvider
                                        rules="required"
                                        name="category"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                        <div class="form-group">
                                            <label for="role"
                                                >Chọn thể loại</label
                                            >
                                            <select
                                                class="form-control"
                                                name="category_id"
                                                v-model="equipment.category_id"
                                                :class="{
                                                    errorInput:
                                                        error.category_id
                                                }"
                                            >
                                                <option
                                                    v-for="category in categories"
                                                    :key="category.id"
                                                    :value="category.id"
                                                    >{{ category.name }}</option
                                                >
                                            </select>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div
                                    class="form-group justify-content-between text-left"
                                >
                                    <ValidationProvider
                                        rules=""
                                        name="description"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                        <div
                                            class="form-group col-sm-12 flex-column d-flex"
                                        >
                                            <label
                                                class="form-control-label px-3"
                                                >Mô tả</label
                                            >
                                            <textarea
                                                rows="5"
                                                cols="20"
                                                type="text"
                                                id="description"
                                                name="description"
                                                v-model="equipment.description"
                                                :class="{
                                                    errorInput:
                                                        error.description
                                                }"
                                            ></textarea>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div
                                    class="form-group justify-content-between text-left"
                                >
                                    <ValidationProvider
                                        rules="image"
                                        name="description"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                        <div
                                            class="form-group col-sm-12 flex-column d-flex"
                                        >
                                            <label
                                                class="form-control-label px-3"
                                                >Tải 1 ảnh thiết bị</label
                                            >
                                            <dropzone-uploader></dropzone-uploader>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div class="row justify-content-end">
                                    <div
                                        class="form-group col-sm-6"
                                        style="margin-top: 5px;"
                                    >
                                        <a
                                            @click.prevent="cancel"
                                            class="btn btn-block btn-primary"
                                            style="line-height: 30px;"
                                            >Hủy</a
                                        >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button
                                            class="btn btn-block btn-primary"
                                        >
                                            Thêm thiết bị
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </ValidationObserver>
                    </div>
                </div>
            </div>
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
        ...mapGetters(["thumbnails", "equipments", "totalPrice"])
    },
    data() {
        return {
            equipment: {
                name: null,
                description: null,
                supplier_id: null,
                category_id: 1,
                price: null,
                quantity: null,
                device_code: null
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
        ...mapActions(["addEquipment", "removeEquipment", "import"]),
        getSuppliers() {
            axios.get("/api/suppliers").then(response => {
                this.suppliers = response.data.suppliers;
            });
        },
        getCategories() {
            axios.get("/api/categories").then(response => {
                this.categories = response.data.categories;
            });
        },
        onSubmit() {
            this.equipment["thumbnails"] = this.thumbnails;
            this.addEquipment(this.equipment);
            this.equipment = {
                name: null,
                description: null,
                supplier_id: 1,
                category_id: 1,
                price: null,
                quantity: null
            };
            this.success = true;
            this.active = false;
        },
        cancel() {
            this.active = false;
        },
        onImport() {
            let equipments_import = [
                this.equipments,
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
        this.getCategories();
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
