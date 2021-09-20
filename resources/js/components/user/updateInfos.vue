<template>
    <div>
        <h5 class="success" v-if="success"> <i class="fas fa-check"></i> Sửa đổi thông tin thành công </h5>
        <span class="error" v-if="error.name">{{ error.name[0] }}</span>
        <label>Họ tên</label>
        <input
            :class="{errorInput: error.name}"
            type="text"
            class="form-control"
            required=""
            name="name"
            v-model="authUser.name"
        />
       <span class="error" v-if="error.email">{{ error.email[0] }}</span>
        <label>Email</label>
        <input
            :class="{errorInput: error.email}"
            type="text"
            class="form-control"
            required=""
            name="email"
            v-model="authUser.email"
        />
        <span class="error" v-if="error.phone">{{ error.phone[0] }}</span>
        <label>Số điện thoại</label>
        <input
            :class="{errorInput: error.phone}"
            type="text"
            class="form-control"
            required=""
            name="phone"
            v-model="authUser.phone"
        />
        <label>Địa chỉ</label>
        <div class="form-group row">
            <div class="col">
                <span class="error" v-if="error.province_id">{{ error.province_id[0] }}</span>
                <select
                    :class="{errorInput: error.province_id}"
                    class="form-control"
                    name="province_id"
                    v-model="province_id"
                >
                    <option value="null">Vui lòng chọn địa điểm</option>
                    <option
                        v-for="province in provinces"
                        :key="province.id"
                        :value="province.id"
                    >
                        {{ province.name }}
                    </option>
                </select>
            </div>
            <div class="col">
                <span class="error" v-if="error.district_id">{{ error.district_id[0] }}</span>
                <select
                    :class="{errorInput: error.district_id}"
                    class="form-control"
                    name="district_id"
                    v-model="district_id"
                >
                    <option value="null">Vui lòng chọn địa điểm</option>
                    <option
                        v-for="district in districts"
                        :key="district.id"
                        :value="district.id"
                    >
                        {{ district.name }}
                    </option>
                </select>
            </div>
            <div class="col">
                <span class="error" v-if="error.ward_id">{{ error.ward_id[0] }}</span>
                <select class="form-control" name="ward_id" v-model="ward_id" :class="{errorInput: error.ward_id}" >
                    <option value="null">Vui lòng chọn địa điểm</option>
                    <option
                        v-for="ward in wards"
                        :key="ward.id"
                        :value="ward.id"
                    >
                        {{ ward.name }}
                    </option>
                </select>
            </div>
        </div>
        <span class="error" v-if="error.address">{{ error.address[0] }}</span>
        <label>Địa chỉ nhận hàng chi tiết</label>
        <input
            :class="{errorInput: error.address}"
            type="text"
            class="form-control"
            required=""
            name="address"
            v-model="authUser.address"
        />
        <button @click.prevent="update" class="btn btn-outline-primary-2">
            <span>Lưu thay đổi</span>
        </button>
    </div>
</template>

<script>
import axios from "axios";
import {mapGetters} from "vuex";
export default {
    data() {
        return {
            provinces: [],
            districts: [],
            wards: [],
            province_id: null,
            district_id: null,
            ward_id: null,
            error: {},
            success: false,
        };
    },
    computed: {
        ...mapGetters(['authUser']),
    },
    methods: {
        update() {
            var formData = new FormData();
            formData.append("name", this.authUser.name);
            formData.append("email", this.authUser.email);
            formData.append("province_id", this.province_id);
            formData.append("district_id", this.district_id);
            formData.append("ward_id", this.ward_id);
            formData.append("address", this.authUser.address);
            formData.append("phone", this.authUser.phone);
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
        getProvinces() {
            axios.get("/api/location/provinces").then(response => {
                this.provinces = response.data;
            }).catch(() => {});
        },
        getDistricts() {
            axios
                .get(
                    "/api/location/province/" + this.province_id + "/districts"
                )
                .then(response => {
                    this.districts = response.data;
                }).catch(error => {});
        },
        getWards() {
            axios
                .get(
                    "/api/location/province/district/" +
                        this.district_id +
                        "/wards"
                )
                .then(response => {
                    this.wards = response.data;
                }).catch(error => {});
        }
    },
    watch: {
        province_id() {
            this.getDistricts();
        },
        district_id() {
            this.getWards();
        },
        success() {
            setTimeout(() => this.success = false, 1500);
        }
    },
    mounted() {
        if (this.authUser) {
            this.province_id = this.authUser.province_id;
            this.district_id = this.authUser.district_id;
            this.ward_id = this.authUser.ward_id;
        }
        this.getProvinces();
        this.getDistricts();
        this.getWards();
    }
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
