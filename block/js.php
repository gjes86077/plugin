    <!-- jQuery -->
    <script src="plug/CKEdit/ckeditor/ckeditor.js"></script>
    <!-- jQuery -->
    <script src="plug/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plug/bootstrap/dist/js/bootstrap.js"></script>

    <!-- bootstrap-progressbar -->
    <!-- <script src="plug/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
    <!-- iCheck -->
    <!-- <script src="plug/iCheck/icheck.min.js"></script> -->
    <!-- bootstrap-daterangepicker -->
    <script src="plug/moment/min/moment.min.js"></script>
    <!-- <script src="plug/bootstrap-daterangepicker/daterangepicker.js"></script> -->
    <script src="plug/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="plug/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="plug/jquery.hotkeys/jquery.hotkeys.js"></script>

    <!-- jQuery Tags Input -->
    <script src="plug/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <!-- <script src="plug/switchery/dist/switchery.min.js"></script> -->

    <!-- Parsley -->
    <script src="plug/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="plug/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="plug/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- cropper栽圖. -->
    <script src="plug/cropper/dist/cropper.js"></script>
    <!-- Pagination. -->
    <!-- <script src="plug/pagination/pagination.min.js"></script> -->
    <!-- Datatables -->
    <script src="plug/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="plug/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="plug/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plug/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="plug/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="plug/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="plug/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="plug/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="plug/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="plug/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plug/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="plug/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="system/js/custom.min.js"></script>
    
    <script>
    $('form').on('submit', function(e) {
    var f = e.target
    if ($(f).data('type') == 'formdata') {
      e.preventDefault()
      var formData = new FormData(f), $action = $(f).attr('action')
      var qstr = '',
        flag = 0,
        errorMsg = '',
        key
      //登入欄位判斷
      $(f)
        .find('.req')
        .each(function() {
          if ($(this).val() == '') {
            Swal.fire({
              text: '請檢查必填欄位是否完成',
              type: 'error',
              showConfirmButton: false,
              cancelButtonText: '關閉',
              showCancelButton: true,
            })
          }
        })
        formData.append('action', $action)
        for (key in formData.entries()) {
          if (formData.getAll(key)) {
            qstr += key[0] + '=' + key[1] + '&'
          }
        }
        xhr = new XMLHttpRequest()
        xhr.overrideMimeType('application/json')
        xhr.open($(f).attr('method'), $(f).attr('action'))
        xhr.onload = function() {
          var json = JSON.parse(xhr.responseText)
          eval('func_afterEditing(json)')

          // eval('func_' + $action + '(json)')
          // $('.loading').show()
        }
        xhr.send(formData)
    }
  })



    $("#datalist").DataTable({
      language: {
        decimal: "",
        emptyTable: "No data available in table",
        info: "顯示第 _START_ 至 _END_ 筆資料，共 _TOTAL_ 筆",
        infoEmpty: "顯示 0 to 0 of 0 entries",
        infoFiltered: "(filtered from _MAX_ total entries)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "顯示 _MENU_ 筆資料",
        loadingRecords: "讀取中...",
        processing: "處理中...",
        search: "搜尋:",
        zeroRecords: "查無資料",
        paginate: {
          first: "第一頁",
          last: "最後",
          next: ">",
          previous: "<"
        },
        aria: {
          sortAscending: ": activate to sort column ascending",
          sortDescending: ": activate to sort column descending"
        }
      }
    })
    $(".insert-btn").on("mouseenter mouseleave", function(e) {
      $(this).toggleClass("animated")
    })
    $("#edit").on("change", ".upl", function() {
      console.log("圖片變更")
      var input = this
      var PARENT = $(this).parents(".form-group")
      if (input.files && input.files[0]) {
        var reader = new FileReader()
        reader.onload = function(e) {
          var image = PARENT.find(".preview")
          switch (image.data("event")) {
            case "cropper":
              image.data("status", "modify")
              var width = 0
              var height = 0
              width = image.data("width")
              height = image.data("height")
              image
                .cropper("destroy")
                .attr("src", e.target.result)
                .cropper({
                  viewMode: 2,
                  aspectRatio: width / height
                })
              break
            default:
              image.attr("src", e.target.result)
              break
          }
          var KB = format_float(e.total / 1024, 2)
        }
        reader.readAsDataURL(input.files[0])
      }
    })
    $("#form_id").submit(function(e) {
      // e.preventDefault()
      if (confirm("確認變更？")) {
        $(".preview").each(function(index) {
          if ( $(this).data("event") == "cropper" && $(this).data("status") == "modify" ) {
            var cropcanvas = $(this).cropper("getCroppedCanvas",{width:$(this).data("width"),height:$(this).data("height")})
            var croppng = cropcanvas.toDataURL("image/png",0.5)
            $(this).prev().val(croppng)
            console.log(croppng)
          }
        })
      }  else {
        return false
      }
    })
    function format_float(num, pos) {
      var size = Math.pow(10, pos)
      return Math.round(num * size) / size
    }
    function getLatLngByAddr(addr) {
      var geocoder = new google.maps.Geocoder() //定義一個Geocoder物件
      geocoder.geocode(
        { address: addr }, //設定地址的字串
        function(results, status) {
          //callback function
          if (status == google.maps.GeocoderStatus.OK) {
            //判斷狀態
            var pos = [
              results[0].geometry.location.lat(), results[0].geometry.location.lng()
            ]
            return pos //取得座標
          } else {
            alert("Error")
          }
        }
      )
    }

    </script>