<template>
    <div>
        <a
            href="/cart"
            class="dropdown-toggle"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            data-display="static"
        >
            <i class="icon-shopping-cart"></i>
            <span class="cart-count">{{ totalBook }}</span>
        </a>

        <div
            class="dropdown-menu dropdown-menu-right"
            style=" width: 320px;
                overflow-y: scroll;
                max-height: 500px;"
        >
            <div class="dropdown-cart-products">
                <div class="product" v-for="book in books" :key="book.id">
                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <a :href="'/books/' + book.id">{{ book.name }}</a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{
                                book.pivot.quantity
                            }}</span>
                            X {{ book.price }} VNĐ
                        </span>
                    </div>
                    <!-- End .product-cart-details -->

                    <figure class="product-image-container" v-if="book.thumbnails[0]">
                        <a :href="'/books/' + book.id" class="product-image">
                            <img
                                :src="
                                    '/storage/thumbnails/' +
                                        book.thumbnails[0].img
                                "
                                alt="book"
                            />
                        </a>
                    </figure>
                    <a
                        href="#"
                        class="btn-remove"
                        title="Remove Product"
                        @click.prevent="deleteBookInCart(book)"
                        ><i class="icon-close"></i
                    ></a>
                </div>
                <!-- End .product -->

                <div></div>
            </div>
            <!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <span>Tổng tiền</span>
                <span class="cart-total-price">{{ totalPrice }}</span>
            </div>
            <!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="/cart" class="btn btn-primary">Giỏ hàng</a>
                <a href="checkout" class="btn btn-outline-primary-2"
                    ><span>Thanh toán</span><i class="icon-long-arrow-right"></i
                ></a>
            </div>
            <!-- End .dropdown-cart-total -->
        </div>
        <!-- End .dropdown-menu -->
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(["books","totalPrice","totalBook"])
    },
    methods: {
        ...mapActions(["getListBook", "deleteBookInCart",]),
    },
    mounted() {
        this.getListBook();
    },
};
</script>

<style scoped></style>
