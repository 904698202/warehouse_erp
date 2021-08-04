<template>
  <div class="action-bar">
    <slot name="left" class="left-slot"></slot>
    <slot name="right" class="right-slot"></slot>
  </div>
</template>

<script>
  export default {
    name: "actionBar"
  }
</script>

<style scoped lang="less">
  .action-bar {
    height: 32px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-bottom: 5px;

    .search-input {
      width: 180px;
      margin-right: 5px;
    }
    .left-slot {
      display: flex;
    }
  }

  @media screen and (max-width: 1296px) {
    .data-picker {
      display: none;
    }
  }

  @media screen and (max-width: 1003px) {
    .search-input{
      display: none;
    }
    .search-input:first-child{
      display: block;
    }
  }
</style>
