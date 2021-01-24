(function ($) {
    'use strict';

    /*[ File Input Config ]
        ===========================================================*/
    
    try {
    
        var file_input_container = $('.js-input-file');
    
        if (file_input_container[0]) {
    
            file_input_container.each(function () {
    
                var that = $(this);
    
                var fileInput = that.find(".input-file");
                var info = that.find(".input-file__info");
    
                fileInput.on("change", function () {
    
                    var fileName;
                    fileName = $(this).val();
    
                    if (fileName.substring(3,11) == 'fakepath') {
                        fileName = fileName.substring(12);
                    }
    
                    if(fileName == "") {
                        info.text("No file chosen");
                    } else {
                        info.text(fileName);
                    }
    
                })
    
            });
    
        }
    
    
    
    }
    catch (e) {
        console.log(e);
    }

})(jQuery);

(function ($) {
    'use strict';

    /*[ File Input Config ]
        ===========================================================*/
    
    try {
    
        var file_input_container = $('.js-input-file2');
    
        if (file_input_container[0]) {
    
            file_input_container.each(function () {
    
                var that = $(this);
    
                var fileInput = that.find(".input-file2");
                var info = that.find(".input-file__info2");
    
                fileInput.on("change", function () {
    
                    var fileName;
                    fileName = $(this).val();
    
                    if (fileName.substring(3,11) == 'fakepath') {
                        fileName = fileName.substring(12);
                    }
    
                    if(fileName == "") {
                        info.text("No file chosen");
                    } else {
                        info.text(fileName);
                    }
    
                })
    
            });
    
        }
    
    
    
    }
    catch (e) {
        console.log(e);
    }

})(jQuery);

(function ($) {
    'use strict';

    /*[ File Input Config ]
        ===========================================================*/
    
    try {
    
        var file_input_container = $('.js-input-file3');   
        if (file_input_container[0]) {
    
            file_input_container.each(function () {
    
                var that = $(this);
    
                var fileInput = that.find(".input-file3");
                var info = that.find(".input-file__info3");
    
                fileInput.on("change", function () {
                    var files = $(this)[0].files;
                    var fileName;
                    fileName = $(this).val();
    
                    if (fileName.substring(3,11) == 'fakepath') {
                        fileName = fileName.substring(12);
                    }
    
                    if(fileName == "") {
                        info.text("No file chosen");
                    } else {
                         if(files.length > 1){
                          info.text(`${files.length} documents selected`);
                        }else{
                            info.text(`${files.length} document selected`);
                        }
                    }
    
                })
    
            });
    
        }
    
    
    
    }
    catch (e) {
        console.log(e);
    }

})(jQuery);

// var limit = 5;
// $(document).ready(function(){
//     $('#image').change(function(){
//         var files = $(this)[0].files;
//         if(files.length > limit){
//             alert("You can select max "+limit+" images.");
//             $('#image').val('');
//             return false;
//         }else{
//             return true;
//         }
//     });
// });