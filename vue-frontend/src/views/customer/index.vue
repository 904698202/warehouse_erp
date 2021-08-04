<template>
  <div>
<!--操作栏-->
    <action-bar>
      <div slot="left">
        <el-input
                placeholder="顾客名" prefix-icon="el-icon-search"
                v-model="searchDatas.name" @change="search"
                clearable class="search-input">
        </el-input>
        <el-input
                placeholder="联系电话" prefix-icon="el-icon-phone"
                v-model="searchDatas.telphone" @change="search"
                clearable class="search-input">
        </el-input>
        <el-input
                placeholder="电子邮箱" prefix-icon="el-icon-message"
                v-model="searchDatas.email" @change="search"
                clearable class="search-input">
        </el-input>
        <data-picker @data-change="dataChange"></data-picker>
      </div>
      <div slot="right">
        <el-button type="danger" class="search-btn" :disabled="this.multipleSelection.length===0" @click="deleteMany">批量删除</el-button>
        <el-button type="primary" class="search-btn" @click="handleCreate">添加顾客</el-button>
      </div>
    </action-bar>

<!--表格-->
    <el-table
            v-loading="loading"
            :data="tableData"
            @selection-change="handleSelectionChange"
            style="width: 100%">
      <el-table-column
              type="selection"
              width="55px">
      </el-table-column>
      <el-table-column
              type="index">
      </el-table-column>
      <el-table-column
              label="顾客名"
              prop="name">
      </el-table-column>
      <el-table-column
              label="联系电话"
              prop="telphone">
      </el-table-column>
      <el-table-column
              label="电子邮箱"
              prop="email">
      </el-table-column>
      <el-table-column
              label="联系地址"
              prop="address">
      </el-table-column>
      <el-table-column
              label="创建时间"
              prop="create_time">
      </el-table-column>
      <el-table-column
              label="最后修改时间"
              prop="update_time">
      </el-table-column>
      <el-table-column align="right">
<!--        <template slot="header" slot-scope="scope">-->
<!--          <el-select v-model="selection" clearable placeholder="请选择账户状态">-->
<!--            <el-option-->
<!--                    v-for="item in options"-->
<!--                    :key="item.value"-->
<!--                    :label="item.label"-->
<!--                    :value="item.value">-->
<!--            </el-option>-->
<!--          </el-select>-->
<!--        </template>-->
        <template slot-scope="data">
          <el-button size="mini" type="primary" icon="el-icon-edit" circle
                     @click="handleEdit(data.$index, data.row)"></el-button>
          <el-button size="mini" type="danger" icon="el-icon-delete" circle
                     @click="handleDelete(data.$index, data.row)"></el-button>
        </template>
      </el-table-column>
    </el-table>
    <div class="pages-change">
      <el-pagination
              background :page-sizes="[5, 10, 15, 20]" :page-size="this.searchDatas.size"
              :current-page="this.searchDatas.page"
              layout=' total, sizes, prev, pager, next, jumper'
              :total="totalDatasLength"
              @size-change="handleSizeChange"
              @current-change="handleCurrentChange">
      </el-pagination>
    </div>
<!--编辑框-->
    <edit :dialogVisible="iDialogVisible" @closeEditView="changeEditViewState" :customerInfo="customerInfo"></edit>

  </div>
</template>

<script>
  import ActionBar from "../../components/main/actionBar";
  import DataPicker from "../../components/main/dataPicker";
  import Edit from "./edit"

  export default {
    name: "Customer",
    components: {
      DataPicker,
      ActionBar,
      Edit
    },
    created() {
      this.search()
    },
    data() {
      return {
        multipleSelection: [],
        loading: false,
        iDialogVisible: false,
        totalDatasLength:1,
        searchDatas: {
          name: '',
          telphone: '',
          email: '',
          begin_time: '',
          end_time: '',
          // 当前第几页
          page: 1,
          // 每页几条数据
          size: 5
        },
        tableData: [
          {
            index: '',
            name: '',
            telphone: '',
            email: '',
            address: '',
            create_time: '',
            update_time: ''
          }
        ],
        searched: '',
        customerInfo: {
          id: '',
          name: '',
          telphone: '',
          email: '',
          address: '',
          desc: ''
        }
        // options: [
        //   {
        //     value: '已冻结',
        //     label: '已冻结'
        //   }
        // ],
        // selection: ''
      }
    },
    methods: {
      dataChange(value2) {
        this.searchDatas.begin_time = value2[0]
        this.searchDatas.end_time = value2[1]
        this.search()
      },
      search() {
        this.loading = true;
        this.postRequest('/customer/customer/index',this.searchDatas).then(res => {
          this.loading = false;
          this.tableData = JSON.parse(res.data.items)
          this.totalDatasLength = res.data.total
        })
      },
      handleEdit(index, row) {
        this.customerInfo = row
        this.changeEditViewState()
      },
      handleDelete: function (index, row) {
        this.$confirm(`是否删除顾客${row.name}？`, '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          this.deleteRequest('/customer/Customer/delete/id/' + row.id).then(res => {
            this.loading = true
            if (res) {
              this.loading = false
              this.search()
            }
          })
        }).catch(() => {
          this.$message({
            type: 'info',
            message: '已取消删除'
          });
        });
      },
      changeEditViewState(){
        this.iDialogVisible = !this.iDialogVisible
        if (this.iDialogVisible === false) {
          this.search()
        }
      },
      handleCreate(){
        this.customerInfo = {}
        this.changeEditViewState()
      },
      handleSelectionChange(val) {
        this.multipleSelection = val
      },
      deleteMany(){
        console.log(this.multipleSelection)
        this.$confirm(`是否批量删除选中的${this.multipleSelection.length}条顾客信息？`, '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          let ids = [];
          this.multipleSelection.forEach(item => {
            ids.push(item.id)
          })
          this.deleteRequest('/customer/Customer/delete/id/' + ids).then(res => {
            this.loading = true
            if (res) {
              this.loading = false
              this.search()
            }
          })
        }).catch(() => {
          this.$message({
            type: 'info',
            message: '已取消删除'
          });
        });
      },
      handleSizeChange(val) {
        this.searchDatas.size = val;
        this.search()
      },
      handleCurrentChange(val) {
        this.searchDatas.page = val;
        this.search()
      }
    }
  }
</script>

<style scoped>
  .pages-change{
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
