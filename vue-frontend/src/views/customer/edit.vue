<template>
  <el-dialog
          title="编辑顾客信息"
          :visible.sync="dialogVisible"
          width="30%" center
          :before-close="handleClose">

    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
      <el-form-item hidden>
        <el-input v-model.number="ruleForm.id"></el-input>
      </el-form-item>

      <el-form-item label="顾客名称" prop="name" class="edit-input">
        <el-input v-model="ruleForm.name"></el-input>
      </el-form-item>

      <el-form-item label="联系电话" prop="telphone" class="edit-input">
        <el-input v-model="ruleForm.telphone"></el-input>
      </el-form-item>

      <el-form-item label="电子邮箱" prop="email" class="edit-input">
        <el-input v-model="ruleForm.email"></el-input>
      </el-form-item>

      <el-form-item label="联系地址" prop="address" class="edit-input">
        <el-input v-model="ruleForm.address" placeholder="例：福建省泉州市"></el-input>
      </el-form-item>

      <el-form-item label="顾客简介" class="edit-textarea">
        <el-input type="textarea" v-model="ruleForm.desc"></el-input>
      </el-form-item>
    </el-form>

    <span slot="footer" class="dialog-footer">
      <el-button size="small" @click="resetForm('ruleForm')" v-show="createBtn">重置</el-button>
      <el-button type="primary" size="small" @click="submitForm('ruleForm')" v-show="createBtn">确 定</el-button>
      <el-button type="success" size="small" @click="submitForm('ruleForm')" v-show="saveBtn">保存修改</el-button>
    </span>

  </el-dialog>
</template>

<script>
  export default {
    name: "edit",
    data (){
      return {
        ruleForm: {
          id: '',
          name: '',
          telphone: '',
          email: '',
          address: '',
          desc: ''
        },
        rules: {
          name: [
            { required: true, message: '请输入顾客名', trigger: 'blur' }
          ],
          telphone: [
            { required: true, message: '请输入联系电话', trigger: 'blur'},
            { min: 11, message: '请输入正确的联系电话', trigger: 'blur' }
          ],
          email: [
            { required: true, message: '请输入电子邮箱', trigger: 'blur'},
            { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur' }
          ],
          address: [
            { required: true, message: '请输入联系地址', trigger: 'blur'},
            { min: 6, message: '请输入正确的联系地址，即某省某市', trigger: 'blur' }
          ]
        }
      }
    },
    props:{
      dialogVisible:Boolean,
      customerInfo:Object
    },
    methods:{
      handleClose() {
        this.$confirm('确认关闭？').then(() => {
          this.$emit('closeEditView')
          this.resetForm('ruleForm')
        }).catch(() => {})
      },
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            if (this.ruleForm.id === undefined){
              this.postRequest('/customer/Customer/save',this.ruleForm).then(res => {
                if(res) {
                  this.$emit('closeEditView')
                  this.resetForm('ruleForm')
                }
              })
            } else {
              this.postRequest('/customer/Customer/update',this.ruleForm).then(res => {
                if(res) {
                  this.$emit('closeEditView')
                }
              })
            }
          } else {
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    },
    watch:{
      customerInfo(){
        this.ruleForm = this.customerInfo
      }
    },
    computed:{
      createBtn(){
        return this.ruleForm.id === undefined
      },
      saveBtn(){
        return this.ruleForm.id !== undefined
      }
    }
  }
</script>

<style scoped>
 .edit-input {
   width: 70%;
 }

  .edit-textarea {
    width: 80%;
  }
</style>
