<template>
    <div class="card-body">
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Sửa đổi thông tin thành công
        </h5>
        <span class="error" v-if="error.name">{{ error.name[0] }}</span>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px">
                    <i class="fas fa-user-tie"></i>
                    &emsp;Họ tên</span
                >
            </div>
            <input
                type="text"
                class="form-control"
                placeholder="Họ tên"
                v-model="user.name"
            />
        </div>
        <span class="error" v-if="error.phone">{{ error.phone[0] }}</span>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px">
                    <i class="fas fa-phone"></i>
                    &emsp;Số điện thoại</span
                >
            </div>
            <input
                type="text"
                class="form-control"
                placeholder="Số điện thoại"
                v-model="user.phone"
            />
        </div>
        <span class="error" v-if="error.email">{{ error.email[0] }}</span>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px"
                    ><i class="fas fa-envelope"></i>&emsp;Email</span
                >
            </div>
            <input type="email" class="form-control" v-model="user.email" />
        </div>
        <span class="error" v-if="error.address">{{ error.address[0] }}</span>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" style="width: 150px"
                    ><i class="fas fa-map-marked"></i>&emsp;Địa chỉ</span
                >
            </div>
            <input
                type="text"
                class="form-control"
                placeholder="Địa chỉ"
                v-model="user.address"
            />
        </div>
        <div class="form-group row">
            <div class="col">
                <span class="error" v-if="error.province_id">{{
                    error.province_id[0]
                }}</span>
                <select
                    :class="{ errorInput: error.province_id }"
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
                <span class="error" v-if="error.district_id">{{
                    error.district_id[0]
                }}</span>
                <select
                    :class="{ errorInput: error.district_id }"
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
                <span class="error" v-if="error.ward_id">{{
                    error.ward_id[0]
                }}</span>
                <select
                    class="form-control"
                    name="ward_id"
                    v-model="ward_id"
                    :class="{ errorInput: error.ward_id }"
                >
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
        <button  @click.prevent="updateInfos()" class="btn btn-info">Cập nhập thông tin</button>
    </div>
</template>

<script>
import axios from "axios";
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
            success: false
        };
    },

    props: {
        user: {
            type: Object
        }
    },
    methods: {
        updateInfos(){
            var formData = new FormData();
            formData.append("name", this.user.name);
            formData.append("email", this.user.email);
            formData.append("province_id", this.province_id);
            formData.append("district_id", this.district_id);
            formData.append("ward_id", this.ward_id);
            formData.append("address", this.user.address);
            formData.append("phone", this.user.phone);
            axios
                .post("change_infos", formData)
                .then(() => {
                    this.success = true;
                    this.error = {};
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
                });
            console.log('');
        },
        getProvinces() {
            axios
                .get("/api/location/provinces")
                .then(response => {
                    this.provinces = response.data;
                })
                .catch(() => {});
        },
        getDistricts() {
            axios
                .get(
                    "/api/location/province/" + this.province_id + "/districts"
                )
                .then(response => {
                    this.districts = response.data;
                })
                .catch(error => {});
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
                })
                .catch(error => {});
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
            setTimeout(() => (this.success = false), 1500);
        }
    },
    mounted() {
        if (this.user) {
            this.province_id = this.user.province_id;
            this.district_id = this.user.district_id;
            this.ward_id = this.user.ward_id;
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
    background-color: rgba(0, 255, 0, 0.3);
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
