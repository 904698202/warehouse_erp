<template>
    <el-date-picker
            v-model="value2" class="data-picker"
            type="datetimerange" @change="sendValue(value2)"
            :picker-options="pickerOptions"
            range-separator="至"
            start-placeholder="创建日期(起)"
            end-placeholder="创建日期(止)">
    </el-date-picker>
</template>

<script>
  export default {
    name: "dataPicker",
    data() {
      return {
        pickerOptions: {
          shortcuts: [{
            text: '最近一周',
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '最近一个月',
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '最近三个月',
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
              picker.$emit('pick', [start, end]);
            }
          }]
        },
        value2: ''
      };
    },
    methods:{
      sendValue(value2){
          if (value2) {
              this.$emit('data-change',value2)
          } else {
              this.$emit('data-change','')
          }


      }
    }
  }
</script>

<style scoped lang="less">
  .data-picker{
    width: 360px;
    margin-right: 5px;
  }
</style>
