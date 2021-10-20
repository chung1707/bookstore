<template>
    <div>
        <div class="card">
            <div class="card-header">
                 <h5 class="success" v-if="success">
                    <i class="fas fa-check"></i> Lập hóa đơn thành công
                </h5>
                <h3 class="card-title">
                    Danh sách sản phẩm -- {{ totalBookInAdminCart }} sản phẩm
                </h3>
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
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá thành</th>
                            <th>Giảm giá</th>
                            <th>Tổng tiền</th>
                            <th>Ảnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="book in adminCart" :key="book.id">
                            <td>{{ book.book_code }}</td>
                            <td>{{ book.name }}</td>
                            <td class="quantity-col">
                                <div
                                    class="product-details-quantity"
                                    style="margin-right: 25px;"
                                >
                                    <div class="input-group  input-spinner">
                                        <div class="input-group-prepend">
                                            <button
                                                style="min-width: 32px"
                                                class="btn btn-secondary btn-spinner"
                                                type="button"
                                                @click="reduce(book)"
                                            >
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input
                                            type="number"
                                            style="text-align: center"
                                            class=" quantityInput"
                                            @change="check(book)"
                                            v-model="book.pivot.quantity"
                                            min="1"
                                        />
                                        <div class="input-group-append">
                                            <button
                                                style="min-width: 32px"
                                                class="btn btn-secondary btn-spinner"
                                                type="button"
                                                @click="increasing(book)"
                                            >
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .product-details-quantity -->
                            </td>
                            <td>{{ book.price }}</td>
                            <td>{{ book.discount }} %</td>
                            <td>
                                {{
                                    book.price *
                                        book.pivot.quantity *
                                        ((100 - book.discount) / 100)
                                }}
                            </td>
                            <td v-show="book.thumbnails[0].img">
                                <img
                                    :src="
                                        '/storage/thumbnails/' +
                                            book.thumbnails[0].img
                                    "
                                    class="img-size-50 mr-3 img-circle"
                                />
                            </td>
                            <td>
                                <i
                                    class="fas fa-trash-alt fa-3x"
                                    style="cursor: pointer;"
                                    @click="deleteBookInAdminCart(book)"
                                ></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div  class="row justify-content-end" style="margin-top: 30px;" v-show="adminCartTotalPrice">
                 <div class="form-group col-sm-6 text-right" style="margin-right: 50px; color: red;">
                    <h4>Tổng giá: {{ adminCartTotalPrice }} VNĐ</h4>
                </div>
            </div>
            <div class="row justify-content-end" style="margin-top: 30px;">
                <div class="form-group col-sm-3">
                    <a
                        class="btn btn-block btn-secondary"
                        href="/admin/book_list"
                    >
                        Hủy
                    </a>
                </div>
                <div class="form-group col-sm-3" v-if="adminCart[0]">
                    <button class="btn btn-block btn-primary" @click="show = true">
                        Xuất sách
                    </button>
                </div>
                <div class="form-group col-sm-3" v-else>
                    <a
                        class="btn btn-block btn-primary"
                        href="/admin/book_list"
                    >
                        Nhập thêm sách
                    </a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="col-md-6 " style="margin: 0px auto;" v-show="show">
            <ValidationObserver v-slot="{ handleSubmit }">
                <form
                    class="form-card"
                    @submit.prevent="handleSubmit(onSubmit)"
                >
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin người mua</h3>
                        </div>
                        <div class="card-body">
                            <!-- Color Picker -->
                            <div class="form-group">
                                <ValidationProvider
                                    rules="max:255|numeric"
                                    name="phone"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <span class="error" v-if="error.phone">{{ error.phone[0] }}</span>
                                    <label>Số điện thoại:</label>

                                    <div
                                        class="input-group my-colorpicker2 colorpicker-element"
                                        data-colorpicker-id="2"
                                    >
                                        <input
                                            type="text"
                                            class="form-control"
                                            data-original-title=""
                                            title=""
                                            v-model="phone"
                                        />

                                        <div class="input-group-append">
                                            <span class="input-group-text"
                                                ><i class="fas fa-phone"></i
                                            ></span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </ValidationProvider>
                            </div>
                            <!-- /.form group -->

                            <!-- time Picker -->

                            <div class="bootstrap-timepicker">
                                <ValidationProvider
                                    rules="required|max:255"
                                    name="name"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div class="form-group">
                                        <span class="error" v-if="error.name">{{ error.name[0] }}</span>
                                        <label>Họ tên:</label>

                                        <div
                                            class="input-group date"
                                            id="timepicker"
                                            data-target-input="nearest"
                                        >
                                            <input
                                                type="text"
                                                class="form-control datetimepicker-input"
                                                data-target="#timepicker"
                                                v-model="name"
                                            />
                                            <div
                                                class="input-group-append"
                                                data-target="#timepicker"
                                                data-toggle="datetimepicker"
                                            >
                                                <div class="input-group-text">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </ValidationProvider>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 d-flex justify-content-lg-between">
                            <button
                                class="btn  btn-secondary"
                                 @click.prevent="show = false"
                            >
                                Hủy
                            </button>
                             <button
                                class="btn btn-primary"
                            >
                                Lập hóa đơn
                            </button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
            </ValidationObserver>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.card -->
</template>
<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            show: false,
            name: null,
            phone: null,
            error: {},
            success: false,
        };
    },
    computed: {
        ...mapGetters([
            "adminCart",
            "adminCartTotalPrice",
        ])
    },
    methods: {
        ...mapActions([
            "getAdminCart",
            "deleteBookInAdminCart",
            "updateQtyAdminCart",
            "clearCart"
        ]),
        increasing(book) {
            if (book.pivot.quantity < book.quantity) {
                book.pivot.quantity++;
                this.updateQtyAdminCart(book);
            }
        },
        reduce(book) {
            if (1 < book.pivot.quantity) {
                book.pivot.quantity--;
                this.updateQtyAdminCart(book);
            }
        },
        check(book) {
            if (book.pivot.quantity > book.quantity) {
                book.pivot.quantity = book.quantity;
            }
            if (book.pivot.quantity < 1) {
                book.pivot.quantity = 1;
            }
            this.updateQtyAdminCart(book);
        },
        onSubmit() {
            let bill = {};
            bill.books = this.adminCart;
            bill.totalPrice = this.adminCartTotalPrice;
            bill.discount_code_id = null;
            axios.post('/admin/export_bill',{'bill': bill, 'name': this.name, 'phone': this.phone}).then((response) => {
                if(response.data.status == 201){
                    this.clearCart();
                    this.success = true;
                    this.error = {};
                    window.location.href = "/admin/export_bill/history/" + response.data.bill_id;
                }
            }).catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
            });
        }
    },
    mounted() {
        this.getAdminCart();
    },
    watch: {
        reload() {
            setTimeout(() => (this.reload = false), 1000);
        },
        success(){
            setTimeout(() => (this.success = false), 1000);
        },

    }
};
</script>

<style scoped>
.cart_icon {
    position: relative;
}
.cart_content {
    position: absolute;
    right: 14px !important;
}

.contentCart {
    justify-content: space-around !important;
}
.quantityInput::-webkit-outer-spin-button,
.quantityInput::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.CartItem {
    width: 780px;
}
.successLoad {
    color: green;
    background-color: rgba(0, 255, 0, 0.3);
    text-align: center;
    z-index: 2;
    padding: 10px 20px;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
</style>
