<template>
    <div class="api-calling">
        <div class="error" v-if="errors.length">
           <span v-for="err in errors">
               <span v-for="msg in err">
                   {{ msg }}
               </span>
           </span>
            <hr>
        </div>

        <div class="create-form">
            <div class="product-name-input">
                <input type="text" v-model="product.name">
            </div>
            <div class="product-name-input">
                <input type="text" v-model.number="product.price">
            </div>
            <div class="button-create">
                <button @click="createProduct">Create</button>
            </div>
        </div>

        <hr>
        <div class="list-products">
            <h2>LIST PRODUCT</h2>
            <div class="product-table">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Date created</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products">
                        <td>{{ product.id }}</td>
                        <td v-if="!product.isEdit">{{ product.name }}</td>
                        <td v-else>
                            <input type="text" class="form-control" v-model="product.name">
                        </td>
                        <td v-if="!product.isEdit">{{ product.price }}</td>
                        <td v-else>
                            <input type="text" class="form-control" v-model.number="product.price">
                        </td>
                        <td>{{ product.created_at }}</td>
                        <td v-if="!product.isEdit">
                            <button class="btn btn-success" @click="product.isEdit = true">Edit</button>
                            <button class="btn btn-danger" @click="deleteProduct(product, index)">Delete</button>
                        </td>
                        <td v-else>
                            <button class="btn btn-primary" @click="updateProduct(product)">Save</button>
                            <button class="btn btn-danger" @click="product.isEdit = false">Cancel</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        data() {
            return {
                product: {
                    name: '',
                    price: 0
                },
                errors: [],
                products: []
            }
        },
        created() {
            this.getListProducts();
        },
        methods: {
            createProduct() {
                axios.post('/products', {name: this.product.name, price: this.product.price})
                    .then(response => {
                        console.log(response.data.result);

                        this.products.push({
                            id: this.products.length + 1,
                            name: this.product.name,
                            price: this.product.price,
                            created_at: moment().format('YYYY/MM/DD'),
                            isEdit: false
                        });
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.name) {
                            this.errors.push(error.response.data.name);
                        }
                        if (error.response.data.price) {
                            this.errors.push(error.response.data.price);
                        }
                    });
            },
            getListProducts() {
                axios.get('/products')
                    .then(response => {
                        this.products = response.data;
                        this.products.forEach(item => {
                            Vue.set(item, 'isEdit', false);
                            Vue.set(item, 'created_at', moment(item.created_at).format('YYYY/MM/DD'));
                        });
                    })
                    .catch(error => {
                        console.log(error.message);
                    })
            },
            updateProduct(product) {
                axios.put('/products/' + product.id, {name: product.name, price: product.price})
                    .then(response => {
                        console.log(response.data.result);
                        product.isEdit = false;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name;
                    });
            },
            deleteProduct(product, index) {
                axios.delete('/products/' + product.id)
                    .then(response => {
                        console.log(response.data.result);
                        this.products.splice(index, 1);
                    })
                    .catch(error => {
                        this.errors = error.response.data.name;
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .error {
        span {
            color: red;
        }
    }
</style>