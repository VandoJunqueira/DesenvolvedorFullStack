import axios from 'axios';
import router from '../router'
// import { setItem } from '@/utility/localStorageControl'
import store from './vuex/store';
// import Cookies from 'js-cookie';


const client = axios.create({
    baseURL: '/api',
    withCredentials: true
});

client.interceptors.request.use(config => {
    const token = localStorage.getItem('token'); // Você pode armazenar o token no local storage
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});


client.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {

            store.dispatch("logOut");

            router.push('/login');
            return;
        }
        if (error.response.status === 403) {
            return;
        }
        if (error.response.status === 404) {
            router.push('/404');
            return;
        }

        return Promise.reject(error);
    }
);


class DataService {
    static get(path = '') {
        return client({
            method: 'GET',
            url: path,
        });
    }

    static post(path = '', data = {}, optionalHeader = {}) {
        return client({
            method: 'POST',
            url: path,
            data,
            headers: { ...optionalHeader },
        });
    }

    static client() {
        return client;
    }

    static patch(path = '', data = {}) {
        return client({
            method: 'PATCH',
            url: path,
            data: JSON.stringify(data),
        });
    }

    static delete(path = '', data = {}) {
        data._method = 'DELETE';
        return this.post(path, data);
        /* return client({
          method: 'DELETE',
          url: path,
          data: JSON.stringify(data),
        }); */
    }

    static put(path = '', data = {}) {
        //data._method = 'PUT';
        return client({
            method: 'PUT',
            url: path,
            data: JSON.stringify(data),
        });
    }

    static update(path = '', data = {}) {
        data._method = 'PUT';
        return this.post(path, data);
    }
}


export { DataService };
