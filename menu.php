
<script>
  function popup(path){
    var name=path.split(".")[0];
    $.get("resources/" + name + ".html", function(response){
      swal({
        title: name,
        text: response,
        html:
          response +
          "<br><br>Amount<br><select id=\"amount\" class=\"selectoption\" ><option value=\"1\">1</option>"+
          "<option value=\"2\">2</option>"+
          "<option value=\"3\">3</option>"+
          "<option value=\"4\">4</option>"+
          "<option value=\"5\">5</option>"+
          "<option value=\"6\">6</option>"+
          "<option value=\"7\">7</option>"+
          "<option value=\"8\">8</option>"+
          "<option value=\"9\">9</option>"+
          "<option value=\"10\">10</option>"+
          "</select>",
        showCancelButton: true,
        confirmButtonText: "Add to cart",
        preConfirm: function(){
          return new Promise(function(resolve){
            resolve([
              $("#amount").val()
            ]);
          });
        },
      }).then(function(result){
        if(result.value){
          if(sessionStorage.getItem("user")){
            if(sessionStorage.getItem("order")){
              var arr = JSON.parse(sessionStorage.getItem("order"));
              var exist=false;
              for(var i=0; i<arr.length; i++){
                if(arr[i][0]==path){
                  arr[i][1]=Math.min((parseInt(arr[i][1])+parseInt(result["value"][0])).toString(), 10);
                  exist=true;
                }
              }
              if(!exist){
                arr.push([path,result["value"][0]]);
              }
              sessionStorage.setItem("order", JSON.stringify(arr));
            }else{
              sessionStorage.setItem("order", JSON.stringify([[path,result["value"][0]]]));
            }
          }else{
            login();
          }
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
        echo "<td><div class=\"menuitem\"  onclick=popup(\"" . $path . "\")><img src=\"img/menu/" . $path . "\"/>" . $name . "</div></td>";
      }
      echo "</tr>";
    }
  ?>
</table>
