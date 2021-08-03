<template>
    <el-menu class="el-menu-vertical-demo" router unique-opened
             :default-active="this.$route.path"
             :collapse="isCollapse">
        <el-menu-item @click="changeMenu">
            <i class="el-icon-s-unfold menu-btn" v-show="isCollapse"></i>
            <span slot="title" v-show="isCollapse">展开菜单</span>
            <i class="el-icon-s-fold menu-btn" v-show="!isCollapse"></i>
            <span v-show="!isCollapse">折叠菜单</span>
        </el-menu-item>

        <el-menu-item index="/home/controller">
            <i class="el-icon-s-data"></i>
            <span slot="title">控制台</span>
        </el-menu-item>

        <el-submenu v-for="(item,index) in routes"
                    v-if="!item.hidden" :index="index+''" :key="index">
            <template slot="title">
                <i :class="item.icon"></i>
                <span>{{item.name}}</span>
            </template>
            <el-menu-item v-for="(child,indexj) in item.children" :index="child.path" :key="indexj">
                {{child.name}}
            </el-menu-item>
        </el-submenu>
    </el-menu>
</template>

<script>
    export default {
        name: "index",
        data(){
            return {
                isCollapse:false
            }
        },
        computed:{
            routes(){
                return this.$router.options.routes
            }
        },
        methods:{
            changeMenu(){
                this.isCollapse = !this.isCollapse
            }
        }
    }
</script>

<style scoped lang="less">
    .el-menu-vertical-demo{
        height: 100vh;
    }

    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }

    .space-block{
        height: 50px;
    }
</style>
