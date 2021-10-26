<template>
    <button
        type="button"
        class="btn btn-primary float-right"
        style="margin-right: 5px;"
        @click.prevent="print()"
    >
        <i class="fas fa-download"></i> Xuất ra file PDF
    </button>
</template>

<script>
export default {
    methods: {
        print() {
            window.print();
        }
    }
};
</script>

<style></style>
