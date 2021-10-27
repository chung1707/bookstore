<template>
    <div>
        <star-rating v-bind:star-size="star_size" :read-only="true" :rating="rating" :show-rating="false">></star-rating> ({{total}} Đánh giá)
    </div>
</template>

<script>
export default {
    props: {
        book: {
            required: true,
            type: Object
        },
        star_size: {
            required: true,
            type: Number,
        },
    },
    data() {
        return {
            rating: 0,
            total: 0,
            book_id : this.book.id,
        };
    },
    methods: {
        getRating() {
            let formData = new FormData();
            formData.append("book_id", this.book_id);
            axios.get("/get-average-rating/"+this.book_id, formData).then(response => {
                this.rating = response.data.average;
                this.total = response.data.total;
            });
        }
    },
    beforeMount() {
        this.book_id = this.book.id;
        this.getRating();
    }
};
</script>

<style></style>
