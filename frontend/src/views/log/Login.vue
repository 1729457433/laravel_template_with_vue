<template>
  <div id="config">
    <el-form id="toolbar" :inline="true" :model="searchForm" class="demo-form-inline">
      <el-form-item>
        <el-input v-model="searchForm.user_name" placeholder="请输入登录名" @keyup.enter.native="find" />
      </el-form-item>
      <el-form-item>
        <el-select v-model="searchForm.type" type="text" clearable placeholder="请选择时间类型">
          <el-option label="登录" value="login" />
          <el-option label="退出" value="logout" />
        </el-select>
      </el-form-item>
      <el-form-item>
        <el-date-picker
          v-model="searchForm.created_at"
          type="date"
          placeholder="选择日期"
        />
      </el-form-item>
      <el-form-item>
        <el-button plain @click="find()">查询</el-button>
        <el-button type="info" plain @click="findReset()">重置</el-button>
      </el-form-item>
    </el-form>
    <div id="datagrid">
      <!-- 信息表 -->
      <el-table v-loading="loading" size="mini" :data="tableData" border @selection-change="selectChange">
        <el-table-column label="标识" prop="id" width="100" />
        <el-table-column label="用户昵称" prop="user_name" width="150" />
        <el-table-column label="操作地址" prop="ip" width="200" />
        <el-table-column label="时间" prop="created_at" width="200" />
        <el-table-column label="操作类型" width="130">
          <template slot-scope="scope">
            <span>{{ scope.row.type|filterType }}</span>
          </template>
        </el-table-column>
        <el-table-column label="说明" prop="desc" />
      </el-table>
      <!-- 分页 -->
      <el-row class="page">
        <el-col :span="2" :offset="1" />
        <el-col :span="20">
          <el-pagination background :current-page.sync="current_page" :page-sizes="[10,20,25,50]" layout="total,sizes,prev, pager, next" :page-size.sync="pageSize" :total="total" @current-change="pagination" @size-change="sizeChange" />
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
import CURD from '@/minix/curd'
import UPLOAD from '@/minix/upload'
import {
  getInfo
} from '@/api/log'

import {
  SearchModel
} from '@/model/log'
import {
  config
} from '@/config/index'
import {
  Tools
} from '@/views/utils/Tools'

export default {
  name: 'LogLogin',
  filters: {
    filterType(value) {
      const status = {
        'login': '登录',
        'logout': '退出'
      }
      return status[value]
    }
  },
  mixins: [CURD],
  data() {
    return {
      searchForm: new SearchModel(),
      form: [],
      rules: [],
      searchModel: SearchModel,
      model: [],
      tools: Tools,
      showMenu: false,
      curd: {
        getInfo: getInfo || function() {},
        getInfoById: function() {},
        updateInfo: function() {},
        addInfo: function() {},
        deleteInfoById: function() {},
        deleteAll: function() {}
      }
    }
  },

  created() {
    this.fetchData()
  },
  methods: {
    find(event) {
      this.$nextTick()
        .then(() => {
          this.fetchData()
        })
    }
  }
}
</script>

<style lang="scss">
@import "@/styles/app-main.scss";
#config .el-input {
    // width: 200px;
    // margin-left: 10px;
}
#datagrid {
    .toolbar {
        margin-bottom: 10px;
        .tips{
           line-height: 40px;
           height: 40px;
           margin:0px;
           padding:0px 10px;
        }
    }
    .page {
        margin-top: 10px;
    }
}
.el-button--mini.is-round,
.toolbar-config .el-button--mini {
    padding: 10px;
}
.toolbar-config .el-button+.el-button {
    margin-left: 5px;
}
.tips span{
  color: #f44;
}

</style>
