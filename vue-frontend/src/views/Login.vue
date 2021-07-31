<template>
    <div>
        <el-form ref="loginForm" :model="loginForm" class="loginContainer" :rules="loginFormRules"
                 v-loading="loading" element-loading-text="正在登录。。。">
            <h3 class="loginTitle">系统登录</h3>
            <el-form-item prop="username">
                <el-input type="text" auto-complete="false" v-model="loginForm.username" placeholder="请输入用户名"></el-input>
            </el-form-item>
            <el-form-item prop="password">
                <el-input type="password" auto-complete="false" v-model="loginForm.password" placeholder="请输入密码"></el-input>
            </el-form-item>
<!--            <el-form-item prop="code">-->
<!--                <el-input type="text" class="loginCode" auto-complete="false" v-model="loginForm.code" placeholder="点击图片更换验证码"></el-input>-->
<!--                <img :src="captchaUrl">-->
<!--            </el-form-item>-->
            <el-checkbox v-model="checked" class="loginRemenber">记住我</el-checkbox>
            <el-button type="primary" @click="submitLogin('loginForm')" style="width: 100%">登录</el-button>
        </el-form>
    </div>
</template>

<script>

    export default {
        name: "Login",
        data(){
            return {
                captchaUrl:'',
                loading:false,
                loginForm: {
                    username: 'wuweihan',
                    password: '123456'
                },
                checked:false,
                loginFormRules:{
                    username: [
                        { required: true, message: '请输入用户名称', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur'}
                    ]
                    // ,
                    // code: [
                    //     {required: true, message: '请输入验证码', trigger: 'blur'}
                    // ]
                }
            }
        },
        methods:{
            submitLogin(loginForm){
                this.$refs[loginForm].validate((valid) => {
                    if(valid) {
                        this.loading = true
                        this.postRequest('/login/login/login',this.loginForm).then(res => {
                            if(res){
                                this.loading = false
                                if (res.code === 1){
                                    // 将用户token存到sessionStorage
                                    const tokenStr = res.data.token
                                    window.sessionStorage.setItem('tokenStr',tokenStr)
                                    const userinfo = res.data.userinfo
                                    window.sessionStorage.setItem('userinfo',JSON.stringify(userinfo))
                                    // 页面跳转
                                    this.$router.replace('/home/controller')
                                }
                            } else {
                                this.loading = false
                            }
                        })
                    } else {
                        this.$message.error('请填写完整表单信息')
                        return false
                    }
                })
            },

        }
    }
</script>

<style>
    .loginContainer{
        width: 350px;
        margin: 180px auto;
        padding: 15px 20px 25px;
        border-radius: 15px;
        background-clip: padding-box;
        border: 1px #c1b3b3 solid;
        background: #fff;
        box-shadow: 0 0 15px #bbbbbb;
    }

    .loginTitle{
        margin: 0 auto 20px auto;
        text-align: center;
    }

    .loginRemenber{
        margin-bottom: 20px;
    }

    /*.loginCode{*/
    /*    width: 250px;*/
    /*    margin-right: 5px;*/
    /*}*/
</style>
