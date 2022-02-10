<template>
    <div>
        <div class="form-group">
            <label>دسته بندی</label>
           <div class="col-sm-10">
               <select name="category_id[]" id="" class="form-control"  multiple="true" v-model="categories_selected" @change="onChange($event, null)">
                   <option v-for="category in categories" :value="category.id">{{category.name}}</option>
               </select>
           </div>
        </div>
        <div class="form-group">
            <label>برند</label>
            <div class="col-sm-10">
                <select name="brand_id" class="form-control">
                    <option v-for="brand in brands"  :selected="product.brand_id == brand.id" :value="brand.id">{{brand.title}}</option>
                </select>
            </div>
        </div>
        <div v-if="flag">
            <div class="form-group" v-for="(attribute, index) in attributes">
                <label>ویژگی {{attribute.title}}</label>
                <div class="col-sm-10">
                    <select class="form-control" @change="addAttribute($event, index)">
                        <option>انتخاب کنید...</option>
                        <option v-for="attributeValue in attribute.attributes_value" :value="attributeValue.id" :selected="product.attributes_value[index] && product.attributes_value[index]['id'] == attributeValue.id">{{attributeValue.title}}</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="selected_attributes[]" :value="computedAttribute">
        <div class="form-group">
            <label >وضعیت انتشار</label>
            <div class="col-sm-10">
                <select name="status" id="" class="form-control">
                    <option value="0" :selected="product.status == 0">عدم انتشار</option>
                    <option value="1" :selected="product.status == 1"> انتشار</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">قیمت محصول</label>

            <div class="col-sm-10">
                <input type="number" :value="product.price" name="price" class="form-control" id="inputEmail3" placeholder="قیمت محصول را وارد کنید ">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">قیمت ویژه محصول</label>

            <div class="col-sm-10">
                <input type="number" :value="product.discount_price" name="discount_price" class="form-control" id="inputEmail3" placeholder="قیمت ویژه محصول را وارد کنید ">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">توضیحات </label>

            <div class="col-sm-10">
                <textarea name="description" id="editor" class="ckeditor form-control" cols="30" placeholder="توضیحات محصول را وارد کنید" rows="10">{{product.description}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">عنوان سئو</label>

            <div class="col-sm-10">
                <input type="text" :value="product.meta_title" class="form-control" name="meta_title" id="inputPassword3" placeholder="عنوان متا را وارد کنید">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">توضیحات سئو </label>

            <div class="col-sm-10">
                <textarea name="meta_desc" id="" class="form-control" cols="30" placeholder="توضیحات متا را وارد کنید" rows="10">{{product.meta_description}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">کلمات کلیدی سئو</label>

            <div class="col-sm-10">
                <input type="text" :value="product.meta_keywords" class="form-control" name="meta_keywords" id="inputPassword3" placeholder="کلمات کلیدی متا را وارد کنید">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                categories_selected: [],
                flag: false,
                attributes:[],
                selectedAttribute: [],
                computedAttribute: []
            }
        },
        props: ['brands', 'product'],
        mounted() {
            axios.get('/administrator/api/categories').then(res =>{
                this.getAllChildren(res.data.categories, 0)
            }).catch(err=>{
                console.log (err)
            })
            if(this.product){
                for(var i=0; i<this.product.categories.length; i++){
                    this.categories_selected.push(this.product.categories[i].id)
                }
                for(var i=0; i<this.product.attributes_value.length; i++){
                    this.selectedAttribute.push({
                        'index': i,
                        'value': this.product.attributes_value[i].id
                    })
                    this.computedAttribute.push(this.product.attributes_value[i].id)
                }
                const load = 'ok'
                this.onChange(null, load);
            }
        },
        methods: {
            getAllChildren: function(currentValue, level){
                for(var i=0; i< currentValue.length; i++){
                    var current = currentValue[i];
                    this.categories.push({
                        id: current.id,
                        name: Array(level + 1).join("----") + " " + current.name
                    })
                    if(current.children_recursive && current.children_recursive.length > 0){
                        this.getAllChildren(current.children_recursive, level + 1)
                    }
                }
            },
            onChange: function(event, load){
                this.flag = false;
                axios.post('/administrator/api/attributes', this.categories_selected).then(res =>{
                    if(this.product && load == null){
                        this.computedAttribute = []
                        this.selectedAttribute = []
                    }
                    this.attributes = res.data.attributes
                    this.flag = true
                }).catch(err => {
                    console.log(err)
                    this.flag = false
                })

            },
            addAttribute: function(event, index){
                for(var i=0; i<this.selectedAttribute.length; i++){
                    var current = this.selectedAttribute[i];
                    if(current.index == index){
                        this.selectedAttribute.splice(i, 1)
                    }
                }
                this.selectedAttribute.push({
                    'index': index,
                    'value': event.target.value
                })
                this.computedAttribute = []
                for(var i=0; i<this.selectedAttribute.length; i++){
                    this.computedAttribute.push(this.selectedAttribute[i].value)
                }
            },
        }
    }
</script>
