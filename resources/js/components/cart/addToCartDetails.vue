<template>
    <div style="min-width: 100%;">
        <div class="details-filter-row details-row-size">
            <label for="qty">Số lượng:</label>
            <div class="product-details-quantity">
                <div class="input-group  input-spinner">
                    <div class="input-group-prepend">
                        <button style="min-width: 32px" class="btn btn-decrement btn-spinner" type="button" @click="reduce">
                            <i class="icon-minus"></i>
                        </button>
                    </div>
                    <input type="number" style="text-align: center" class="form-control  quantityInput" v-model="quantity" min="1">
                    <div class="input-group-append">
                        <button style="min-width: 32px" class="btn btn-increment btn-spinner" type="button" @click="increasing">
                            <i class="icon-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- End .product-details-quantity -->
        <a @click.prevent="addBookToCart" class="btn-product btn-cart" style="cursor: pointer;"><span>Thêm vào giỏ hàng</span></a>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    data(){
        return {
            quantity: 1,
        }
    },
    computed: {
        ...mapGetters(['authUser']),
    },
    props: {
        book: {
            required: true,
            type: Object
        },
    },
    methods: {
        ...mapActions(['addToCart']),
        addBookToCart(){
            if(this.authUser == null){
                window.location.href = "/login";
            }
            else
            {
                this.book['with']= {'quantity': this.quantity }
                this.addToCart(this.book);
            }
        },
        increasing(){
            if(this.quantity <= this.book.quantity){
                this.quantity++;
            }
        },
        reduce(){
            if(this.quantity>=1){
                this.quantity--;
            }
        }
    },
    watch: {
        quantity(){
            if(this.quantity>this.book.quantity){
                return this.quantity = this.book.quantity;
            }
            if(this.quantity<1)
            {
                return this.quantity =1;
            }
        }
    }
}
</script>

<style scoped>
.quantityInput::-webkit-outer-spin-button,
.quantityInput::-webkit-inner-spin-button{
    -webkit-appearance: none;
    margin: 0;
}
</style>
