import Vue from 'vue'
//moment js
import moment from 'moment';
Vue.filter('timeFormat',(arg)=>{
    return moment(arg).format('MMMM Do YYYY');
});

Vue.filter('sortlength',function (text,length,suffix) {
    return text.substring(0,length)+suffix;
})
