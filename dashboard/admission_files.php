<?php 
require_once("../class.user.php");
$admfile = new USER();
$adms_ID = $_REQUEST["admission_ID"]; 
$sqz = "SELECT * FROM `admission_attachment` WHERE admission_ID = $adms_ID";
$radmsstatement = $admfile->runQuery($sqz);
$radms = $radmsstatement->execute();
$radmsresult = $radmsstatement->fetchAll();
$adl = array();
foreach($radmsresult as $row)
{
    $attachment_ID = $row["attachment_ID"];
    $attachment_Name = json_decode($row["attachment_Name"]);


    if(isset($row["attachment_Data"])){

      $adl[$attachment_Name[0]]['icon'] = 'success';
      // $adl[$attachment_Name[0]]['href'] = 'href="download?attachment_ID='.$attachment_ID.'&'.$attachment_Name[0].'='.$adms_ID.'"';
      $adl[$attachment_Name[0]]['href'] = 'href="data:'.$row["attachment_MIME"].';base64,'.base64_encode($row['attachment_Data']).'"';

      $adl[$attachment_Name[0]]['preview'] = 'href="preview?attachment='.$attachment_ID.'"  target="_BLANK"';

      $adl[$attachment_Name[0]]['dl'] = 'download=""';
    }
    else{
      $adl[$attachment_Name[0]]['icon'] = 'danger';
      $adl[$attachment_Name[0]]['href'] = 'href="#"';
      $adl[$attachment_Name[0]]['dl'] = 'disabled=""';
      $adl[$attachment_Name[0]]['preview'] = 'href="#" disabled';
    }
   
  
}


?>

<div class="col-sm-12">
  <div class="form-group">
      <div class="btn-group  float-left" role="group" aria-label="Basic example">
      <a class="btn btn-<?php 
      if(isset($adl['rcard']['icon'])){
         echo $adl['rcard']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['rcard']['href'])){
        echo $adl["rcard"]['href'].' ';
      }
      else{
         echo 'href="#"';
      }
      if(isset($adl["rcard"]['dl'])){
        echo $adl["rcard"]['dl'];
      }
      else{
        echo 'disabled=""';
      }
      ?>><i class="icon-download"></i></a>
          <a class="btn btn-<?php 
      if(isset($adl['rcard']['icon'])){
         echo $adl['rcard']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['rcard']['preview'])){
        echo $adl["rcard"]['preview'].' ';
      }
      else{
         echo 'href="#"';
      }
    
      ?>><i class="icon-eye"></i></a>
    </div>
    <label for="rcard">Report Card</label>
    
  </div>
  <div class="form-group">
      <div class="btn-group  float-left" role="group" aria-label="Basic example">
      <a class="btn btn-<?php 
      if(isset($adl['bcert']['icon'])){
         echo $adl['bcert']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['bcert']['href'])){
        echo $adl["bcert"]['href'].' ';
      }
      else{
         echo 'href="#"';
      }
      if(isset($adl["bcert"]['dl'])){
        echo $adl["bcert"]['dl'];
      }
      else{
        echo 'disabled=""';
      }
      ?>><i class="icon-download"></i></a>
          <a class="btn btn-<?php 
      if(isset($adl['bcert']['icon'])){
         echo $adl['bcert']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['bcert']['preview'])){
        echo $adl["bcert"]['preview'].' ';
      }
      else{
         echo 'href="#"';
      }
    
      ?>><i class="icon-eye"></i></a>
    </div>
    <label for="rcard">Photocopy of Birth Certificate</label>
    
  </div>
  <div class="form-group">

      <div class="btn-group  float-left" role="group" aria-label="Basic example">
      <a class="btn btn-<?php 
      if(isset($adl['pic1x1']['icon'])){
         echo $adl['pic1x1']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['pic1x1']['href'])){
        echo $adl["pic1x1"]['href'].' ';
      }
      else{
         echo 'href="#"';
      }
      if(isset($adl["pic1x1"]['dl'])){
        echo $adl["pic1x1"]['dl'];
      }
      else{
        echo 'disabled=""';
      }
      ?>><i class="icon-download"></i></a>
          <a class="btn btn-<?php 
      if(isset($adl['pic1x1']['icon'])){
         echo $adl['pic1x1']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['pic1x1']['preview'])){
        echo $adl["pic1x1"]['preview'].' ';
      }
      else{
         echo 'href="#"';
      }
    
      ?>><i class="icon-eye"></i></a>
    </div>
    <label for="rcard">1x1 ID Picture</label>
    
  </div>
  <div class="form-group">
      <div class="btn-group  float-left" role="group" aria-label="Basic example">
      <a class="btn btn-<?php 
      if(isset($adl['gmoralcert']['icon'])){
         echo $adl['gmoralcert']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['gmoralcert']['href'])){
        echo $adl["gmoralcert"]['href'].' ';
      }
      else{
         echo 'href="#"';
      }
      if(isset($adl["gmoralcert"]['dl'])){
        echo $adl["gmoralcert"]['dl'];
      }
      else{
        echo 'disabled=""';
      }
      ?>><i class="icon-download"></i></a>
          <a class="btn btn-<?php 
      if(isset($adl['gmoralcert']['icon'])){
         echo $adl['gmoralcert']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['gmoralcert']['preview'])){
        echo $adl["gmoralcert"]['preview'].' ';
      }
      else{
         echo 'href="#"';
      }
    
      ?>><i class="icon-eye"></i></a>
    </div>
    <label for="rcard">Good Moral Certificate</label>
    
  </div>
  <div class="form-group">
      <div class="btn-group  float-left" role="group" aria-label="Basic example">
      <a class="btn btn-<?php 
      if(isset($adl['brgyclrnc']['icon'])){
         echo $adl['brgyclrnc']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['brgyclrnc']['href'])){
        echo $adl["brgyclrnc"]['href'].' ';
      }
      else{
         echo 'href="#"';
      }
      if(isset($adl["brgyclrnc"]['dl'])){
        echo $adl["brgyclrnc"]['dl'];
      }
      else{
        echo 'disabled=""';
      }
      ?>><i class="icon-download"></i></a>
          <a class="btn btn-<?php 
      if(isset($adl['brgyclrnc']['icon'])){
         echo $adl['brgyclrnc']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['brgyclrnc']['preview'])){
        echo $adl["brgyclrnc"]['preview'].' ';
      }
      else{
         echo 'href="#"';
      }
    
      ?>><i class="icon-eye"></i></a>
    </div>
    <label for="rcard">Barangay Clearance</label>
    
  </div>
    <div class="form-group">
       <div class="btn-group  float-left" role="group" aria-label="Basic example">
      <a class="btn btn-<?php 
      if(isset($adl['financial']['icon'])){
         echo $adl['financial']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['financial']['href'])){
        echo $adl["financial"]['href'].' ';
      }
      else{
         echo 'href="#"';
      }
      if(isset($adl["financial"]['dl'])){
        echo $adl["financial"]['dl'];
      }
      else{
        echo 'disabled=""';
      }
      ?>><i class="icon-download"></i></a>
          <a class="btn btn-<?php 
      if(isset($adl['financial']['icon'])){
         echo $adl['financial']['icon'];
      }
      else{
          echo 'danger';
      }
     
      ?>" 
      <?php 
      if(isset($adl['financial']['preview'])){
        echo $adl["financial"]['preview'].' ';
      }
      else{
         echo 'href="#"';
      }
    
      ?>><i class="icon-eye"></i></a>
    </div>
    <label for="rcard">Financial Assessment (from private school)</label>
    
  </div>
</div>