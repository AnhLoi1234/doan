const axios = require('axios');
const Apiurl = 'http://localhost:8000/api';

export default {
    GetHeader(m_auth) {
        let token = window.localStorage.getItem(m_auth);
        return { Authorization: 'Bearer ' + token }
    },
    Get(url) {
        return axios.get(
            Apiurl + url,
            { headers: this.GetHeader() })
    },
    Post(url, data) {
        return axios.post(
            Apiurl + url, data,
            { headers: this.GetHeader() })
    },
    Put(url, data) {
        return axios.put(
            Apiurl + url, data,
            { headers: this.GetHeader() })
    },
    Delete(url) {
        return axios.delete(
            Apiurl + url,
            { headers: this.GetHeader() })
    },
    login(url, data) {
        return axios.post(
            Apiurl + url, data,
        )
    },
    GetAuth(url, authTK) {
        return axios.get(
            Apiurl + url,
            { headers: this.GetHeader(authTK) })
    },
}