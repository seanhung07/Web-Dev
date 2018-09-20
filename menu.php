<script>
  function popup(name){
    $.get("resources/" + name + ".html", function(response){
      swal({
        title: name,
        text: response,
        showCancelButton: true,
        confirmButtonText: "Add to cart"
      }).then(function(result){
        if(result.value){
          swal("added")
        }
      })
    });

  }
</script>
<table id="menu">
  <div id="menutop"></div>
  <?php
    ini_set('display_errors', 1);
    ini_set('displat_startup_errors', 1);
    error_reporting(E_ALL);
    $items=scandir("./img/menu");
    for($i=0; $i<ceil(count($items)/3); $i++){
      echo "<tr>";
      for($j=0; $j<min(3,count($items)-$i*3-$j-2); $j++){
        $path=$items[$i*3+$j+2];
        $name=explode(".", $path)[0];
        echo "<td><div class=\"menuitem\"  onclick=popup(\"" . $name . "\")><img src=\"img/menu/" . $path . "\"/>" . $name . "</div></td>";
      }
      echo "</tr>";
    }
  ?>
</table>
