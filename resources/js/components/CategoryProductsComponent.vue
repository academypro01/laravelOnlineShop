<template>
    <div>

        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="category.html">{{category.name}}</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <div id="content" class="col-sm-12">
                <h1 class="title">{{category.name}}</h1>


                <div class="product-filter">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="btn-group">
                                <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                                <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                            </div>
                            <a href="" id="compare-total"></a> </div>
                        <div class="col-sm-2 text-right">
                            <label class="control-label" for="input-sort">مرتب سازی :</label>
                        </div>
                        <div class="col-md-3 col-sm-2 text-right">
                            <select id="input-sort" class="form-control col-sm-3" @change="sortMethod">
                                <option value="ASC">قیمت (کم به زیاد)</option>
                                <option value="DESC">قیمت (زیاد به کم)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row products-category">
                    <div class="product-layout product-list col-xs-12" v-for="product in products">
                        <div class="product-thumb" >
                            <div class="image">
                                <a :href="'/product/'+product.slug">
                                    <img :src="host+'/'+product.photos[0].path" :alt="product.title" :title="product.title" class="img-responsive" />
                                </a>
                            </div>
                            <div>
                                <div class="caption">
                                    <h4><a :href="'/product/'+product.slug"> {{product.title}} </a></h4>
                                    <p class="price" v-if="product.discount_price != null"> <span class="price-new">{{product.discount_price}} تومان</span> <span class="price-old">{{product.price}} تومان</span> <span class="saving">-{{ Math.round( (((product.price - product.discount_price)) * 100) / product.price ) }}%</span> </p>
                                    <p class="price" v-if="product.discount_price == null"><span class="price-new">{{product.discount_price}}</span></p>
                                </div>
                                <div class="button-group">
                                    <a :href="'/add-to-cart/'+product.id" class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <template>

                        <paginate

                            :page-count="lastPage"
                            :page-range="3"
                            :margin-pages="2"
                            :click-handler="clickCallback"
                            :prev-text="'قبلی'"
                            :next-text="'بعدی'"
                            :container-class="'pagination'"
                            :page-class="'page-item'">
                        </paginate>
                    </template>
                </div>



            </div>
            <!--Middle Part End -->
        </div>

    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    export default {
        name: "CategoryProductsComponent",
        data(){
          return {
              products: [],
              host: window.location.origin,
              lastPage : 0,
              currentPage : 1
          }
        },
        props: ['category'],
        mounted() {
            this.getProducts();
        },
        components: {
          Paginate
        },
        methods: {
            getProducts() {
                axios.get('/api/categories/'+this.category.id).then(
                    res=> {
                        this.products = (res.data.products.data);
                        this.lastPage = res.data.products.last_page;
                    }).catch(
                        error=> {
                            console.log(error);
                        }
                );
            },
            clickCallback(pageNum) {
                this.products = [];
                this.currentPage = pageNum;
                axios.get('/api/categories/'+this.category.id+'?page='+pageNum).then(
                    res=> {
                        this.products = (res.data.products.data);
                    }
                ).catch(
                    error=> {
                        console.log(error);
                    }
                )
            },
            sortMethod(event) {
                this.products = [];
                axios.get('/api/categories/sort/'+this.category.id+'/'+event.target.value+'/?page='+this.currentPage).then(
                    res => {
                        this.products = res.data.products.data;
                    }
                ).catch(
                    error => {
                        console.log(error);
                    }
                )
            }
        }
    }
</script>

<style scoped>

</style>
