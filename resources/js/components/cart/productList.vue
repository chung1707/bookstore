<template>
    <div class="row">
        <div class="emptyCart container-fluid" v-if="Object.keys(books).length === 0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Giỏ hàng</h5>
                        </div>
                        <div class="card-body cart">
                            <div class="col-sm-12 empty-cart-cls text-center">
                                <img
                                    src="https://i.imgur.com/dCdflKN.png"
                                    width="130"
                                    height="130"
                                    class="img-fluid mb-4 mr-3 cartImg"
                                />
                                <h3><strong>Giỏ hàng của bạn đang trống</strong></h3>
                                <h4>Hãy lựa chọn những thứ kiến bạn hạnh phúc</h4>
                                <a
                                    href="/books"
                                    class="btn btn-outline-primary-2 btn-order"
                                    >Tiếp tục mua sắm</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-9 CartItem" v-if="Object.keys(books).length !== 0">
                <table class="table table-cart table-mobile">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá thành</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(book,index) in books" :key="index">
                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <a :href="'/books/'+book.id">
                                            <img
                                                :src="
                                                    '/storage/thumbnails/' +
                                                        book.thumbnails[0].img
                                                "
                                                alt="Book Image"
                                            />
                                        </a>
                                    </figure>

                                    <h3 class="product-title">
                                        <a :href="'/books/'+book.id">{{ book.name }}</a>
                                    </h3>
                                    <!-- End .product-title -->
                                </div>
                                <!-- End .product -->
                            </td>
                            <td class="price-col">{{ book.price }}</td>
                            <td class="price-col">{{ book.discount }}%</td>
                            <td class="quantity-col">
                                <div
                                    class="product-details-quantity"
                                    style="margin-right: 25px;"
                                >
                                    <div class="input-group  input-spinner">
                                        <div class="input-group-prepend">
                                            <button
                                                style="min-width: 32px"
                                                class="btn btn-decrement btn-spinner"
                                                type="button"
                                                @click="reduce(book)"
                                            >
                                                <i class="icon-minus"></i>
                                            </button>
                                        </div>
                                        <input
                                            type="number"
                                            style="text-align: center"
                                            class="form-control  quantityInput"
                                            @change="check(book)"
                                            v-model="book.pivot.quantity"
                                            min="1"
                                        />
                                        <div class="input-group-append">
                                            <button
                                                style="min-width: 32px"
                                                class="btn btn-increment btn-spinner"
                                                type="button"
                                                @click="increasing(book)"
                                            >
                                                <i class="icon-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .product-details-quantity -->
                            </td>
                            <td class="total-col">
                                {{
                                    book.price *book.pivot.quantity * ((100 - book.discount) / 100)
                                }}
                            </td>
                            <td class="remove-col">
                                <button
                                    class="btn-remove"
                                    @click="deleteBookInCart(book)"
                                >
                                    <i class="icon-close"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End .table table-wishlist -->

                <div class="cart-bottom">
                    <div class="cart-discount">
                        <form action="#">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    required=""
                                    placeholder="coupon code"
                                />
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-outline-primary-2"
                                        type="submit"
                                    >
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div>
                                <!-- .End .input-group-append -->
                            </div>
                            <!-- End .input-group -->
                        </form>
                    </div>
                    <!-- End .cart-discount -->
                         <a  class="btn btn-outline-dark-2 reload" @click.prevent="reloadCart()"
                            ><span>Cập nhập giỏ</span><i class="icon-refresh"></i
                        ></a>
                        <span v-show="reload" class="successLoad"><i class="fas fa-check"></i>  thành công</span>
                </div>
                <!-- End .cart-bottom -->
            </div>
            <aside class="col-lg-3" v-if="Object.keys(books).length !== 0">
                <div class="summary summary-cart">
                    <h3 class="summary-title">Cart Total</h3>
                    <!-- End .summary-title -->
                    <table class="table table-summary">
                        <tbody>
                            <tr class="summary-subtotal">
                                <td>Tổng cộng:</td>
                                <td>{{ totalPrice }}</td>
                            </tr>
                             <tr class="summary-subtotal">
                                <td>Mã giảm giá</td>
                                <td>{{ discountCode }}%</td>
                            </tr>

                            <tr class="summary-total">
                                <td>Tổng thanh toán</td>
                                <td>{{ totalPrice*(( 100 - this.discountCode ) / 100) }}</td>
                            </tr>
                            <!-- End .summary-total -->
                        </tbody>
                    </table>
                    <!-- End .table table-summary -->

                    <a
                        href="/checkout"
                        class="btn btn-outline-primary-2 btn-order btn-block"
                        >Đặt hàng</a
                    >
                </div>
                <!-- End .summary -->

                <a
                    href="/books"
                    class="btn btn-outline-dark-2 btn-block mb-3"
                    ><span>Mua thêm sách</span><i class="icon-refresh"></i
                ></a>
            </aside>
        <!-- End .col-lg-3 -->
    </div>
    <!-- End .row -->
    <!-- End .col-lg-9 -->
</template>

<script>
import {mapActions, mapGetters} from "vuex";
export default {
    data() {
        return {
            reload: false,
        };
    },
    computed: {
        ...mapGetters(['books','totalPrice','discountCode']),
    },
    methods: {
        ...mapActions(['getListBook','deleteBookInCart','updateQty']),
        increasing(book) {
            if (book.pivot.quantity < book.quantity) {
                book.pivot.quantity++;
                this.updateQty(book);
            }
        },
        reduce(book) {
            if (1 < book.pivot.quantity) {
                book.pivot.quantity--;
                this.updateQty(book);
            }
        },
        check(book) {
            if (book.pivot.quantity > book.quantity) {
                (book.pivot.quantity = book.quantity);
            }
            if (book.pivot.quantity < 1) {
                (book.pivot.quantity = 1);
            }
            this.updateQty(book);
        },
        reloadCart(){
            this.getListBook();
            this.reload = true;
        }
    },
    beforeMount() {
        this.getListBook();
    },
    watch: {
        reload() {
            setTimeout(() => this.reload = false, 1000);
        },
    }
};
</script>

<style scoped>
.contentCart {
    justify-content: space-around !important;
}
.quantityInput::-webkit-outer-spin-button,
.quantityInput::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.emptyCart {
    width: 780px;
}
.CartItem{
    width: 780px;
}

.successLoad{
    color: green;
    background-color:rgba(0,255,0,0.3);
    text-align: center;
    z-index: 2;
    padding: 10px 20px;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}


/*
emptycart style */
@import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

body {
    background-color: #eee;
    font-family: 'Calibri', sans-serif !important
}

.mt-100 {
    margin-top: 100px
}

.card {
    margin-bottom: 30px;
    border: 0;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    letter-spacing: .5px;
    border-radius: 8px;
    -webkit-box-shadow: 1px 5px 24px 0 rgba(68, 102, 242, .05);
    box-shadow: 1px 5px 24px 0 rgba(68, 102, 242, .05)
}

.card .card-header {
    background-color: #fff;
    border-bottom: none;
    padding: 24px;
    border-bottom: 1px solid #f6f7fb;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px
}

.card-header:first-child {
    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
}

.card .card-body {
    padding: 30px;
    background-color: transparent;
    padding-bottom: 70px;
}
.cartImg{
    display: inline-block !important;
}
.btn-primary,
.btn-primary.disabled,
.btn-primary:disabled {
    background-color: #4466f2 !important;
    border-color: #4466f2 !important
}
</style>
