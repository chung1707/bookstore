<template>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 cart_icon">
            <a
                class="info-box-icon bg-success elevation-1"
                @click.prevent="show = true"
                ><i class="fas fa-shopping-cart"></i
            ></a>
            <div class="info-box-content">
                <span class="info-box-text">Sản phẩm chờ xuất</span>
                <span class="info-box-number">{{ totalBookInAdminCart }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div
            class="dropdown-menu dropdown-menu-lg dropdown-menu-right show cart_content"
            v-show="show"
            @mouseleave="show = false"
            style="left: inherit; right: 0px; width: 400px;"
        >
            <div href="#" class="dropdown-item"
            v-for="book in adminCart" :key="book.id"
            >
                <!-- Message Start -->
                <div class="media">
                    <div v-if="book.thumbnails[0].img">
                        <img
                        :src="'/storage/thumbnails/' +book.thumbnails[0].img"
                        class="img-size-50 mr-3 img-circle"
                    />
                    </div>
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{book.name}}
                            <span class="float-right text-sm text-danger"
                                >
                                <i class="fas fa-times" @click="deleteBookInAdminCart(book)"></i>
                                </span>
                        </h3>
                        <p class="text-sm">Số lượng: {{ book.pivot.quantity }}</p>
                        <p class="text-sm text-muted">
                            Giá: {{ book.price }}
                        </p>
                    </div>
                </div>
                <!-- Message End -->
            </div>
            <a href="/admin/cart" class="dropdown-item dropdown-footer text-center"
                >Lập hóa đơn</a
            >
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            show: false
        };
    },
    computed: {
        ...mapGetters([
            "adminCart",
            "adminCartTotalPrice",
            "totalBookInAdminCart"
        ])
    },
    methods: {
        ...mapActions(["getAdminCart", "deleteBookInAdminCart"])
    },
    mounted() {
        this.getAdminCart();
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
</style>
