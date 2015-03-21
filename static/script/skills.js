+function() {

  var $form = $('#publishForm');

  var editor = UE.getEditor('content');

  var validator = $form.validate({
    ignore: '',
    rules: {
      title: {
        required: true,
        maxlength: 110
      },
      content: {
        required: true
      }
    },
    messages: {
      title: {
        required: '请输入标题',
        maxlength: $.validator.format('不能超过{0}个字符')
      },
      content: {
        required: '请填写内容'
      }
    },
    submitHandler: function(form) {
      editor.sync();
      $form.ajaxSubmit({
        success: function(resp) {
          resp.errcode == 0 ? (alert(resp.errmsg), window.location.reload()) : validator.showErrors(resp.errinfo);
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
