<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>TinyMCE Upload Image with Jquery Ajax and PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="">
    <div class="container">
        <div class="row">
            <h2>TinyMCE Upload Image with Jquery Ajax and PHP</h2>

            <form id="posts" name="posts" method="post">
                <textarea name="message" id="message"></textarea><br>
            </form>

        </div>
    </div>
    <script src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea",
            plugins: "code media table",
            toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code image_upload media table",
            menubar: false,
            statusbar: false,

            content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
            height: 400,
            setup: function(ed) {
                console.log(ed);

                var fileInput = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
                $(ed.getElement()).parent().append(fileInput);

                fileInput.on("change", function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    var formData = new FormData();
                    var files = file;
                    formData.append("file", files);
                    formData.append('filetype', 'image');
                    jQuery.ajax({
                        url: "tinymce_upload.php",
                        type: "post",
                        data: formData,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function(response) {

                            var fileName = response;
                            if (fileName) {
                                ed.insertContent('<img src="upload/' + fileName + '"/>');
                            }
                        }
                    });
                    reader.readAsDataURL(file);
                });

                ed.addButton('image_upload', {
                    tooltip: 'Upload Image',
                    icon: 'image',
                    onclick: function() {
                        fileInput.trigger('click');
                    }
                });
            }

        });
    </script>
</body>

</html>