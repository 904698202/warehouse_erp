<template>
    <el-menu class="el-menu-vertical-demo" router unique-opened
             :default-active="this.$route.path">
        <el-menu-item index="/home/controller">
            <i class="el-icon-s-data"></i>
            <span slot="title">控制台</span>
        </el-menu-item>

        <el-submenu v-for="(item,index) in routes"
                    v-if="!item.hidden" :index="index+''">
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
        computed:{
            routes(){
                return this.$router.options.routes
            }
        }
    }
</script>

<style scoped>

</style>
