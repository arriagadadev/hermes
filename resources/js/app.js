/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueNotification from "@kugatsu/vuenotification";

import Vuetify from 'vuetify';

import VueRouter from 'vue-router';

import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";

import 'leaflet/dist/leaflet.css';

import DashboardComponent from './components/Dashboard/DashboardComponent';
import DeviceComponent from './components/Devices/DeviceComponent';
import DeviceFormComponent from './components/Devices/DeviceFormComponent';
import DevicesComponent from './components/Devices/DevicesComponent';
import SlotsComponent from './components/Slots/SlotsComponent';
import SlotComponent from './components/Slots/SlotComponent';
import SlotFormComponent from './components/Slots/SlotFormComponent';
import MyAccountComponent from './components/Users/MyAccountComponent';

Vue.component('user-information', require('./components/Users/UserInformationComponent.vue').default);
Vue.component('change-password', require('./components/Users/ChangePasswordComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
//Leaflet components
Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-popup', LPopup);
Vue.component('l-tooltip', LTooltip);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var routes = [

	{
        path: '/',
        name: 'dashboard',
        component: DashboardComponent
    },
    {
        path: '/devices',
        name: 'devices',
        component: DevicesComponent
    },
    {
        path: '/devices/new-device',
        name: 'new-device',
        component: DeviceFormComponent
    },
    {
        path: '/device/:device',
        name: 'device',
        component: DeviceComponent
    },
    {
        path: '/device/:device/edit',
        name: 'edit-device',
        component: DeviceFormComponent
    },
    {
        path: '/device/:device/slots',
        name: 'slots',
        component: SlotsComponent
    },
    {
      path: '/device/:device/slots/new-slot',
      name: 'new-slot',
      component: SlotFormComponent
    },
    {
      path: '/device/:device/slot/:slot',
      name: 'slot',
      component: SlotComponent
    },
    {
      path: '/device/:device/slot/:slot/edit',
      name: 'edit-slot',
      component: SlotFormComponent
    },
    {
      path: '/my-account',
      name: 'my-account',
      component: MyAccountComponent
    }

];

const router = new VueRouter({
  routes // short for `routes: routes`
});
Vue.prototype.$organization = window.__ORGANIZATION__;
Vue.prototype.$handleRequestError = error => {
	if (error.response) {
	  // The request was made and the server responded with a status code
	  // that falls out of the range of 2xx
	  if(error.response.status == 422 && error.response.data.errors){
	    //The form contains errors
	    Vue.prototype.$notification.warning(Object.values(error.response.data.errors)[0][0], {timer: 3});
	  }else{
	    if(error.response.status == 401 && error.response.data.message == "Unauthenticated."){
	    	//The session expired
	        Vue.prototype.$notification.error("Your session expired", {timer: 3});
	        setTimeout(function(){window.location.href = '/login';},3000);
	    }else{
	        Vue.prototype.$notification.error("Unexpected error", {timer: 3});
	    }
	  }
	} else if (error.request) {
	  // The request was made but no response was received
	  console.log(error.request);
	  Vue.prototype.$notification.error("Unexpected error", {timer: 3});
	}
};

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VueNotification, {
  timer: 20
});
const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({icons: {iconfont: 'md'}}),
    router
});
