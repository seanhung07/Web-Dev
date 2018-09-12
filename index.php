<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>pizza</title>
  </head>

  <header>
    <a href="./">
      <h1 id="logo">pizza</h1>
    </a>
    <table id="nav">
      <tr>
        <th class="navelement">About Us</th>
        <th class="navelement">Menu</th>
        <th class="navelement">Deliver</th>
      </tr>
    </table>
  </header>

  <body>
    <div id="content">
      <div id="myCarousel" class="c carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="img/pizza1.jpg" alt="Los Angeles">
          </div>

          <div class="item">
            <img src="img/pizza2.jpg" alt="Chicago">
          </div>

          <div class="item">
            <img src="img/pizza3.jpg" alt="New York">
          </div>
        </div>



        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </body>
</html>
