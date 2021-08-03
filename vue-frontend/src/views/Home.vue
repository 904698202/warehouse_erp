<template>
  <div>
    <el-container>
        <Menu></Menu>
      <el-container>
        <el-header class="home-header">
          <home-header></home-header>
        </el-header>
        <el-main>
          <el-breadcrumb class="crumb" separator-class="el-icon-arrow-right"
                         v-if="this.$router.currentRoute.path !== '/home/controller'">
            <el-breadcrumb-item :to="{ path: '/home/controller' }">首页</el-breadcrumb-item>
            <el-breadcrumb-item>{{this.$router.currentRoute.name}}</el-breadcrumb-item>
          </el-breadcrumb>
          <el-divider v-if="this.$router.currentRoute.path !== '/home/controller'"></el-divider>
          <keep-alive>
            <router-view></router-view>
          </keep-alive>
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
    components: {
      Menu,
      HomeHeader
    }
  }
</script>

<style lang="less">
  .home-header {
    background: #2f0b8e;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    box-sizing: border-box;
    width: 100%;
  }


  .crumb {
    margin-bottom: 20px;
  }
</style>
