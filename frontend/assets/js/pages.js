(function($,window){
    var Page = function(ele,opt){
        this.$ele = ele;
        this.defaults ={
            curPage: 1,
            totalPage: 1,
            totalCount: 0,
            morePage: opt.morePage,
            perPageCount: opt.perPageCount
        }
        this.options = $.extend({},this.defaults,opt);
    }
    Page.prototype = {
        init: function () {
            //数据初始化
            this.dataInit();
            //显示当前页数、总页数
            this.pageInit();
            //分页处理
            this.pageFun();
            //销毁之前事件
            this.offEventFun();
            //事件处理
            this.eventFun();
            return this.$ele;
        },
        pageInit: function () {
            $(this.options.curPageEl).html("当前第" + this.options.curPage + "页");
            $(this.options.totalEl).html("共" + this.options.totalPage + "页");
        },
        pageFun: function () {
            var $list = this.$ele.children();
            $list.hide();
            var start = (this.options.curPage - 1) * this.options.perPageCount;
            if (this.options.curPage == this.options.totalPage) {
                var end = $list.length;
                for (var i = start; i < end; i++) {
                    $($list[i]).show();
                }
            } else {
                for (var i = start; i < start + this.options.perPageCount; i++) {
                    $($list[i]).show();
                }
            }
            this.pageInit();
        }
        ,
        dataInit: function () {
            var $list = this.$ele.children();
            this.options.curPage = 1;
            this.options.totalCount = $list.length;
            this.options.totalPage = Math.ceil($list.length / this.options.perPageCount);
        },
        eventFun:function(){
            //下一页
            var self = this;
            $(this.options.next).on("click", function () {
                if (self.options.curPage + 1 > self.options.totalPage) {
                    alert("已经是最后一页");
                    return;
                }
                self.options.curPage++;
                self.pageFun();
            });
            //上一页
            $(this.options.prev).on("click", function () {
                if (self.options.curPage - 1 < 1) {
                    alert("已经是第一页");
                    return;
                }
                self.options.curPage--;
                self.pageFun();
            });
            //下n页
            $(this.options.nextMore).on("click", function () {
                if (self.options.curPage + self.options.morePage > self.options.totalPage){
                    self.options.curPage = self.options.totalPage;
                    alert("已经是最后一页")
                }else{
                    self.options.curPage += self.options.morePage;
                }
                self.pageFun();
            });
            //上n页
            $(this.options.prevMore).on("click", function () {
                if (self.options.curPage - self.options.morePage < 1){
                    self.options.curPage = 1;
                    alert("已经是第一页")
                }else{
                    self.options.curPage -= self.options.morePage;
                }
                self.pageFun();
            });
        },
        offEventFun:function(){
            $(this.options.next).off("click");
            $(this.options.prev).off("click");
            $(this.options.nextMore).off("click");
            $(this.options.prevMore).off("click");
        }
    }
    $.fn.page = function(options){
        var page = new Page(this,options);
        return page.init();
    }
})(jQuery,window)