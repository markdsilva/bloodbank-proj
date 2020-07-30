<?php
  $db = new mysqli('localhost','root','Saish@123','bloodbank1');//set your database handler
  $query = "SELECT id,name FROM states";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $states[] = array("id" => $row['id'], "val" => $row['name']);
  }

  $query = "SELECT id, state_id, name FROM districts";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $districts[$row['state_id']][] = array("id" => $row['id'], "val" => $row['name']);
  }

  $jsonStates = json_encode($states);
  $jsonDistricts = json_encode($districts);


?>
<html>

  <head>
    <script type='text/javascript'>
      <?php
        echo "var states = $jsonStates; \n";
        echo "var districts = $jsonDistricts; \n";
      ?>
      function loadStates(){
        var select = document.getElementById("statesSelect");
        select.onchange = updateDistricts;
        for(var i = 0; i < states.length; i++){
          select.options[i] = new Option(states[i].val,states[i].id);          
        }
      }
      function updateDistricts(){
        var statesSelect = this;
        var state_id = this.value;
        var districtSelect = document.getElementById("districtsSelect");
        districtSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < districts[state_id].length; i++){
          districtSelect.options[i] = new Option(districts[state_id][i].val,districts[state_id][i].id);
        }
      }
    </script>

  </head>

  <body onload='loadStates()'>
    <select id='statesSelect'>
    </select>

    <select id='districtsSelect'>
    </select>
  </body>
</html>


<?php
  $db = new mysqli('localhost','root','Saish@123','bloodbank1');//set your database handler
  $query = "SELECT id,name FROM states";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $states[] = array("id" => $row['id'], "val" => $row['name']);
  }

  $query = "SELECT id, state_id, name FROM districts";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $districts[$row['state_id']][] = array("id" => $row['id'], "val" => $row['name']);
  }

  
  // $query = "SELECT id, district, name FROM bloodbank";
  // $result = $db->query($query);

  // while($row = $result->fetch_assoc()){
  //   $bloodbank[$row['district']][] = array("id" => $row['id'], "val" => $row['name']);
  // }

  $jsonStates = json_encode($states);
  $jsonDistricts = json_encode($districts);
  // $jsonBloodbank = json_encode($bloodbank);

?>