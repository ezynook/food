<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>javascript</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>
<body>
<button class="nine btn btn-success" >Save</button>
<button onclick"myfunction()">Save</button>
<button class="nine2 btn btn-danger">Clear</button>
<input type="text" name="" class="text form-control" style="width: 300px;" id="">
 <script src="style/jquery.min.js"></script>  
 <script>
   $('.nine').click(function(){
        $('.text').val('nine')
        $('.text').addClass('bg-danger')
   })
   $('.nine2').click(function(){
     $('.text').val('')
     $('.text').addClass('bg-light').alert('nosuccess')
   })
   function myfunction(){
     alert('hoo');
   }
 </script> 

</body>
</html>