import axios from "axios";
import { Message } from "element-ui";
import router from "../router";

// 请求拦截器
axios.interceptors.request.use(config => {
    // 如果存在token，之后的请求携带此token
    if(window.sessionStorage.getItem('tokenStr')){
        config.headers['token'] = window.sessionStorage.getItem('tokenStr')
    }
    return config;
},error => {
    console.log(error);
})

// 响应拦截器
axios.interceptors.response.use(success => {
    // 业务逻辑错误
    if (success.status && success.status === 200) {
        if (success.data.code === 0){
            Message.error({message:success.data.msg})
            return;
        }
        if (success.data.code === 1){
            if (success.data.msg) {
                Message.success({message:success.data.msg})
            }
        }
    }
    return success.data;
},error => {
    if (error.response.code === 504||error.response.code === 404){
        Message.error({message:'服务器被吃了！'})
    } else if (error.response.code === 403) {
        Message.error({message:'权限不足，请联系管理员！'})
    } else if (error.response.code === 401) {
        Message.error({message:'尚未登录，请登录！'})
        router.replace('/login')
    } else {
        if (error.response.data.msg) {
            Message.error({message:error.response.data.msg})
        } else {
            Message.error({message:'未知错误'})
        }
    }
});

let baseUrl = '/api';

/**
 * 发送get请求
 * @param url
 * @param params
 * @returns
 */
export const getRequest = (url,params) => {
    return axios({
        method:'get',
        url:`${baseUrl}${url}`,
        data: params
    })
}

/**
 * 发送post请求
 * @param url
 * @param params
 * @returns
 */
export const postRequest = (url,params) => {
    return axios({
        method:'post',
        url:`${baseUrl}${url}`,
        data: params
    })
}

/**
 * 发送put请求
 * @param url
 * @param params
 * @returns
 */
export const putRequest = (url,params) => {
    return axios({
        method:'put',
        url:`${baseUrl}${url}`,
        data: params
    })
}

/**
 * 发送delete请求
 * @param url
 * @param params
 * @returns
 */
export const deleteRequest = (url,params) => {
    return axios({
        method:'delete',
        url:`${baseUrl}${url}`,
        data: params
    })
}
