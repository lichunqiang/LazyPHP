+function() {

  var $form = $('#publishForm'),
      $submit = $('[type=submit]', $form), $reset = $('[type=reset]', $form);


  var validator = $form.validate({
    rules: {
      title: {
        required: true,
        maxlength: 100
      },
      address: {
        required: true,
        url: true
      },
      content: {
        required: true
      }
    }, 
    messages: {
      title: {
        required: '请输入新闻标题',
        maxlength: $.validator.format('标题不能超过{0}个字符')
      },
      address: {
        required: '请输入新闻的网址',
        url: '输入的网址不合法'
      },
      content: {
        required: '请输入新闻内容'
      }
    },
    submitHandler: function(form) {
      $submit.data('loading-text', '保存中...').button('loading');
      $form.ajaxSubmit({
        success: function(resp) {
          resp.errcode == 0 ? (alert(resp.errmsg), $reset.trigger('click')) : validator.showErrors(resp.errinfo || {'content' : '未知错误'});
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
  })



}();
