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

    $('#filePreview').attr('src', response.url)
  })

  uploader.on('uploadError', function(file, reason) {
    console.log('error', reason)
  })

}();
