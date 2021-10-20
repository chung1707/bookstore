<template>
    <div>
        <a
            @click.prevent="add()"
            class="btn btn-info"
            >Xuất kho</a
        >
    </div>
</template>
<script>
import {mapActions} from 'vuex'
export default {
    props: {
        book: {
            required: true,
            type: Object
        },
    },
    methods: {
        ...mapActions(['addToAdminCart']),
        add(){
            this.addToAdminCart(this.book)
        }
    },
}
</script>

<style>

</style>
