<template>
    <div>
        <div class="card-header" id="product-review-heading">
            <h2 class="card-title">
                <a
                    class="collapsed"
                    role="button"
                    data-toggle="collapse"
                    href="#product-accordion-review"
                    aria-expanded="false"
                    aria-controls="product-accordion-review"
                >
                    Đánh giá
                </a>
            </h2>
        </div>
        <!-- End .card-header -->
        <div
            id="product-accordion-review"
            class="collapse"
            aria-labelledby="product-review-heading"
            data-parent="#product-accordion"
        >
            <div class="row no-gutters">
                <a
                    v-show="this.bought == true || auth.role.name == 'admin'"
                    href="#"
                    class="btn btn-primary"
                    style="margin: 10px 20px;"
                    @click.prevent="show"
                    >Thêm đánh giá<i class="icon-long-arrow-right"></i
                ></a>
            </div>
            <div class="card-body">
                <div class="reviews">
                    <div class="review">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <h4><a href="#">Samanta J.</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div
                                            class="ratings-val"
                                            style="width: 80%;"
                                        ></div>
                                        <!-- End .ratings-val -->
                                    </div>
                                    <!-- End .ratings -->
                                </div>
                                <!-- End .rating-container -->
                                <span class="review-date">6 days ago</span>
                            </div>
                            <!-- End .col -->
                            <div class="col">
                                <h4>Good, perfect size</h4>

                                <div class="review-content">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipisicing elit. Ducimus cum dolores
                                        assumenda asperiores facilis porro
                                        reprehenderit animi culpa atque
                                        blanditiis commodi perspiciatis
                                        doloremque, possimus, explicabo, autem
                                        fugit beatae quae voluptas!
                                    </p>
                                </div>
                                <!-- End .review-content -->

                                <div class="review-action">
                                    <a href="#"
                                        ><i class="icon-thumbs-up"></i>Helpful
                                        (2)</a
                                    >
                                    <a href="#"
                                        ><i class="icon-thumbs-down"></i
                                        >Unhelpful (0)</a
                                    >
                                </div>
                                <!-- End .review-action -->
                            </div>
                            <!-- End .col-auto -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .review -->
                </div>
                <!-- End .reviews -->
            </div>
            <!-- End .card-body -->
        </div>
        <!-- End .collapse -->
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    props: {
        bought: {
            type: Boolean,
        }
    },
    computed: {
        ...mapGetters(['authUser']),
    },
    data(){
        return {
            show: false,
        }
    }
};
</script>

<style></style>
