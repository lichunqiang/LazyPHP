(function() {
  var $modal = $('#addLinkModal'),
      $form = $('form', $modal), cate = 1;


  $('.nav-add-link').on('click', function() {
    cate = $(this).data('type');
    $modal.modal();
  });

  var validator = $form.validate({
    rules: {
      title: {
        required: true,
        maxlength: 16
      },
      address: {
        required: true,
        url: true
      }
    },
    messages: {
      title: {
        required: '输入链接标题',
        maxlength: $.validator.format('链接标题不能超过{0}个字符')
      },
      address: {
        required: '请输入链接地址',
        url: '链接地址输入不合法'
      }
    },
    submitHandler: function(form) {
      $form.ajaxSubmit({
        data: {cate: cate},
        success: function(resp) {
          resp.errcode == 0 ? (alert(resp.errmsg), $modal.modal('hide')) : validator.showErrors(resp.errinfo || {'account' : '未知错误'});
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
})();
