+function() {


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

  //添加人物表单验证
  var validator = $('#addCharacterForm').validate({
    rules: {
      name: 'required',
      belong_ftg: 'required',
      belong_anime: 'required',
    },
    messages: {
      name: '请填写人物名称',
      belong_ftg: '请填写人物所属格斗游戏',
      belong_anime: '请填写人物所属动漫作品',
    },
    submitHandler: function(form) {
      var $submit = $(form).find('[type=submit]');
      $submit.data('loading-text', '保存中...').button('loading');
      $(form).ajaxSubmit({
        success: function(resp) {
          alert(resp.errmsg);
          resp.errcode == 1 && validator.showErrors(resp.errinfo || {name: '未知错误'});
          resp.errcode === 0 && $('#primaryKey').val(resp.key);
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

  /*作者相关*/
  var $addAuthorBtn = $('#addAuthorButton'),
    render = template('tAuthorModal');

  //添加作者弹出层
  $addAuthorBtn.on('click', function() {
    var $modal = $(render({title: '添加作者', button: '确定添加'}));
    var primaryKey = $('#primaryKey').val();
    if (!primaryKey) {
      return alert('请先添加人物');
    }
    $modal.modal();
    $modal.on('shown.bs.modal', function() {
      init_pop_form(primaryKey);
    });
  });

  function init_pop_form(character) {
    //初始化弹出层内表单
    $author_form = $('#authorForm'), $author_submit = $('#authorSubmitButton');
    var author_validator = $author_form.validate({
      rules: {
        author: 'required',
        address: {
          required: true,
          url: true
        }
      },
      messages: {
        author: '此项必填',
        address: {
          required: '此项必填',
          url: '输入正确的URL地址'
        }
      },
      submitHandler: function(form) {
        $author_submit.button('loading');
        $author_form.ajaxSubmit({
          data: {character:character },
          success: function(resp) {
            $author_submit.button('reset');
            alert(resp.errmsg);
            resp.errcode == 1 && (author_validator.showErrors(resp.errinfo || {'remark': '未知错误'}));
          }
        });
      }
    }); 
  }

}();
