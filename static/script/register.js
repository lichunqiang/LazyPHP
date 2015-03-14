+function() {
  var $form = $('#registerForm'),
      $submit = $('[type=submit]', $form);

  var validator = $form.validate({
    rules: {
      account: {
        required: true
      },
      password: {
        required: true,
        minlength: 6
      },
      confirmPassword: {
        required: true,
        minlength: 6,
        equalTo: '[name=password]'
      },
      email: {
        email: true
      }
    },
    messages: {
      account: {
        required: '请输入用户名'
      },
      password: {
        required: '请输入密码',
        minlength: $.validator.format('密码长度不能小于{0}位')
      },
      confirmPassword: {
        required: '请输入确认密码',
        minlength: $.validator.format('密码长度不能小于{0}位'),
        equalTo: '两次密码输入不一致'
      },
      email: {
        email: '输入的电子邮箱地址不合法'
      }
    },
    submitHandler: function(form) {
      $form.ajaxSubmit({
        success: function(resp) {
          resp.errcode == 0 ? (window.location.href = '/') : validator.showErrors(resp.errinfo || {'account' : '未知错误'});
        }
      })
      return false;
    },
    errorPlacement: function(error, element) {
      element.after(error).closest('div').addClass('has-error');
    },
    success: function(label, element) {
      $(label).remove();
      $(element).closest('div.has-error').removeClass('has-error');
    }
  });
}();
