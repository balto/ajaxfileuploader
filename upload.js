(function () {
	var input = document.getElementById("images"), 
		formdata = false;

	function showUploadedItem (source) {
  		var list = document.getElementById("image-list"),
	  		li   = document.createElement("li"),
	  		img  = document.createElement("img");
  		img.src = source;
  		li.appendChild(img);
		list.appendChild(li);
	}   

	if (window.FormData) {
  		formdata = new FormData();
  		document.getElementById("btn").style.display = "none";
	}
	
 	input.addEventListener("change", function (evt) {
        var len = this.files.length,
            max = document.getElementsByName('MAX_FILE_SIZE')[0].value,
            maxfiles = this.getAttribute('data-maxfiles'),
            maxpost = this.getAttribute('data-postmax'),
            displaymax = this.getAttribute('data-displaymax'),
            filesize,
            toobig = [],
            total = 0,
            message = '';

        for (i = 0; i < len; i++) {
            filesize = this.files[i].size;
            if (filesize > max) {
                toobig.push(this.files[i].name);
            }
            total += filesize;
        }
        if (toobig.length > 0) {
            message = 'The following file(s) are too big:\n'
                + toobig.join('\n') + '\n\n';
        }
        if (total > maxpost) {
            message += 'The combined total exceeds ' + displaymax + '\n\n';
        }
        if (len > maxfiles) {
            message += 'You have selected more than ' + maxfiles + ' files';
        }


        if(message.length == 0) {

            document.getElementById("response").innerHTML = "Uploading . . ."
            var i = 0, len = this.files.length, img, reader, file;

            for ( ; i < len; i++ ) {
                file = this.files[i];

                if (!!file.type.match(/image.*/)) {
                    if ( window.FileReader ) {
                        reader = new FileReader();
                        reader.onloadend = function (e) {
                            showUploadedItem(e.target.result, file.fileName);
                        };
                        reader.readAsDataURL(file);
                    }
                    if (formdata) {
                        formdata.append("images[]", file);
                    }
                }
            }

            if (formdata) {
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        document.getElementById("response").innerHTML = res;
                    }
                });
            }
        }
        else {
            alert(message);
        }

	}, false);
}());
