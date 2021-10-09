<template>
    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <h5 class="success" v-if="success">
                    <i class="fas fa-check"></i> Đặt hàng thành công
                </h5>
                <h5 class="unsuccessful" v-if="unsuccessful">
                    <i class="fas fa-times-octagon">Đã có lỗi sãy ra, đặt hàng thất bại</i>
                </h5>
                <h5 class="unsuccessful" v-if="notItem">
                    <i class="fas fa-times-octagon">Đã có lỗi sãy ra, đặt hàng thất bại</i>
                </h5>
                <div class="checkout-discount">
                    <input
                        type="text"
                        class="form-control"
                        required=""
                        id="checkout-discount-input"
                        placeholder="Bạn có mã giảm giá? Nhập mã"
                    />
                </div>
                <button class="btn btn-outline-primary-2 ">
                    <span class="">Sử dụng mã</span>
                </button>
                <!-- End .checkout-discount -->
                <ValidationObserver v-slot="{ handleSubmit }">
                    <form action="#" @submit.prevent="handleSubmit(onSubmit)">
                        <div class="row">
                            <div class="col-lg-9">
                                <div style="margin-bottom: 30px;">
                                    <div>
                                        <ValidationProvider
                                            rules="required|max:255|min:9|numeric"
                                            name="phone"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <span
                                                class="error"
                                                v-if="error.phone"
                                                >{{ error.phone[0] }}</span
                                            >
                                            <label>Số điện thoại</label>
                                            <input
                                                :class="{
                                                    errorInput: error.phone
                                                }"
                                                type="text"
                                                class="form-control"
                                                required=""
                                                name="phone"
                                                v-model="authUser.phone"
                                            />
                                        </ValidationProvider>
                                    </div>
                                    <label>Địa chỉ</label>
                                    <div class="form-group row">
                                        <div class="col">
                                            <span
                                                class="error"
                                                v-if="error.province_id"
                                                >{{
                                                    error.province_id[0]
                                                }}</span
                                            >
                                            <select
                                                :class="{
                                                    errorInput:
                                                        error.province_id
                                                }"
                                                class="form-control"
                                                name="province_id"
                                                v-model="province_id"
                                            >
                                                <option value="null"
                                                    >Vui lòng chọn địa
                                                    điểm</option
                                                >
                                                <option
                                                    v-for="province in provinces"
                                                    :key="province.id"
                                                    :value="province.id"
                                                >
                                                    {{ province.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <span
                                                class="error"
                                                v-if="error.district_id"
                                                >{{
                                                    error.district_id[0]
                                                }}</span
                                            >
                                            <select
                                                :class="{
                                                    errorInput:
                                                        error.district_id
                                                }"
                                                class="form-control"
                                                name="district_id"
                                                v-model="district_id"
                                            >
                                                <option value="null"
                                                    >Vui lòng chọn địa
                                                    điểm</option
                                                >
                                                <option
                                                    v-for="district in districts"
                                                    :key="district.id"
                                                    :value="district.id"
                                                >
                                                    {{ district.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <span
                                                class="error"
                                                v-if="error.ward_id"
                                                >{{ error.ward_id[0] }}</span
                                            >
                                            <select
                                                class="form-control"
                                                name="ward_id"
                                                v-model="ward_id"
                                                :class="{
                                                    errorInput: error.ward_id
                                                }"
                                            >
                                                <option value="null"
                                                    >Vui lòng chọn địa
                                                    điểm</option
                                                >
                                                <option
                                                    v-for="ward in wards"
                                                    :key="ward.id"
                                                    :value="ward.id"
                                                >
                                                    {{ ward.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <ValidationProvider
                                            rules="required|max:255"
                                            name="address"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <span
                                                class="error"
                                                v-if="error.address"
                                                >{{ error.address[0] }}</span
                                            >
                                            <label
                                                >Địa chỉ nhận hàng chi
                                                tiết</label
                                            >
                                            <input
                                                :class="{
                                                    errorInput: error.address
                                                }"
                                                type="text"
                                                class="form-control"
                                                required=""
                                                name="address"
                                                v-model="authUser.address"
                                            />
                                        </ValidationProvider>
                                    </div>
                                </div>
                                <textarea
                                    v-model="note"
                                    class="form-control"
                                    cols="30"
                                    rows="4"
                                    placeholder="Những điều cần lưu ý cho đơn hàng của bạn"
                                ></textarea>
                            </div>
                            <!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3>
                                    <!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm chọn mua</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr
                                                v-for="book in books"
                                                :key="book.id"
                                            >
                                                <td>
                                                    <a href="#"
                                                        >{{ book.name }} -SL:
                                                        {{
                                                            book.pivot.quantity
                                                        }}</a
                                                    >
                                                </td>
                                                <td>
                                                    {{
                                                        book.price *
                                                            book.pivot
                                                                .quantity *
                                                            ((100 -
                                                                book.discount) /
                                                                100)
                                                    }}
                                                    VNĐ
                                                </td>
                                            </tr>
                                            <tr class="summary-subtotal">
                                                <td>Mã giảm giá</td>
                                                <td>{{ discountCode }}%</td>
                                            </tr>
                                            <!-- End .summary-subtotal -->
                                            <tr class="summary-shipping">
                                                <td>Vận chuyển</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr
                                                class="summary-shipping-row"
                                                v-for="(transporter,index) in transporters"
                                                :key="index"
                                            >
                                                <td>
                                                    <div
                                                        class="custom-control custom-radio"
                                                    >
                                                        <ValidationProvider
                                                            rules="required"
                                                            name="transporter"
                                                            v-slot="{ errors }"
                                                        >
                                                            <input
                                                                type="radio"
                                                                :id="'Transporter'+index"
                                                                :value="transporter.id"
                                                                v-model="transporter_id"
                                                                class="custom-control-input"
                                                                @click="setPostage(transporter.postage)"
                                                                name="transporter"
                                                            />

                                                            <label
                                                                class="custom-control-label"
                                                                :for="'Transporter'+index"
                                                                >{{
                                                                    transporter.name
                                                                }}</label
                                                            >
                                                            <span
                                                                class="inputErrors"
                                                                >{{
                                                                    errors[0]
                                                                }}</span
                                                            >
                                                        </ValidationProvider>
                                                    </div>
                                                    <!-- End .custom-control -->
                                                </td>
                                                <td>
                                                    {{ transporter.postage }}
                                                    VNĐ
                                                </td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Tổng hóa đơn:</td>
                                                <td>{{ totalPrice }} VNĐ</td>
                                            </tr>
                                            <!-- End .summary-total -->
                                        </tbody>
                                    </table>
                                    <!-- End .table table-summary -->

                                    <div
                                        class="accordion-summary"
                                        id="accordion-payment"
                                    >
                                        <h3 class="summary-title">Phương thức thanh toán</h3>
                                        <div class="card">
                                            <div
                                                class="card-header"
                                                id="heading-1"
                                            >
                                                <h2 class="card-title">
                                                    <div class="custom-control custom-radio">
                                                        <ValidationProvider
                                                        rules="required"
                                                        name="payment"
                                                        v-slot="{ errors }"
                                                    >
                                                        <input
                                                            name="payment_methods"
                                                            type="radio"
                                                            id="payment_on_delivery"
                                                            value="payment_on_delivery"
                                                            v-model="payment"
                                                            class="custom-control-input"
                                                        />
                                                        <label
                                                            class="custom-control-label"
                                                            for="payment_on_delivery"
                                                        >
                                                            Thanh toán khi nhận
                                                            hàng
                                                        </label>
                                                        <span
                                                            class="inputErrors"
                                                            >{{
                                                                errors[0]
                                                            }}</span
                                                        >
                                                    </ValidationProvider>
                                                    </div>
                                                </h2>
                                            </div>
                                            <!-- End .card-header -->
                                            <div
                                                id="collapse-1"
                                                class="collapse show"
                                                v-if="payment == 'payment_on_delivery'"
                                            >
                                                <div class="card-body">
                                                    Thanh toán khi người giao
                                                    hàng vận chuyển sản phẩm đến
                                                    với bạn
                                                </div>
                                                <!-- End .card-body -->
                                            </div>
                                            <!-- End .collapse -->
                                        </div>
                                        <!-- End .card -->
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-outline-primary-2 btn-order btn-block"
                                    >
                                        <span class="btn-text"
                                            >Đơn hàng của bạn</span
                                        >
                                        <span class="btn-hover-text"
                                            >Đặt hàng</span
                                        >
                                    </button>
                                </div>
                                <!-- End .summary -->
                            </aside>
                            <!-- End .col-lg-3 -->
                        </div>
                        <!-- End .row -->
                    </form>
                </ValidationObserver>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .checkout -->
    </div>
    <!-- End .page-content -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    computed: {
        ...mapGetters(["books", "authUser", "totalPrice"])
    },
    data() {
        return {
            discountCode: 0,
            transporters: [],
            transporter_id: [],
            note: null,
            provinces: [],
            districts: [],
            wards: [],
            province_id: null,
            district_id: null,
            ward_id: null,
            payment: null,
            error: {},
            success: false,
            unsuccessful: false,
            notItem: false,
        };
    },
    methods: {
        ...mapActions(["setPostage",'setBooksBeforeOrder','clearCart']),
        getTransporters() {
            axios.get("api/info/transporters").then(response => {
                this.transporters = response.data.transporters;
            });
        },
        getProvinces() {
            axios
                .get("/api/location/provinces")
                .then(response => {
                    this.provinces = response.data;
                })
                .catch(() => {});
        },
        getDistricts() {
            axios
                .get(
                    "/api/location/province/" + this.province_id + "/districts"
                )
                .then(response => {
                    this.districts = response.data;
                })
                .catch(error => {});
        },
        getWards() {
            axios
                .get(
                    "/api/location/province/district/" +
                        this.district_id +
                        "/wards"
                )
                .then(response => {
                    this.wards = response.data;
                })
                .catch(error => {});
        },
        onSubmit(){
            if(this.books!== []){
                var orderBill = {};
            orderBill.phone_number = this.authUser.phone;
            orderBill.dispatch = this.authUser.address;
            orderBill.district_id = this.authUser.district_id;
            orderBill.ward_id = this.authUser.ward_id;
            orderBill.province_id = this.authUser.province_id;
            orderBill.payment_methods = this.payment;
            orderBill.totalPrice = this.totalPrice;
            orderBill.transporter_id = this.transporter_id;
            orderBill.discount_code_id = this.discount_code_id;
            orderBill.books = this.books;
            orderBill.note = this.note;
            axios
                .post("checkout", orderBill)
                .then((response) => {
                    if(response.data.status == 201){
                        this.success = true;
                        this.error = {};
                        this.clearCart();
                        return;
                    }
                        this.unsuccessful =true;
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
                });
            }else{
                this.notItem = true;
            }
        }
    },
    watch: {
        province_id() {
            this.getDistricts();
        },
        district_id() {
            this.getWards();
        },
        success() {
            setTimeout(() => (this.success = false), 1500);
        },
        unsuccessful(){
            setTimeout(() => (this.unsuccessful = false), 2000);
        },
        notItem(){
            setTimeout(() => (this.notItem = false), 2000);
        },
    },
    mounted() {
        if (this.authUser) {
            this.province_id = this.authUser.province_id;
            this.district_id = this.authUser.district_id;
            this.ward_id = this.authUser.ward_id;
        }
        this.getProvinces();
        this.getDistricts();
        this.getWards();
        this.getTransporters();
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
    background-color:rgba(0,255,0,0.3);
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
