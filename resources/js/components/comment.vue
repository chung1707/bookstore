<template>
    <div>
        <!-- End .card-header -->
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thành công!
        </h5>
        <h5 class="unsuccessful" v-if="error">
            <i class="fas fa-times-octagon">Đã có lỗi sãy ra!</i>
        </h5>
        <div
            v-if="show"
            class="card card-box card-sm"
            style=" border: 2px red !important;
                    padding: 10px;
                    z-index: 2;
                    background: #ebebeb;
                    margin-bottom: 20px;"
        >
            <form action="#">
                <div class="row">
                    <div class="col-12" style="margin: 20px 0px;">
                        <h5>Đánh giá số sao cho sản phẩm</h5>
                        <star-rating
                            v-bind:star-size="30"
                            v-model="star"
                        ></star-rating>
                    </div>
                    <!-- End .col-lg-9 -->

                    <!-- End .col-lg-3 -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <textarea
                            v-model="content"
                            class="form-control"
                            cols="30"
                            rows="4"
                            placeholder="Nhận sét của bạn về sản phẩm!"
                        ></textarea>
                    </div>
                </div>
                <div class="row">
                    <a
                        @click.prevent="show = false"
                        class="btn btn-primary"
                        style="margin: 5px 20px;"
                        >Hủy</a
                    >
                    <a
                        class="btn btn-secondary"
                        style="margin: 5px 20px;"
                        @click.prevent="addComment"
                        >Thêm đánh giá</a
                    >
                </div>
                <!-- End .row -->
            </form>
        </div>

        <div
            class="accordion accordion-plus product-details-accordion"
            id="product-accordion"
        >
            <div class="card card-box card-sm">
                <div class="card-header" id="product-desc-heading">
                    <h2 class="card-title">
                        <a
                            class=""
                            role="button"
                            data-toggle="collapse"
                            href="#product-accordion-desc"
                            aria-expanded="true"
                            aria-controls="product-accordion-desc"
                        >
                            Giới thiệu sách
                        </a>
                    </h2>
                </div>
                <!-- End .card-header -->
                <div
                    id="product-accordion-desc"
                    class="collapse"
                    aria-labelledby="product-desc-heading"
                    data-parent="#product-accordion"
                >
                    <div class="card-body">
                        <div class="product-desc-content">
                            <p>{{ book.description }}</p>
                        </div>
                        <!-- End .product-desc-content -->
                    </div>
                    <!-- End .card-body -->
                </div>
                <!-- End .collapse -->
            </div>
            <!-- End .card -->

            <!-- End .card -->

            <div class="card card-box card-sm">
                <!-- End .card-header -->
                <div class="card card-box card-sm">
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
                                Đánh giá sản phẩm: {{ total }} đánh giá!
                            </a>
                        </h2>
                    </div>
                    <!-- End .card-header -->
                    <div
                        id="product-accordion-review"
                        class="collapse show"
                        aria-labelledby="product-review-heading"
                        data-parent="#product-accordion"
                        style=""
                    >
                        <a
                            v-if="this.bought == true || this.authUser.role.name == 'admin'"
                            @click="show = true"
                            class="btn btn-secondary"
                            style="margin: 5px 20px;"
                            >Thêm đánh giá</a
                        >
                        <div class="card-body">
                            <div class="reviews">
                                <div
                                    class="review"
                                    v-for="comment in comments.data"
                                    :key="comment.id"
                                >
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4>{{ comment.user.name }}</h4>
                                            <div class="ratings-container">
                                                <star-rating
                                                    v-bind:star-size="15"
                                                    :read-only="true"
                                                    :rating="comment.rating"
                                                    :show-rating="false"
                                                ></star-rating>
                                            </div>
                                            <!-- End .rating-container -->
                                        </div>
                                        <!-- End .col -->
                                        <div class="col">
                                            <div class="review-content">
                                                <p>
                                                    {{ comment.content }}
                                                </p>
                                            </div>
                                            <div class="review-action">
                                                <span><i class="fal fa-history"></i>{{
                                                        comment.created_at}}
                                                </span>
                                                <a
                                                style="cursor: pointer;"
                                                @click.prevent="deleteComment(comment)"
                                                v-if="authUser.role.name=='admin'||authUser.id==comment.user_id"
                                                >
                                                    <i class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <!-- End .col-auto -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .review -->
                                <pagination
                                    align="center"
                                    :data="comments"
                                    @pagination-change-page="list"
                                ></pagination>
                            </div>
                            <!-- End .reviews -->
                        </div>
                        <!-- End .card-body -->
                    </div>
                    <!-- End .collapse -->
                </div>
                <!-- End .collapse -->
            </div>
            <!-- End .card -->

            <div class="card card-box card-sm"></div>
            <!-- End .card -->
        </div>
        <!-- End .accordion -->
        <!-- End .collapse -->
    </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
    props: {
        bought: {
            required: true,
            type: Boolean
        },
        book: {
            required: true,
            type: Object
        }
    },
    computed: {
        ...mapGetters(["authUser"])
    },
    data() {
        return {
            show: false,
            content: "",
            star: 5,
            comments: {
                type: Object,
                default: null
            },
            total: 0,
            success: false,
            error: false,
        };
    },
    methods: {
        addComment() {
            let formData = new FormData();
            formData.append("rating", this.star);
            formData.append("content", this.content);
            formData.append("book_id", this.book.id);
            axios.post("/add-comment", formData).then(response => {
                this.success = true;
                window.location.reload();
            });
        },
        async list(page = 1) {
            await axios
                .get(`/get-comments/${this.book.id}?page=${page}`)
                .then(({ data }) => {
                    this.comments = data.comments;
                    this.total = data.total;
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        deleteComment(comment){
            axios.delete('/comment/' +comment.id ).then(response => {
                if(response.data.status == 201){
                    this.success = true;
                    this.list();
                }
                else{
                    this.error = true;
                }
            })
            .catch(({ response }) => {
                console.error(response);
            });
        }
    },
    mounted() {
        this.list();
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        },
        error() {
            setTimeout(() => (this.error = false), 2000);
        }
    },
};
</script>

<style scoped>
.pagination {
    margin-bottom: 10px;
}
.success {
    color: green;
    padding: 20px;
    background-color: rgba(0, 255, 0, 0.3);
    text-align: center;
    z-index: 999999;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
.unsuccessful {
    color: rgb(255, 83, 78);
    padding: 20px;
    background-color:rgba(191, 177, 177, 0.3);
    text-align: center;
    z-index: 99999;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
</style>
