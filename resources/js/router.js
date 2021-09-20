import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './../js/pages/Home';
import About from './../js/pages/About';
import Post from './../js/pages/post';
import Contact from './../js/pages/Contact';
import Details from './../js/pages/Details';

const router = new VueRouter({
    mode: "history",
    routes:[
        {
            path:'/',
            name:'home',
            component: Home
        },
        {
            path:'/chi-siamo',
            name:'About',
            component: About
        },
        {
            path:'/posts',
            name:'Post',
            component: Post
        },
        {
            path:'/contatti',
            name:'contact',
            component: Contact
        },
        {
            path:'/posts/:slug',
            name:'details',
            component: Details
        }
    ]
});

export default router;