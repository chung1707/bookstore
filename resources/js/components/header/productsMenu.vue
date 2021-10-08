<template>
    <div class="row no-gutters">
        <div class="col-md-6">
            <div class="menu-col">
              <div class="menu-title" style="font-size: 16px;">Sách bán chạy</div>
              <!-- End .menu-title -->
              <ul>
                  <li
                  v-for="book in books" :key="book.id"
                  >
                    <a href="product.html">
                        <span style="font-size: 14px;">{{ book.name }}</span>
                    </a>
                  </li>
              </ul>
          </div>
            <!-- End .menu-col -->
        </div>
        <!-- End .col-md-6 -->

        <div class="col-md-6">
            <div class="banner banner-overlay" style="background-color: white;">
                <a href="category.html">
                    <img  :src="'/storage/thumbnails/'+books[0].thumbnails[0].img" alt="Banner" />

                    <div class="">
                        <div class="banner-title text-black"
                            style="padding: 56px 0px;
                            text-align: center;
                            background: white;">
                            {{ books[0].author }}<br /><span
                                ><strong>{{ books[0].name }}</strong></span
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
export default {
    data() {
        return {
            books: []
        };
    },
    methods: {
        getBooks() {
            axios.get("/api/get_hot_books").then(response => {
              this.books = response.data.books;
            });
        }
    },
    mounted() {
        this.getBooks();
    }
};
</script>

<style></style>
