<template>
    <div>
        <el-container>
            <el-header class="home-header">
                <home-header></home-header>
            </el-header>
        <el-container>
            <el-aside width="200px">
                <Menu></Menu>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
    </div>
</template>

<script>
    import Menu from '../components/menu/index'
    import HomeHeader from '../components/header/index'

    export default {
        name: "Home",
        data(){
          return {

          }
        },
        components:{
            Menu,
            HomeHeader
        }
    }
</script>

<style lang="less">
    .home-header {
        background: #409EFF;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 15px;
        box-sizing: border-box;
    }
</style>
