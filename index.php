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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

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

      //account
      function logout(){
        if(sessionStorage.getItem("user")){
          sessionStorage.removeItem("user");
          document.getElementById("account").innerHTML="<div id=\"login\" class=\"accountelement\">Login</div>";
          document.getElementById("account").innerHTML+="<div id=\"register\" class=\"accountelement\">Register</div>";
          document.querySelector("#login").addEventListener("click", login);
          document.querySelector("#register").addEventListener("click", register);
        }
      }
      function login(){
        swal({
          title: "login",
          html:
            "username:<input id=\"username\" class=\"swal2-input\">" +
            "password:<input id=\"password\" type=\"password\" class=\"swal2-input\">",
          showCloseButton: true,
          showCancelButton: true,
          cancelButtonText: "register",
          focusConfirm: false,
          preConfirm: function(){
            return new Promise(function(resolve){
              resolve([
                $("#username").val(),
                $("#password").val()
              ]);
            });
          },
          allowOutsideClick: false,
          confirmButtonColor: "#000"
        }).then(function(result){
          if(result.dismiss==='cancel'){
            swal.close();
            register();
          }
          $.ajax({
            type: "POST",
            url: "login.php",
            data: {
              "username":result["value"][0],
              "password":result["value"][1]
            },
            cashe: false,
            success: function(response){
              if(!response["valid"]){
                swal({
                  title: "Invalid username and password combination",
                  confirmButtonColor: "#000"
                }).then(login);
              }else{
                swal({
                  title: "Welcome! "+result["value"][0],
                  confirmButtonColor: "#000"
                }).then(function(){
                  sessionStorage.setItem("user", result["value"][0]);
                  document.getElementById("account").innerHTML="<div id=\"logout\" class=\"accountelement\">Log out</div>";
                  document.querySelector("#logout").addEventListener("click", logout);
                });
              }
            },
            failure: function(response){
              swal("login failed")
            }
          })
        }).catch(swal.noop);
      }

      function register(){
        swal({
          title: "register",
          html:
            "username:<input id=\"username\" class=\"swal2-input\">" +
            "password:<input id=\"password\" type=\"password\" class=\"swal2-input\">" +
            "address:<input id=\"address\" class=\"swal2-input\">" +
            "first name:<input id=\"FName\" class=\"swal2-input\">" +
            "last name:<input id=\"LName\" class=\"swal2-input\">",
          showCloseButton: true,
          focusConfirm: false,
          preConfirm: function(){
            return new Promise(function(resolve){
              resolve([
                $("#username").val(),
                $("#password").val(),
                $("#address").val(),
                $("#FName").val(),
                $("#LName").val()
              ]);
            });
          },
          allowOutsideClick: false,
          confirmButtonColor: "#000"
        }).then(function(result){
          $.ajax({
            type: "POST",
            url: "register.php",
            data: {
              "username":result["value"][0],
              "password":result["value"][1],
              "address":result["value"][2],
              "FName":result["value"][3],
              "LName":result["value"][4]
            },
            cashe: false,
            success: function(response){
              if(!response["valid"]){
                swal({
                  title: "username already exists",
                  confirmButtonColor: "#000"
                }).then(register);
              }else{
                swal({
                  title: "Welcome! "+result["value"][0],
                  confirmButtonColor: "#000"
                }).then(function(){
                  sessionStorage.setItem("user", result["value"][0]);
                  document.getElementById("account").innerHTML="<div id=\"logout\" class=\"accountelement\">Log out</div>";
                  document.querySelector("#logout").addEventListener("click", logout);
                });
              }
            },
            failure: function(response){
              swal("fail")
            }
          })
        }).catch(swal.noop);
      }
      window.onload = function(){
        if(sessionStorage.getItem("user")){
          document.getElementById("account").innerHTML="<div id=\"logout\" class=\"accountelement\">Log out</div>";
          document.querySelector("#logout").addEventListener("click", logout);
        }else{
          document.getElementById("account").innerHTML="<div id=\"login\" class=\"accountelement\">Login</div>";
          document.getElementById("account").innerHTML+="<div id=\"register\" class=\"accountelement\">Register</div>";
          document.querySelector("#login").addEventListener("click", login);
          document.querySelector("#register").addEventListener("click", register);
        }

      };
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
    </div>

    <div id="logo">
      <a href="./">
        <div id="logoname">
          PIZZA
        </div>
      </a>
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
