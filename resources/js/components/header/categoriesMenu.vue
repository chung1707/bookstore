<template>
    <div class="row no-gutters">
        <div class="col-md-6">
            <div class="menu-col">
                <div class="menu-title" style="font-size: 14px;">Các thể loại phổ biến</div>
                <!-- End .menu-title -->
                <ul>
                    <li
                    v-for="category in categories" :key="category.id"
                    ><a href="product.html">
                        <span style="font-size: 16px;">{{category.name}} </span>
                    </a></li>
                </ul>
            </div>
            <!-- End .menu-col -->
        </div>
        <!-- End .col-md-6 -->

        <div class="col-md-6">
            <div class="banner banner-overlay" style="background-color: white;">
                <a href="category.html">
                    <img  :src="'/storage/thumbnails/'+this.thumbnail" alt="Banner" />

                    <div class="">
                        <div class="banner-title text-black"
                            style="padding: 56px 0px;
                            text-align: center;
                            background: white;
                            max-height: 450px;">
                            {{ categories[0].name }}<br /><span
                                ><strong>{{ this.book.name }}</strong></span
                            >
                        </div>
                        <!-- End .banner-title -->
                    </div>
                    <!-- End .banner-content -->
                </a>
            </div>
            <!-- End .banner -->
        </div>
        <!-- End .col-md-6 -->
    </div>
    <!-- End .row -->
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            categories: [],
            book: [],
            thumbnail: null,
        }
    },
    methods: {
        getCategories(){
            axios.get('/api/get_hot_categories').then(response => {
              this.categories = response.data.categories;
              this.book = response.data.book;
              this.thumbnail = response.data.book.thumbnails[0].img;
            });
        }
    },
    mounted() {
        this.getCategories();
    }

};
</script>

<style scoped>

</style>


