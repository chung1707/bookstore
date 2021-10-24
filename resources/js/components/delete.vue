<template>
    <form
        @submit="submit"
        method="post"
    >
        @method('DELETE') @csrf
        <button class="btn-flat btn-default btn-sm" type="submit">Xóa</button>
    </form>
</template>

<script>
export default {
    methods: {
        submit(){

        },
    }
};
</script>

<style></style>
