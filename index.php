<?php
  ini_set('display_errors', 1);
  ini_set('displat_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  include("classes.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <!--10s0u0kllllaFw0g0qFqFg0w0aF-->
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>pizza</title>
    <script>
      //fixed header
      function get(){
        if($('#logo').offset().top - $(window).scrollTop() < -210 && $("#logo2").css("opacity")==0){
          $("#logo2").css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
        }else if($('#logo').offset().top - $(window).scrollTop() >= -210 && $("#logo2").css("opacity")>0){
          $("#logo2").css({opacity: 1.0, visibility: "visibility"}).animate({opacity: 0.0});
        }

      }
      window.setInterval(get, 400);

      //load htmls
      function setAbout(){
        $("#content").load("about.php", function(){
          select("navabout");
        });
      }
      function setMenu(){
        $("#content").load("menu.php", function(){
          select("navmenu");
        });
      }
      function setDelivery(){
        $("#content").load("delivery.php", function(){
          select("navdelivery");
        });
      }
      function select(id){
        $("#navabout").attr('class', 'navelement');
        $("#navmenu").attr('class', 'navelement');
        $("#navdelivery").attr('class', 'navelement');
        $("#".concat(id)).attr('class', 'navelement navselected');
        $('html, body').animate({
          scrollTop: $("#nav").offset().top-70
        }, 800);
      }

    </script>
  </head>

  <body>
    <div id="top"></div>

    <div id="logo2">
      <a href="#top">
        <div id="logoname2">
          PIZZA
        </div>
      </a>
    </div>
    <script>
    //smooth scrolling
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
      });
    </script>
    <div id="account" >
      <a href="./">
        <div class="accountelement">
          Login
        </div>
        <div class="accountelement">
          Register
        </div>
      </a>
    </div>
    <div id="logo">
      <div id="logoname">
        PIZZA
      </div>
    </div>

    <div id="nav">
        <div id="navabout" class="navelement" onclick="setAbout()">About Us</div>
        <div id="navmenu" class="navelement" onclick="setMenu()">Menu</div>
        <div id="navdelivery" class="navelement" onclick="setDelivery()">Delivery</div>
    </div>
    <script>
    </script>

    <div id="content">

    </div>

  </body>
</html>
