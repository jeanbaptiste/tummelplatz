
<html>
  
<head>  

<link href="style.css" rel="stylesheet" type="text/css">  
<link href="dropzone.css" type="text/css" rel="stylesheet" />
  
<!-- 1 -->
<script src="jquery.min.js"></script>

<script src="dropzone.js"></script>
 
<script>
Dropzone.options.myDropzone = {

maxFilesize: 2000, //MB
clickable: true,
dictDefaultMessage: "Drag and Drop Image or File",

    init: function() {
        thisDropzone = this;
        $.get('upload.php', function(data) {
            $.each(data, function(key,value){
 

  var ext = checkFileExt(value.name); // Get extension
  var newimage = "";

  // Check extension
      if(ext != 'png' && ext != 'jpg' && ext != 'jpeg' && ext != 'gif'){
      newimage = "./media/logo.jpg"; // default image path
      } else { newimage = "./uploads/"+value.name };

                               var mockFile = { name: value.name, size: value.size, metadata: value.metadata };
                               thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                               // thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "./uploads/"+value.name);
                               thisDropzone.options.thumbnail.call(thisDropzone, mockFile, newimage);
                               thisDropzone.options.complete.call(thisDropzone, mockFile, value.metadata);

            });
             
        });
    }
};

// Get file extension
function checkFileExt(filename){
  filename = filename.toLowerCase();
  return filename.split('.').pop();
}


</script>
 
</head>
  
<body>
  
<!-- 2 -->
<form action="upload.php" class="dropzone" id="my-dropzone"></form>
    
</body>
  
</html>
