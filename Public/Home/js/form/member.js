/**
 * Created by 低语 on 2016/7/5.
 */

$(function() {

  $('#member_form').bootstrapValidator({
//        live: 'disabled',
    message: 'This value is not valid',
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      nick_name: {
        message: 'The user_name is not valid',
        validators: {
          notEmpty: {
            message: '昵称不能为空'
          },
          stringLength: {
            min: 0,
            max: 20,
            message: '昵称不能大于20位'
          },
        }
      },
      mobile: {
        validators: {
          regexp: {
            regexp: /^[a-zA-Z0-9_\.-]+$/,
            message: '联系方式不能有非法字符,中文'
          },
          stringLength: {
            min: 0,
            max: 20,
            message: '联系方式不能大于20位'
          },
        }
      }
    }
  });
  
  $('#resetBtn').click(function() {
    $('#member_form').data('bootstrapValidator').resetForm(true);
  });

});