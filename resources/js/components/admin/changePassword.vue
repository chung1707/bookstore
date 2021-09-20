<template>
    <div style="padding: 20px;">
        <h5 class="success" v-if="success"><i class="fas fa-check"></i> Thay đổi mật khẩu thành công </h5>
        <br>
        <span class="error" v-if="error.password">{{ error.password[0] }}</span>
        <span class="error" v-if="error.result">{{ error.result }}</span>
         <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px">
                    <i class="fas fa-user-tie"></i>
                    &emsp;Mật khẩu</span
                >
            </div>
            <input
            :class="{errorInput: error.password}"
            type="password"
            class="form-control"
            placeholder="Mật khẩu mới"
            name="passowrd"
            v-model="password"
        />
        </div>
        <span class="error" v-if="error.new_password">{{ error.new_password[0] }}</span>
       <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px">
                    <i class="fas fa-user-tie"></i>
                    &emsp;Mật khẩu mới</span
                >
            </div>
            <input
            :class="{errorInput: error.new_password}"
            type="password"
            class="form-control"
            placeholder="Mật khẩu mới"
            name="new_password"
            v-model="new_password"
        />
        </div>
        <span class="error" v-if="error.password_confirmation">{{ error.password_confirmation[0] }}</span>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px">
                    <i class="fas fa-user-tie"></i>
                    &emsp;Xác nhận mật khẩu mới</span
                >
            </div>
            <input
            :class="{errorInput: error.password_confirmation}"
            type="password"
            class="form-control"
            placeholder="Mật khẩu mới"
            name="password_confirmation"
            v-model="password_confirmation"
        />
        </div>

        <button  @click.prevent="update()" class="btn btn-info">Đổi mật khẩu</button>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            password: null,
            new_password: null,
            password_confirmation: null,
            error: {},
            success: false,
        };
    },
    methods: {
        update() {
            var formData = new FormData();
            formData.append("password", this.password);
            formData.append("new_password", this.new_password);
            formData.append("password_confirmation", this.password_confirmation);
            axios
                .post("update_password", formData)
                .then(response => {
                    if(response.data.success == true){
                        this.success = true;
                        this.error = {};
                    }
                    else{
                        this.success = false;
                        this.error = response.data;
                    }
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    console.log(error.response.data);
                    this.success = false;
                });
        },
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        }
    },
};
</script>

<style scoped>
.error {
    color: red;
    display: block;
}
.success {
    color: green;
    padding: 20px;
    background-color:rgba(0,255,0,0.3);
    text-align: center;
    z-index: 2;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
.errorInput {
    border-color: red;
}
</style>
