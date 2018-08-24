    <!-- jQuery -->
    <script src="plug/CKEdit/ckeditor/ckeditor.js"></script>
    <!-- jQuery -->
    <script src="plug/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plug/bootstrap/dist/js/bootstrap.js"></script>
    <!-- FastClick -->
    <script src="plug/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="plug/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="plug/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="plug/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="plug/moment/min/moment.min.js"></script>
    <!-- <script src="plug/bootstrap-daterangepicker/daterangepicker.js"></script> -->
    <script src="plug/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="plug/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="plug/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="plug/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="plug/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="plug/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="plug/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="plug/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="plug/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="plug/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="plug/starrr/dist/starrr.js"></script>
    <!-- Pagination. -->
    <script src="plug/pagination/pagination.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="system/js/custom.min.js"></script>
    <script>
    function preview(input,n) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.preview'+n).attr('src', e.target.result);
                var KB = format_float(e.total / 1024, 2);
                $('.size'+n).text('檔案大小：' + KB + ' KB');
                $('#size').val(KB+'KB');
            } 
            reader.readAsDataURL(input.files[0]);
        }
    }
    function format_float(num, pos)
    {
        var size = Math.pow(10, pos);
        return Math.round(num * size) / size;
    }
    function getLatLngByAddr(addr) {   
        var geocoder = new google.maps.Geocoder();  //定義一個Geocoder物件   
        geocoder.geocode(   
        { address: addr },    //設定地址的字串   
        function(results, status) {    //callback function   
            if (status == google.maps.GeocoderStatus.OK) {//判斷狀態 
                var pos = [results[0].geometry.location.lat(), results[0].geometry.location.lng()];
                return pos;             //取得座標                                   
            } else {   
                alert('Error');   
            }   
        }   
        );   
    }  
    </script>