import Vue from 'vue'
import VueRouter from 'vue-router'
import {Message} from "element-ui"

const Login = () => import('../views/Login')
const Home = () => import('../views/Home')
const Controller = () => import('../views/Chart')
const User = () => import('../views/user')
const Product = () => import('../views/product')
const Category = () => import('../views/category')
const Storage = () => import('../views/storage')
const Location = () => import('../views/location')
const Shelve = () => import('../views/shelve')
const Customer = () => import('../views/customer')

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    component:Login,
    hidden: true
  },
  {
    path: '/home',
    name:'主页',
    component:Home,
    children:[
      {
        path: '/home/controller',
        name: '控制台',
        component:Controller
      }
    ],
    hidden: true
  },
  {
    path: '/user',
    name: '用户管理',
    component:Home,
    icon:'el-icon-s-tools',
    children: [
      {
        path: '/user/info',
        name: '用户信息',
        component:User
      }
    ]
  },
  {
    path: '/product',
    name: '产品管理',
    component:Home,
    icon: 'el-icon-menu',
    children: [
      {
        path: '/product/info',
        name: '产品信息',
        component:Product
      },
      {
        path: '/category/info',
        name: '类别信息',
        component:Category
      }
    ]
  },
  {
    path: '/storage',
    name: '仓库管理',
    component:Home,
    icon: 'el-icon-s-home',
    children: [
      {
      path: '/storage/info',
      name: '仓库信息',
      component:Storage
      },
      {
        path: '/location/info',
        name: '库位信息',
        component:Location
      },
      {
        path: '/shelve/info',
        name: '货架信息',
        component:Shelve
      }
    ]
  },
  {
    path: '/customer',
    name: '顾客管理',
    component:Home,
    icon: 'el-icon-s-custom',
    children: [
      {
        path: '/customer/info',
        name:'顾客信息',
        component:Customer
      }
    ]
  }
]

const router = new VueRouter({
  routes,
  mode:"history"
})

router.beforeEach((to, from, next) => {
  // 以token值来判断是否登录
  if (window.sessionStorage.getItem('tokenStr')) {
    // 重定向到首页
    if (to.path === '/' || to.path === '' || to.path === '/login') {
      document.title = '仓库管理系统'
      next('/home/controller')
    } else {
      document.title = '仓库管理系统'
      next()
    }
  } else {
    if (to.path === '/login') {
      document.title = '仓库管理系统'
      next()
    } else {
      // 未登录时默认跳转到登录页面
      document.title = '仓库管理系统'
      next('/login')
      Message("欢迎使用仓库管理系统，请先进行登录")
    }
  }
})

export default router
