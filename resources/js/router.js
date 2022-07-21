import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import home from './components/Homecomponent';
import about from './components/Aboutcomponent';
import service from './components/Servicecomponent';

const routers =[
    {path: '/' , component:home},
    {path: '/about' , component:about},
    {path: '/service' , component:service}    
];

export default new VueRouter({
    routers
});