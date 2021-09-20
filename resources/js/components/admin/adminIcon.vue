<template>
    <div class="account" style="margin-left: 20px;">
        <a href="/admin/dashboard" title="Login">
            <div class="icon" style="height: 20px;">
                <i
                    class="icon-user"
                    style="
                        margin-left: 18px;
                        font-size: 3rem;
                        color: #333;
                        line-height: 1;"
                    >
                </i>
            </div>
            <p style="font-family: 'molla';">Trang quản lý</p>
        </a>
    </div>
    <!-- End .compare-dropdown -->
</template>

<script>
import {mapGetters, mapActions} from "vuex";
export default {
    props: {
        user: {
            type: Object
        }
    },
    computed: {
        ...mapGetters(['authUser']),
    },
    methods: {
        ...mapActions(['setAuthUser']),
    },
    mounted(){
        this.setAuthUser(this.user);
    }
};
</script>

<style></style>
