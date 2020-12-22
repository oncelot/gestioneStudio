import axios from 'axios'

let baseApi = axios.create({
    baseURL:'http://localhost:8000'
});

const Api = function(){

    let token = localStorage.getItem('toke');
    if(token){
        baseApi.defaults.headers.common['Authorization'] = 'Bearer ${token}'

    }
    return baseApi;
}
export default Api