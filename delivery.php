<script>
  var arr = JSON.parse(sessionStorage.getItem("order"));
  function loadDelivery(){
    arr = JSON.parse(sessionStorage.getItem("order"));
    if(arr==null){
      arr=[];
    }
    for(i=0; i<arr.length; i++){
      document.getElementById("deliverycontainer").innerHTML +=
      "<div class=\"deliveryitem\">" +
        "<img src=\"img/menu/" + arr[i][0] +"\"/>" +
        "<div class=\"deliveryname\">" +
          arr[i][0].split(".")[0] + "*" + arr[i][1] +
        "</div>" +
        "<i class=\"delete fa fa-trash\"/>" +
        "<i class=\"edit far fa-edit\"/>" +
      "</div>";
    }
    setonclick();
  }
  function setonclick(){
    var x = document.getElementsByClassName("deliveryitem");
    for(var j=0; j<x.length; j++){
      childarr=x[j].children;
      childarr[2].onclick = function(){
        var b;
        for(var i=0; i<arr.length; i++){
          srcarr=childarr[0].src.split("/");
          if(arr[i][0]==srcarr[srcarr.length-1]){
            b=i;
          }
        }
        arr.splice(b, b+1);
        sessionStorage.setItem("order", JSON.stringify(arr));
        document.getElementById("deliverycontainer").innerHTML="";
        loadDelivery();
      };
      childarr[3].onclick = function(){
        swal({
          title: name,
          html:
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
          confirmButtonText: "Edit",
          preConfirm: function(){
            return new Promise(function(resolve){
              resolve([
                $("#amount").val()
              ]);
            });
          },
        }).then(function(result){
          if(result.value){
            var arr = JSON.parse(sessionStorage.getItem("order"));
            var exist=false;
            var srcarr=childarr[0].src.split("/");
            var path=srcarr[srcarr.length-1];
            for(var i=0; i<arr.length; i++){
              if(arr[i][0]==path){
                arr[i][1]=parseInt(result["value"][0]).toString();
              }
            }
            sessionStorage.setItem("order", JSON.stringify(arr));
            document.getElementById("deliverycontainer").innerHTML="";
            loadDelivery();

          }
        })
      };
    }
  }
  loadDelivery();
  $(document).ready(function(){

  });
</script>
<div id="deliverycontainer">

</div>
