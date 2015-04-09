+function() {
  var $form = $('#scenarioForm'),
      $submit = $('[type=submit]', $form);

  var validator = $form.validate({
    rules: {
      name: {
        required: true,
        maxlength: 50
      },
      belong_ftg: {
        required: true
      },
      belong_anime: {
        required: true
      },
      remark: {
        maxlength: 100
      },
      download_url: {
        url: true
      }
    },
    messages: {
      name: {
        required: '请输入作者名称',
        maxlength: $.validator.format('不能超过{0}个字符')
      },
      belong_ftg: {
        required: '此项必填'
      },
      belong_anime: {
        required: '此项必填'
      },
      download_url: {
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

  var uploader = WebUploader.create({

      // 选完文件后，是否自动上传。
      auto: true,

      // swf文件路径
      swf: '/script/gallery/Uploader.swf',

      // 文件接收服务端。
      server: '/uploader/controller.php?action=uploadimage',

      // 选择文件的按钮。可选。
      // 内部根据当前运行是创建，可能是input元素，也可能是flash.
      pick: '#filePicker',

      // 只允许选择图片文件。
      accept: {
          title: 'Images',
          extensions: 'gif,jpg,jpeg,bmp,png',
          mimeTypes: 'image/*'
      },

      formData: {
        session: 'xxxx'
      }
  });

  uploader.on( 'fileQueued', function( file ) {
      // do some things.
      console.log(file)
  });

  uploader.on('uploadProgress', function(file, percentage) {
    console.log('percentage', percentage);
  })

  uploader.on('uploadSuccess', function(file, response) {
    console.log('success', response)
    var $img = $('<img>', {'class': 'mg-rounded', src: response.url});
    $('#fileList').html($img);
    $('#hidThumbnail').val(response.url);
  })

  uploader.on('uploadError', function(file, reason) {
    console.log('error', reason)
  });
}();
