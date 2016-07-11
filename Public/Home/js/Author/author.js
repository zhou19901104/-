/**
 * Created by 低语 on 2016/7/9.
 */
<!--&lt;!&ndash;ajax实现无刷新分页效果&ndash;&gt;-->

  $(function () {

    var initPagination = function () {
      var num_entries = $("#cmtcount").val();//记录总条数
      // 创建分页页码列表
      $("#pageshow").pagination(num_entries, {
        num_edge_entries: 1, //边缘页数
        num_display_entries: 4, //主体页数
        callback: pageselectCallback,
        items_per_page: 6 //每页显示1条记录信息
      });
    }();

    function pageselectCallback(page_index, jq) {

      //通过ajax去服务器端获得"第page_index+1页"评论信息回来
      $.ajax({
        url: "__MODULE__-Author-getCmtList",
        data: {'page_index': page_index,},
        dataType: 'json',
        type: 'get',
        success: function (msg) {
          //console.log(msg);
          //遍历msg 使其与html标签结合 并追加给页面
          var str = "";
          $.each(msg, function (index, value) {
            //console.log(value);
            str += '<li class="list-group-item">' + value.comment + '</li>';
          });
          //清除旧的div
          $('.list-group-item').remove();
          //追加评论(回复)信息新div到页面
          $('#pageshow').before(str); //给后边追加兄弟节点
        }
      });
    }

  });

<!--评论即追加界面-->
  //发表评论
  function add_publish() {
    //富文本编辑器通过以下方式获得内容
    var comment = UE.getEditor('user_comment').getContent();

    if (comment !== null || comment !== undefined) {
      //② 通过ajax传递内容到服务器端存储
      $.ajax({
        url: "__MODULE__-Author-addCmt",
        data: {'comment': comment},
        dataType: 'json',
        type: 'post',
        success: function (msg) {
          //msg信息 与 html标签 合并 并追加给页面
          //console.log(msg);
          var str = '';
          str += ' <li class="list-group-item">' + msg.comment + '</li>';

          //追加str到页面
          $('.list-group').after(str); //兄弟追加
          UE.getEditor('user_comment').setContent(''); //富文本编辑器内容清空

          //表单信息归位
          //$('[name=cmt_star]').val(['5']); //设置value='5'的单选按钮选中
          //控制器浏览器滚动条，使得可以立即查看添加的评论内容
          //$(document).scrollTop(706);
        }
      });
    }
  }
var ue = UE.getEditor('user_comment', {
  toolbars: [[
    'fullscreen', 'source', '|', 'undo', 'redo', '|',
    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
    'directionalityltr', 'directionalityrtl', 'indent', '|',
    'justifyleft', 'touppercase', 'tolowercase', '|',
    'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
    'simpleupload', 'insertimage', 'emotion',
    'horizontal'
  ]]
});


