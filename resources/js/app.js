/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dropzone-uploader', require('./components/dropZoneImgUploader.vue').default);
Vue.component('location-select', require('./components/location_select.vue').default);
//cart
Vue.component('add-to-cart', require('./components/cart/addToCart.vue').default);
Vue.component('add-to-cart-details', require('./components/cart/addToCartDetails.vue').default);
Vue.component('cart-icon', require('./components/cart/cartIcon.vue').default);
Vue.component('product-list', require('./components/cart/productList.vue').default);
///checkout
Vue.component('chekout-component', require('./components/checkout/checkout.vue').default);
//user-profile
Vue.component('user-icon', require('./components/user/userIcon.vue').default);
Vue.component('update-infos', require('./components/user/updateInfos.vue').default);
Vue.component('change-password', require('./components/user/changePassword.vue').default);

//header
Vue.component('products-menu', require('./components/header/productsMenu.vue').default);
Vue.component('categories-menu', require('./components/header/categoriesMenu.vue').default);

// ADMIN
Vue.component('admin-icon', require('./components/admin/adminIcon.vue').default);
Vue.component('account-infos', require('./components/admin/infos.vue').default);
Vue.component('admin-change-password', require('./components/admin/changePassword.vue').default);

Vue.component('admin-accounts', require('./components/admin/user_management/admin_accounts.vue').default);
Vue.component('user-accounts', require('./components/admin/user_management/user_accounts.vue').default);



import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import storeConfig from './store';

const store = new Vuex.Store(storeConfig);
Vue.config.productionTip = false;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',store,
});
