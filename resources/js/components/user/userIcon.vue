<template>
    <div class="account" style="margin-left: 20px;">
        <a href="/profile" title="My account">
            <div class="icon" style="height: 20px; text-align: center;">
                <i
                    class="icon-user"
                    style="
                font-size: 3rem;
                color: #333;
                line-height: 1;"
                >
                </i>

            </div>
            <p>{{ authUser.name }}</p>
        </a>
    </div>
    <!-- End .compare-dropdown -->
</template>

<script>
import { mapGetters,mapActions } from 'vuex';

export default {
    computed: {
        ...mapGetters(['authUser']),
    },
    props: {
        user: {
            type: Object,
            required: true,
        }
    },
    methods: {
        ...mapActions(['setAuthUser']),
    },
    beforeMount() {
        this.setAuthUser(this.user);
    }
};
</script>

<style></style>
