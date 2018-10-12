<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <input type="text" id="ac" placeholder='AC'>
  <input type="text" id="pw" placeholder='pw'>
  <div id="pw_hash"></div>
</body>
</html>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.2/jquery.min.js'></script>
<script>
$(function(){
  $('input').on('input',function(){
    $.post('control/app.php',{
      ac:$('#ac').val(),
      pw:$('#pw').val(),
      },(r)=>{
        $('#pw_hash').text(r)
      })
  })
})
</script>