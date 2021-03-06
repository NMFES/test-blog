
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
import AuthRegister from './auth/register.vue';
import AuthLogin from './auth/login.vue';
import NotFound from './helpers/not-found.vue';

Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    template: '<app></app>',
    components: {App},
    router: new VueRouter({
        mode: 'history',
        routes: [
            {path: '/', component: PostIndex},
            {path: '/post/:slug([a-z0-9\-]+)', component: PostShow},
            {path: '/search/:query(.+)', component: PostIndex},
            {path: '/contacts', component: ContactIndex},
            {path: '/comments', component: CommentIndex},
            {path: '/register', component: AuthRegister},
            {path: '/login', component: AuthLogin},
            {path: '/not-found', component: NotFound},
            {path: '*', component: NotFound}
        ]
    })
});
