<template>
    <div>
    <div>
        <div class="form-group">
            <label >دسته بندی</label>
            <div class="col-sm-10">
                <select name="category_id[]" id="" class="form-control" multiple v-model="selectedCategories" @change="changeCategory">
                    <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label >برندها</label>
            <div class="col-sm-10">
                <select name="brand_id" id="" class="form-control">
                    <option v-for="brand in brands" :value="brand.id">{{brand.title}}</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="selected_attributes[]" v-model="computedAttribute">
        <div v-if="flag">
            <div class="form-group" v-for="(attribute, index) in attributes">
                <label>{{attribute.title}}</label>
                <div class="col-sm-10">
                <select class="form-control" @change="addSelectedAttributes($event, index)">
                    <option>انتخاب کنید</option>
                    <option v-for="attributeValue in attribute.attributes_value" :value="attributeValue.id">{{attributeValue.title}}</option>
                </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label >وضعیت انتشار</label>
            <div class="col-sm-10">
                <select name="status" id="" class="form-control">
                    <option value="0">عدم انتشار</option>
                    <option value="1"> انتشار</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">قیمت محصول</label>

            <div class="col-sm-10">
                <input type="number" name="price" class="form-control" id="inputEmail3" placeholder="قیمت محصول را وارد کنید ">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">قیمت ویژه محصول</label>

            <div class="col-sm-10">
                <input type="number" name="discount_price" class="form-control" id="inputEmail3" placeholder="قیمت ویژه محصول را وارد کنید ">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">توضیحات </label>

            <div class="col-sm-10">
                <textarea name="description" id="editor" class="ckeditor form-control" cols="30" placeholder="توضیحات محصول را وارد کنید" rows="10"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">عنوان سئو</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="meta_title" id="inputPassword3" placeholder="عنوان متا را وارد کنید">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">توضیحات سئو </label>

            <div class="col-sm-10">
                <textarea name="meta_desc" id="" class="form-control" cols="30" placeholder="توضیحات متا را وارد کنید" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">کلمات کلیدی سئو</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="meta_keywords" id="inputPassword3" placeholder="کلمات کلیدی متا را وارد کنید">
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    </div>
</template>

<script>
    export default {
        name: "AttributeComponent",
        data() {
            return {
                categories: [],
                selectedCategories: [],
                attributes: [],
                flag: false,
                selectedAttributes: [],
                computedAttribute : []
            }
        },
        props: ['brands'],
        mounted() {
            axios.get('/administrator/api/categories').then(
                res => {
                    this.getAllChildren(res.data.categories, 0);
                    // this.categories = res.data.categories;
                }).catch(err => {
                console.log(err)
            })
        },
        methods: {
            getAllChildren(currentValue, level) {
                for(let i=0; i< currentValue.length; i++) {
                    let current = currentValue[i];
                    this.categories.push({
                        id: current.id,
                        name: Array(level + 1).join('---')+" "+current.name
                    })
                    if(current.children_recursive && current.children_recursive.length > 0) {
                        this.getAllChildren(current.children_recursive, level + 1);
                    }
                }
            },
            changeCategory() {
                this.flag = false;
              axios.post('/administrator/api/attributes', this.selectedCategories).then(
                  res=> {
                      this.attributes = res.data.attributes;
                      this.flag = true;
                  }).catch(err=> {
                      console.log(err);
                      this.flag = false;
              });
            },
            addSelectedAttributes(event, index) {
                for(var i=0; i<this.selectedAttributes.length; i++) {
                    var current = this.selectedAttributes[i];
                    if(current.index == index) {
                        this.selectedAttributes.splice(i, 1);
                    }
                }
                this.selectedAttributes.push({
                    'index': index,
                    'value': event.target.value
                })
                this.computedAttribute = [];
                for(var i=0; i<this.selectedAttributes.length; i++) {
                    this.computedAttribute.push(this.selectedAttributes[i].value);
                }

            }
        }
    }
</script>

<style scoped>

</style>
