<template>
    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                        <input
                            type="text"
                            class="form-control"
                            required=""
                            id="checkout-discount-input"
                            placeholder="Bạn có mã giảm giá? Nhập mã"
                        />
                </div>
                <button
                    class="btn btn-outline-primary-2 "
                >
                    <span class="">Sử dụng mã</span>

                </button>
                <!-- End .checkout-discount -->
                <form action="#">
                    <div class="row">
                        <div class="col-lg-9">
                            <update-infos
                                style="margin-bottom: 30px;"
                            ></update-infos>
                            <textarea
                                class="form-control"
                                cols="30"
                                rows="4"
                                placeholder="Notes about your order, e.g. special notes for delivery"
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
                                                    {{ book.pivot.quantity }}</a
                                                >
                                            </td>
                                            <td>
                                                {{
                                                    book.price *
                                                        book.pivot.quantity *
                                                        ((100 - book.discount) /
                                                            100)
                                                }}
                                            </td>
                                        </tr>
                                        <tr class="summary-subtotal">
                                            <td>Mã giảm giá</td>
                                            <td>{{ discountCode }}</td>
                                        </tr>
                                        <!-- End .summary-subtotal -->
                                        <tr class="summary-shipping">
                                            <td>Vận chuyển</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div
                                                    class="custom-control custom-radio"
                                                >
                                                    <input
                                                        type="radio"
                                                        id="free-shipping"
                                                        name="shipping"
                                                        class="custom-control-input"
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="free-shipping"
                                                        >Free Shipping</label
                                                    >
                                                </div>
                                                <!-- End .custom-control -->
                                            </td>
                                            <td>$0.00</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div
                                                    class="custom-control custom-radio"
                                                >
                                                    <input
                                                        type="radio"
                                                        id="express-shipping"
                                                        name="shipping"
                                                        class="custom-control-input"
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="express-shipping"
                                                        >Express:</label
                                                    >
                                                </div>
                                                <!-- End .custom-control -->
                                            </td>
                                            <td>$20.00</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Tổng hóa đơn:</td>
                                            <td>
                                                {{
                                                    totalPrice *
                                                        ((100 - discountCode) /
                                                            100)
                                                }}
                                            </td>
                                        </tr>
                                        <!-- End .summary-total -->
                                    </tbody>
                                </table>
                                <!-- End .table table-summary -->

                                <div
                                    class="accordion-summary"
                                    id="accordion-payment"
                                >
                                    <div class="card">
                                        <div class="card-header" id="heading-1">
                                            <h2 class="card-title">
                                                <a
                                                    role="button"
                                                    data-toggle="collapse"
                                                    href="#collapse-1"
                                                    aria-expanded="true"
                                                    aria-controls="collapse-1"
                                                >
                                                    Direct bank transfer
                                                </a>
                                            </h2>
                                        </div>
                                        <!-- End .card-header -->
                                        <div
                                            id="collapse-1"
                                            class="collapse show"
                                            aria-labelledby="heading-1"
                                            data-parent="#accordion-payment"
                                        >
                                            <div class="card-body">
                                                Make your payment directly into
                                                our bank account. Please use
                                                your Order ID as the payment
                                                reference. Your order will not
                                                be shipped until the funds have
                                                cleared in our account.
                                            </div>
                                            <!-- End .card-body -->
                                        </div>
                                        <!-- End .collapse -->
                                    </div>
                                    <!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-2">
                                            <h2 class="card-title">
                                                <a
                                                    class="collapsed"
                                                    role="button"
                                                    data-toggle="collapse"
                                                    href="#collapse-2"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-2"
                                                >
                                                    Check payments
                                                </a>
                                            </h2>
                                        </div>
                                        <!-- End .card-header -->
                                        <div
                                            id="collapse-2"
                                            class="collapse"
                                            aria-labelledby="heading-2"
                                            data-parent="#accordion-payment"
                                        >
                                            <div class="card-body">
                                                Ipsum dolor sit amet,
                                                consectetuer adipiscing elit.
                                                Donec odio. Quisque volutpat
                                                mattis eros. Nullam malesuada
                                                erat ut turpis.
                                            </div>
                                            <!-- End .card-body -->
                                        </div>
                                        <!-- End .collapse -->
                                    </div>
                                    <!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-3">
                                            <h2 class="card-title">
                                                <a
                                                    class="collapsed"
                                                    role="button"
                                                    data-toggle="collapse"
                                                    href="#collapse-3"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-3"
                                                >
                                                    Cash on delivery
                                                </a>
                                            </h2>
                                        </div>
                                        <!-- End .card-header -->
                                        <div
                                            id="collapse-3"
                                            class="collapse"
                                            aria-labelledby="heading-3"
                                            data-parent="#accordion-payment"
                                        >
                                            <div class="card-body">
                                                Quisque volutpat mattis eros.
                                                Lorem ipsum dolor sit amet,
                                                consectetuer adipiscing elit.
                                                Donec odio. Quisque volutpat
                                                mattis eros.
                                            </div>
                                            <!-- End .card-body -->
                                        </div>
                                        <!-- End .collapse -->
                                    </div>
                                    <!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-4">
                                            <h2 class="card-title">
                                                <a
                                                    class="collapsed"
                                                    role="button"
                                                    data-toggle="collapse"
                                                    href="#collapse-4"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-4"
                                                >
                                                    PayPal
                                                    <small
                                                        class="float-right paypal-link"
                                                        >What is PayPal?</small
                                                    >
                                                </a>
                                            </h2>
                                        </div>
                                        <!-- End .card-header -->
                                        <div
                                            id="collapse-4"
                                            class="collapse"
                                            aria-labelledby="heading-4"
                                            data-parent="#accordion-payment"
                                        >
                                            <div class="card-body">
                                                Nullam malesuada erat ut turpis.
                                                Suspendisse urna nibh, viverra
                                                non, semper suscipit, posuere a,
                                                pede. Donec nec justo eget felis
                                                facilisis fermentum.
                                            </div>
                                            <!-- End .card-body -->
                                        </div>
                                        <!-- End .collapse -->
                                    </div>
                                    <!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-5">
                                            <h2 class="card-title">
                                                <a
                                                    class="collapsed"
                                                    role="button"
                                                    data-toggle="collapse"
                                                    href="#collapse-5"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-5"
                                                >
                                                    Credit Card (Stripe)
                                                    <img
                                                        src="assets/images/payments-summary.png"
                                                        alt="payments cards"
                                                    />
                                                </a>
                                            </h2>
                                        </div>
                                        <!-- End .card-header -->
                                        <div
                                            id="collapse-5"
                                            class="collapse"
                                            aria-labelledby="heading-5"
                                            data-parent="#accordion-payment"
                                        >
                                            <div class="card-body">
                                                Donec nec justo eget felis
                                                facilisis fermentum.Lorem ipsum
                                                dolor sit amet, consectetuer
                                                adipiscing elit. Donec odio.
                                                Quisque volutpat mattis eros.
                                                Lorem ipsum dolor sit ame.
                                            </div>
                                            <!-- End .card-body -->
                                        </div>
                                        <!-- End .collapse -->
                                    </div>
                                    <!-- End .card -->
                                </div>
                                <!-- End .accordion -->

                                <button
                                    type="submit"
                                    class="btn btn-outline-primary-2 btn-order btn-block"
                                >
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text"
                                        >Proceed to Checkout</span
                                    >
                                </button>
                            </div>
                            <!-- End .summary -->
                        </aside>
                        <!-- End .col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </form>
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
            discountCode: 0
        };
    },
    methods: {},
};
</script>

<style></style>
