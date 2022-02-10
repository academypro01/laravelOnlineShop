<template>
    <div>
        <div class="form-group required">
            <label class="col-sm-2 control-label">استان</label>
            <div class="col-sm-10">
                <select class="form-control" name="province_id" @change="getCities">
                    <option value="">استان را انتخاب کنید...</option>
                    <option v-for="province in provinces" :value="province.id">{{province.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group required" v-if="flag">
            <label class="col-sm-2 control-label">شهر</label>
            <div class="col-sm-10">
                <select class="form-control" name="city_id">
                    <option value="">شهر خود را انتخاب کنید...</option>
                    <option v-for="city in cities" :value="city.id">{{city.name}}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddressComponent",
        data() {
            return {
                provinces: [],
                cities : [],
                flag: false
            }
        },
        mounted() {
            this.getProvinces();
        },
        methods: {
            getProvinces() {
                axios.get('/api/provinces').then(
                    res=> {
                        this.provinces = res.data.provinces;
                    }).catch(
                        err=> {
                            console.log(err);
                        }
                )
            },
            getCities(event) {
                let city_id = event.target.value;
                if(city_id != "") {
                    axios.get('/api/cities/'+city_id).then(
                        res=> {
                            this.cities = res.data.cities;
                        }).catch(
                        err=> {
                            console.log(err);
                        }
                    );
                    this.flag = true;
                }else{
                    this.flag = false;
                }

            }
        }
    }
</script>

<style scoped>

</style>
