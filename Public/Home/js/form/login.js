/**
 * Created by 低语 on 2016/7/1.
 */
$(function() {
  // Generate a simple captcha
  function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
  };
  $('#captchaLogin').html([randomNumber(1, 100), '+', randomNumber(1, 50), '='].join(' '));

  $('#login_form').bootstrapValidator({
//        live: 'disabled',
    message: 'This value is not valid',
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      login_user: {
        message: 'The username is not valid',
        validators: {
          notEmpty: {
            message: '用户名不能为空'
          },
          stringLength: {
            min: 4,
            max: 30,
            message: '用户名不能小于4位'
          },
          regexp: {
            regexp: /^[a-zA-Z0-9_\.]+$/,
            message: '用户名不符合规格'
          },
        }
      },
      login_pass: {
        validators: {
          notEmpty: {
            message: '密码不能为空'
          },
          stringLength: {
            min: 6,
            max: 30,
            message: '密码不能小于6位'
          },
        },
      },
      captcha: {
        validators: {
          callback: {
            message: '回答错误',
            callback: function (value, validator) {
              var items = $('#captchaLogin').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
              return value == sum;
            }
          }
        }
      }
    }
  });

  // Validate the form manually
  $('#resetLogin').click(function() {
    $('#login_form').data('bootstrapValidator').resetForm(true);
  });
});
