$(function() {
  // Generate a simple captcha
  function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
  };
  $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 50), '='].join(' '));

  $('#register_form').bootstrapValidator({
//        live: 'disabled',
    message: 'This value is not valid',
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      user_name: {
        message: 'The user_name is not valid',
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
            message: '用户名只能用拼音,数字,下划线'
          },
          /*   remote: {
           url: 'remote.php',
           message: 'The username is not available'
           },*/

          different: {
            field: 'user_pass',
            message: 'The user_name and user_pass cannot be the same as each other'
          },
        }
      },
      email: {
        validators: {
          emailAddress: {
            message: '请输入正确的邮箱地址'
          }
        }
      },
      user_pass: {
        validators: {
          notEmpty: {
            message: '密码不能为空'
          },
          different: {
            field: 'user_name',
            message: '密码不能与用户名相同'
          },
          stringLength: {
            min: 6,
            max: 30,
            message: '密码不能小于6位'
          },
        }
      },
      confirmPassword: {
        validators: {
          notEmpty: {
            message: '确认密码不能为空'
          },
          identical: {
            field: 'user_pass',
            message: '密码输入不一致'
          },
          different: {
            field: 'user_name',
            message: '密码不能与用户名相同'
          }
        }
      },
      captcha: {
        validators: {
          callback: {
            message: '回答错误',
            callback: function(value, validator) {
              var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
              return value == sum;
            }
          }
        }
      }
    }
  });

  // Validate the form manually
  $('#validateBtn').click(function() {
    $('#register_form').bootstrapValidator('validate');
  });

  $('#resetBtn').click(function() {
    $('#register_form').data('bootstrapValidator').resetForm(true);
  });
  
});