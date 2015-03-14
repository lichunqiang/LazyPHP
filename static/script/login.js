+function() {
  var $form = $('#loginForm'),
      $submit = $('[type=submit]', $form);

  var validaotr = $form.validate({
    rules: {
      account: 'required',
      password: 'required'
    },
    messages: {
      account: '请输入登录账号',
      password: '请输入登录密码'
    }, 
    submitHandler: function(form) {
      $submit.data('loading-text', '登录中...').button('loading');
      $form.ajaxSubmit({
        success: function(resp) {
          if (resp.errcode == 0) {
            window.location.href = resp.redirct;
          } else {
            validaotr.showErrors(resp.errinfo || {'password': '未知错误'});
          } 
          $submit.button('reset');
        }
      });
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
