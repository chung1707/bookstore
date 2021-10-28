<template>
    <div class="container">
        <h3>Tạo bài viết</h3>
        <div class="card" style="margin: 0px auto;">
            <ValidationObserver v-slot="{ handleSubmit }">
                <form action="#" @submit.prevent="handleSubmit(onSubmit)">
                    <div class="row">
                        <div class="col-lg-9">
                            <div style="margin-bottom: 30px;">
                                <div>
                                    <ValidationProvider
                                        rules="required|max:255|min:5|"
                                        name="title"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            required="true"
                                            name="title"
                                            v-model="title"
                                            placeholder="Tiêu đề"
                                        />
                                    </ValidationProvider>
                                </div>

                                <div>
                                    <ValidationProvider
                                        rules="required"
                                        name="content"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                        <textarea
                                            v-model="content"
                                            class="form-control"
                                            cols="30"
                                            rows="4"
                                            placeholder="Nội dung bài viết"
                                        ></textarea>
                                    </ValidationProvider>
                                </div>
                                <ValidationProvider
                                    rules="required"
                                    name="category_ids"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div class="form-group">
                                        <input
                                            type="hidden"
                                            v-model="category_ids"
                                            name="category_ids"
                                        />
                                        <categories-select></categories-select>
                                    </div>
                                </ValidationProvider>
                            </div>
                        </div>
                        <!-- End .col-lg-9 -->
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Tạo bài viết
                    </button>

                    <!-- End .row -->
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters([
            "category_ids",
        ])
    },
    data() {
        return {
            title: null,
            content: null,
        };
    },
    methods: {
        onSubmit() {
            var formData = new FormData();
            formData.append("title", this.title);
            formData.append("content", this.content);
            axios
                .post("update_info", formData)
                .then(() => {
                    this.success = true;
                    this.error = {};
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
                });
        },
    },
    mounted() {

    },
    watch() {

    }
};
</script>

<style></style>
