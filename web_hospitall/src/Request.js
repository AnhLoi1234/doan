const axios = require('axios');
const Apiurl = 'http://127.0.0.1:8000/api';

export default {
    AdminGetHeader(){
        let token = window.localStorage.getItem('admin');
        return {Authorization:'Bearer ' + token }
    },
    Get(url) {
        return axios.get(
            Apiurl+url,
            {headers: this.AdminGetHeader()})
    },
    Post(url, data){
        return axios.post(
            Apiurl+url,data,
            {headers: this.AdminGetHeader()}) 
    },
    login(url,data){
        return axios.post(
            Apiurl+url,data,
        ) 
    },
}