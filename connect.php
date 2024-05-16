<?php
  $connect = mysqli_connect(hostname:"localhost", username:"root", password:"" , database:"Exam");
  if(!$connect){
    die("Нет подключения к базе данных");
  }