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


       <div class="form-group">
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
    <label for="rcard">Photocopy of Birth Certificate</label>
    
  </div>
  <div class="form-group">
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
    <label for="rcard">1x1 ID Picture</label>
    
  </div>
  <div class="form-group">
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
    <label for="rcard">Good Moral Certificate</label>
    
  </div>
  <div class="form-group">
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
    <label for="rcard">Barangay Clearance</label>
    
  </div>
    <div class="form-group">
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
    <label for="rcard">Financial Assessment (from private school)</label>