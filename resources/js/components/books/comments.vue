<template>
    <div>
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thành công!
        </h5>
        <h5 class="unsuccessful" v-if="error">
            <i class="fas fa-times-octagon">Đã có lỗi sãy ra!</i>
        </h5>
        <div v-if="comments">
            <div
                class="alert alert-success alert-dismissible"
                v-for="comment in comments.data"
                :key="comment.id"
            >
                <button
                    type="button"
                    class="close"
                    @click.prevent="deleteComment(comment)"
                >
                    <i class="fas fa-trash"></i>
                </button>

                <h5>
                    <i class="icon fas fa-check"></i>{{ comment.user.name }}
                </h5>
                <star-rating
                    v-bind:star-size="15"
                    :read-only="true"
                    :rating="comment.rating"
                    :show-rating="false"
                    >></star-rating
                >
                {{ comment.content }}
            </div>
            <pagination
                align="center"
                :data="comments"
                @pagination-change-page="list"
            ></pagination>
        </div>

        <p v-else>
            Chưa có đánh giá nào cho sản phẩm!
        </p>
    </div>
</template>

<script>
export default {
    props: {
        book: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            comments: {
                type: Object,
                default: null
            },
            success: false,
            error: false,
        };
    },
    methods: {
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
        deleteComment(comment) {
            axios
                .delete("/comment/" + comment.id)
                .then(response => {
                    if (response.data.status == 201) {
                        this.success = true;
                        this.list();
                    } else {
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
    }
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
    background-color: rgba(191, 177, 177, 0.3);
    text-align: center;
    z-index: 99999;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
</style>
