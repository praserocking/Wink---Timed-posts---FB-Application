<?php
session_start();
$_SESSION['status']=$_GET['status'];
$_SESSION['userid']=$_GET['userid'];
if(isset($_GET['posturl']))
    $_SESSION['posturl']=$_GET['posturl'];
?>
<html>
    <head>
        <title></title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery-clockpicker.min.css" />
        <link type="text/css" rel="stylesheet" href="css/timeselect.css" />
        <link type="text/css" rel="stylesheet" href="css/bootstrap-datepicker.css" />
        <link type="text/css" rel="stylesheet" href="css/reset.css" />
        <script type="text/javascript" src="js/jquery.js" > </script>
        <script type="text/javascript" src="js/jquery-clockpicker.min.js"  > </script>
        <script type="text/javascript" src="js/bootstrap-datepicker.js"  > </script>
        <style>
            #post:hover{
                color:white;
            }
        </style>
    </head>
    <body>
        
            <div class="formele">
             <input id="datePicker" placeholder="Date" class="inputele" value="" placeholder="Date">
            </div>
            <div class="formele">
             <input id="timePicker" placeholder="Time" class="inputele" value="" data-default="12:00" placeholder="Time">
            </div>
            
           <div id="post">
               <img src="icons/timer.png"/>
           </div>
            
            <div id="footer">
                <img src="icons/logo.png"/>
            </div>

    </body>
    <script type="text/javascript">
        $(function()
        {
            var timePicker=$('#timePicker');
            var datePicker=$('#datePicker');
            timePicker.clockpicker({
                autoclose: true
            });
            
            datePicker.datepicker({
            'format': 'yyyy-m-d',
            'autoclose': true
            }); 
            
            $('#post').click(function(){
                expiryTime=$('#datePicker').val()+" "+$('#timePicker').val()+":00";
                location.replace("frame.php?expiry_time="+expiryTime);
            });
        });
        
    </script>
</html>
    