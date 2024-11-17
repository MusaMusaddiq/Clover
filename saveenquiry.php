<?php

if(isset($_POST['SaveEnquiry'])){

  $Name = $_POST['Name'];
  $Email = $_POST['Email'];
  $Phone = $_POST['Phone'];
  $Subject = $_POST['Subject'];
  $Message = $_POST['Message'];
  
$to  = 'nextasoftllc@gmail.com';  
// subject

$subject = "New " . $Subject ." Enquiry!";
$message = '<table height="40%" width="100%" align="" border="1" style="background: #f2f2f2;border-collapse: collapse;">
     <tbody>
     <tr>
       <td width="42%" align="center" class="cntnt"><span class="style9">Name</span></td>
       <td class="cntnt" width="5%" align="center">:</td>
       <td width="53%" height="30">'.$_POST['Name'].'</td>
     </tr>
     <tr>
       <td width="42%" align="center" class="cntnt"><span class="style9">Email</span></td>
       <td class="cntnt" width="5%" align="center">:</td>
       <td width="53%" height="30">'.$_POST['Email'].'</td>
     </tr>
     <tr>
       <td class="cntnt" align="center"><span class="style9">Phone</span></td>
       <td class="cntnt" align="center">:</td>
       <td height="30">'.$_POST['Phone'].'</td>
     </tr>
     <tr>
       <td class="cntnt" align="center"><span class="style9">Subject</span></td>
       <td class="cntnt" align="center">:</td>
       <td height="30">'.$_POST['Subject'].' </td>
     </tr>
     <tr>
       <td class="cntnt" align="center"><span class="style9">Message</span></td>
       <td class="cntnt" align="center">:</td>
       <td height="30">'.$_POST['Message'].'</td>
     </tr>
    </tbody>
 </table>
';


// //echo $message;exit;

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers
$abc= substr($_POST['Name'],0,8);
// More headers
$headers .= 'From: '.$Email.  "\r\n";
// Mail it
mail($to, $subject, $message, $headers);
// echo '<script>$("#myModal").modal("show"); setTimeout(function() {$("#myModal").modal("hide");}, 3000);</script>';
header("Location:../thank-you.php"); 




}

