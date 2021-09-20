<template>
<v-pagination
      v-model="currentPage"
      :length="lastPage"
    ></v-pagination>
</template>

<script>
export default {
    computed: {
        currentPage: {
            get(){
                return this.$store.state.users.current_page;
            },
        },
        lastPage: {
            get(){
                return this.$store.state.users.last_page;
            }
        }
    },

}
</script>

<style>

</style>
