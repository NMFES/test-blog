
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
//
//const app = new Vue({
//    el: '#app'
//});

import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './App.vue';

// routes
import PostIndex from './post/index.vue';
import PostShow from './post/show.vue';
import ContactIndex from './contact/index.vue';
import ContactForm from './contact/form.vue';
import CommentIndex from './comment/index.vue';
import CommentForm from './comment/form.vue';

Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    template: '<app></app>',
    components: {App},
    router: new VueRouter({
        mode: 'history',
        routes: [
            {path: '/', component: PostIndex},
            {path: '/contacts', component: ContactIndex},
            {path: '/comments', component: CommentIndex},
            {path: '/:slug([a-z0-9\-]+)?', component: PostShow},
//            {path: '/register'},
//            {path: '/login'},
//            {path: '/not-found'},
//            {path: '*'}
        ]
    })
});


