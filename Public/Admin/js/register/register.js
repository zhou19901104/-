var MyValidator = function(){

    var handleSubmit = function() {

        $('.form-horizontal').validate({

            errorElement : 'span',
            errorClass : 'help-block',
            focusInvalid : false,
            rules : {
                register_user : {
                    required : true,
                    minlength : 4,
                },
                register_pass : {
                    required : true,
                    minlength : 6,
                },
                login_user : {
                    required : true,
                    minlength : 4,
                },
                login_pass : {
                    required : true,
                    minlength : 6,
                }
            },
            messages : {
               register_user : {
                    required : "用户名必填..",
                    minlength : '账号不能小于{0}位'
                },
                register_pass : {
                    required : "密码必填..",
                     minlength : '密码不能小于{0}位'
                },
                login_user : {
                    required : "用户名必填..",
                    minlength : '账号不能小于{0}位'
                },
                login_pass : {
                    required : "密码必填..",
                     minlength : '密码不能小于{0}位'
                }

            },

            highlight : function(element) {
                $(element).closest('.form-group').addClass('has-error has-feedback');
                $(element).next('span').addClass('glyphicon glyphicon-remove form-control-feedback');
            },

            success : function(label,element) {
                label.closest('.form-group').removeClass('has-error');
                $(element).next('span').removeClass('glyphicon-remove ');
                $(element).next('span').addClass('glyphicon-ok');
                label.remove();
            },

            errorPlacement : function(error, element) {
                element.parent('div').append(error);
            },

            submitHandler : function(form,element) {
                $(element).parent('form').removeClass('has-feedback');
                $(element).parent('form').removeClass('glyphicon-ok');
                form.submit();
            }
        });

        $('.form-horizontal input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.form-horizontal').validate().form()) {
                    $('.form-horizontal').submit();
                }
                return false;
            }
        });
    }

    return {
        init : function() {
            handleSubmit();
        }
    };

}();