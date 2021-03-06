<?php
$html = '

<!DOCTYPE html>
<html>
<head>
  <title></title>
  
</head>
<body style="background: #ffffff;font-family: \'Montserrat\', sans-serif;margin: 0;padding: 0;">

<div class="tc" style="
    height: 30%;
    width: 30%;
    border: 2px solid;
    margin-top: 40px;
    margin-left: 20%;
    background-color: #d25252;">


<div class="ticket" style="
 display: flex;
    justify-content: center;
    align-items: center;
    width: 345px;
    margin: -20px auto;
                          
  
  .stub, .check {
    box-sizing: border-box;
  }">


  <div class="stub" style="
    height: 173px;
    width: 130px;
    
    padding: 20px;
                           margin-left:-80px; 
    position: relative;
    border: 5px solid;
    border-color: #ffffff;
  
 ">



    <div class="top" style=" display: flex;
    align-items: center;
    height: 40px;
    text-transform: uppercase;

      span.admit {
    border: 2px solid;
    margin-left: -11px;
    font-size: 25px;
} .line {
      display: block;background: rgba(210, 82, 82, 1);height: 40px;width: 3px;margin: 0 20px; }span.line { margin-left: 4px; border: 1px solid;border-color: #fff;height: 60px;} .num {font-size: 10px;span {color: #000;}">
     <span class="admit" style="border: 2px solid;margin-left: -11px;font-size: 25px;  }span.admit {border: 2px solid;margin-left: -11px;font-size: 12px;"></span>
      <span class="line"></span>
     <span class="num" style="margin-left: 17px;font-size: 17px;border: 2px dotted;">
        Ticket Type:
        <span>Monthly</span>
      </span>
      
    </div>


   <div class="number" style="
    position: absolute;
    left: 43px;
    font-size: 45px;
    margin-top: 110px;
"><i class="fa fa-taka"></i>1500 </div>



    <div class="cost" style="
    position: absolute;
    left: 60px;
    bottom: 70px;
    color: #fff;
    width: 40%;
    &amp;:before {content: \'\';background: #fff; display: block;width: 40px; height: 3px;margin-bottom: 5px; }">Total Cost
    </div>


  </div>


  <div class="check" style=" height: 205px; margin-left:-126px; width: 220px; padding: 40px; position: relative;color:#fff;
  
  &amp;:before { content: \'\'; position: absolute; top: 0; left: 0;border-top: 20px solid #dd3f3e;border-right: 20px solid #fff; width: 0;} &amp;:after { content: \'\';  position: absolute; bottom: 0; left: 0; border-bottom: 20px solid #dd3f3e;border-right: 20px solid #fff; width: 0;}">
   

    <div class="big" style=" font-size: 40PX;font-weight: 700;margin-left:95px; line-height: .8em;"> METRO RAIL <br> BD
    </div>


    <div class="number" style=" position: absolute; top: 90px; right: 50px;color: #fff;font-size: 40px;">#1</div>


     <div class="info" style="display: flex;justify-content: flex-start; font-size: 12px;margin-top: 85px;width: 100%;">  

      <section style=\'margin-left: 100px;\'>
        <div class="title" >Date</div>
        <div>14/5/2018</div>

      </section>
     

      <section >
        <div class="title" >TICKET NO</div>


        <div style="margin-left: 5px;">1234567890</div>
      </section>
      

      <section >
        <div class="title" style="font-size: 10px;text-transform: uppercase; margin-left: 20px;">Your Rout</div>
        <div style=" margin-left: 20px;">Dhanmondi-Notun Bazar</div>
      </section>
    </div>
  </div>
</div>

</div>
</body>
</html>
';
use Mpdf\Mpdf;

require_once '../vendor/autoload.php';

$mpdf = new Mpdf([
    'orientation' => 'L'
]);
$stylesheet = file_get_contents('../custom/css/ticket.css'); // external css

//$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
//$mpdf->WriteHTML(file_get_contents('../ticket.php'),2);
$mpdf->SetDisplayMode('fullwidth');

//call watermark content aand image
$mpdf->SetWatermarkText('Metro Rail BD');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;


//save the file put which location you need folder/filname
//$mpdf->Output("../PDF/phpflow.pdf", 'F');


//out put in browser below output function
$mpdf->Output();
