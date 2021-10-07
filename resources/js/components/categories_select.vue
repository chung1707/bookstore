<template>
    <div class="form-group content">
        <span class="categoryList ">
            <span class="categoryItem"
            v-for="(category,index) in selectedCategories" :key="category.id">
                {{ category.name }}
                <span class="delete" @click="selectedCategories.splice(index,1)">x</span>
            </span>
        </span>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Chọn thể loại
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <input class="form-control CategorySearch" type="text" placeholder="Nhập thể loại" v-model="keyWord" v-on:input="debounceInput">
                <a class="dropdown-item" href="#"
                v-for="category in categories" :key="category.id"
                @click.prevent="addCategory(category)"
                >
                {{ category.name }}
                </a>
            </div>
        </div>
        <input type="hidden" name="category_ids[]"
        v-for="category in selectedCategories" :key="category.id"
        :value="category.id">
    </div>
</template>

<script>
import axios from "axios";

export default {
    data(){
        return {
            keyWord: '',
            categories: [],
            selectedCategories: [],
        }
    },
    methods: {
        getCategories(){
            axios.get("/api/select_categories?keyWord="+this.keyWord).then((response)=>{
                this.categories = response.data;
                console.log(this.keyWord);
            });
        },
        debounceInput: _.debounce(function (){
            this.getCategories();
        },400),
        addCategory(category){
            if(!this.selectedCategories.includes(category)){
                this.selectedCategories.push(category);
            }
        }
    },
    mounted() {
        this.getCategories();
    },
};
</script>

<style scoped>
.CategorySearch {
    padding: 20px;
}
.categoryList {
    margin: 10px 0px;
}
.categoryItem{
    background-color: #dedede;;
    border-radius: 10px;
    color: black;
    padding: 8px;
    margin-right: 10px;
}
.delete {
    color: red;
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
}
.dropdown {
    display: inline-block;
}
</style>>

