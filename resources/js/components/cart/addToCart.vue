<template>
    <div style="min-width: 100%;">
        <a @click.prevent="addBookToCart" class="btn-product btn-cart" style="cursor: pointer;"><span>Thêm vào giỏ hàng</span></a>
    </div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex'
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
        addBookToCart()
        {
            if(this.authUser == null){
                window.location.href = "/login";
            }
            else
            {
                this.book['with']= {'quantity': this.quantity }
                this.addToCart(this.book);
            }
        },
    },
}
</script>

<style>

</style>
