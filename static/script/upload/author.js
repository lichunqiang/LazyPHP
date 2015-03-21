+function() {

  var $form = $('#authorForm'),
      $submit = $('[type=submit]', $form);

  var validator = $form.validate({
    rules: {
      name: {
        required: true,
        maxlength: 12
      },
      address: {
        url: true
      },
      remark: {
        maxlength: 100
      }
    },
    messages: {
      name: {
        required: '请输入作者名称',
        maxlength: $.validator.format('不能超过{0}个字符')
      },
      address: {
        url: '链接地址无效'
      },
      remark: {
        maxlength: $.validator.format('不能超过{0}个字符')
      }
    }, 
    submitHandler: function(form) {
      $submit.data('loading-text', '保存中...').button('loading');
      $form.ajaxSubmit({
        success: function(resp) {
          if (resp.errcode == 0) {
            alert(resp.errmsg);
            window.location.reload();
          } else {
            validator.showErrors(resp.errinfo || {'remark': '未知错误'});
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
