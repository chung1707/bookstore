<template>
    <div class="form-group row">
        <div class="col">
            <select
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
            <select
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
            <select class="form-control" name="ward_id" v-model="ward_id">
                <option value="null">Vui lòng chọn địa điểm</option>
                <option v-for="ward in wards" :key="ward.id" :value="ward.id">
                    {{ ward.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        user: {
            type: Object
        }
    },

    data() {
        return {
            provinces: [],
            districts: [],
            wards: [],
            province_id: null,
            district_id: null,
            ward_id: null
        };
    },

    methods: {
        getProvinces() {
            axios.get("/api/location/provinces").then(response => {
                this.provinces = response.data;
            });
        },
        getDistricts() {
            axios
                .get(
                    "/api/location/province/" + this.province_id + "/districts"
                )
                .then(response => {
                    this.districts = response.data;
                });
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
                });
        }
    },
    watch: {
        province_id() {
            this.getDistricts();
        },
        district_id() {
            this.getWards();
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

<style></style>
