<template>
    <div class="col-12 col-sm-6">
        <div class="col-12" v-if="img1">
            <img
                :src="'/storage/thumbnails/' + book.thumbnails[0].img"
                class="product-image"
                alt="Product Image"
            />
        </div>
        <div class="col-12" v-else>
            <img v-if="book.thumbnails[1]"
                :src="'/storage/thumbnails/' + book.thumbnails[1].img"
                class="product-image"
                alt="Product Image"
            />
        </div>
        <div class="col-12 product-image-thumbs">
            <div class="product-image-thumb active">
                <img @click="img1 = true"
                    :src="'/storage/thumbnails/' + book.thumbnails[0].img"
                    alt="Product Image"
                />
            </div>
            <div class="product-image-thumb" v-if="book.thumbnails[1]">
                 <img @click="img1 = false"
                    :src="'/storage/thumbnails/' + book.thumbnails[1].img"
                    alt="Product Image"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        book: {
            required: true,
            type: Object
        },
    },
    data(){
        return {
            img1: true,
        }
    }
};
</script>

<style></style>
