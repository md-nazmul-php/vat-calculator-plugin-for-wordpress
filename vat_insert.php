<?php
 global $wpdb;//global declare database

  $table_name = $wpdb->prefix . 'vatcalculator';
  if (isset($_POST['newsubmit'])) {
  $country = $_POST['country'];
  $vat = $_POST['vat'];
  $wpdb->query("INSERT INTO $table_name(country, vat) VALUES('$country','$vat')");//insert query

  echo "<script>location.replace('admin.php?page=vat-calculator%2Fvat-calculator.php');</script>";
  }
// start update query set
 if (isset($_POST['uptsubmit'])) {
    $id = $_POST['uptid'];
    $country = $_POST['uptcountry'];
    $vat = $_POST['uptvat'];
    $wpdb->query("UPDATE $table_name SET country='$country', vat='$vat'WHERE id='$id' ");

 echo "<script>location.replace('admin.php?page=vat-calculator%2Fvat-calculator.php');</script>";
  }
// Detele query

  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");

    echo "<script>location.replace('admin.php?page=vat-calculator%2Fvat-calculator.php');</script>";//delete query
  }
  

  echo '<div class="wrap"><br><hr>

    <h2 style="text-align: center;">VAT data entry Here and instractions </h2><br>
   
     <p style="text-align: center;">Use shortcode <b>[vat-calculator]</b> any where in your page and posts to display the table. <br> Insert country name and its vat rate value and you can use float and integer types value too like 5 or 5.87 </p><br>
    <table class="wp-list-table widefat striped" style="text-align: left;">
      <thead>
        <tr>
          <th width="25%">ID</th>
          <th width="25%">Country Name</th>
          <th width="25%">VAT Rate</th>
      
    

          <th width="20%">Actions</th>
        </tr>

      </thead> 
      <tbody>


        <form action="" method="post">
          <tr>
            <td><input type="text" value="AUTO_GENERATED" disabled></td>

            <td><input type="text" id="country" name="country" onkeydown="lowerCaseF(this)"  placeholder="UNITED KINGDOM"></td>

                    
            <td><input type="number" id="insertfield" step=any name="vat" placeholder="14"></td>

          
          
            <td><button id="newsubmit" name="newsubmit" type="submit">INSERT</button></td>
          </tr>
        </form>';?>




        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
           echo "
              <tr>
                <td width='20%'>$print->id</td>
                <td width='20%'>$print->country</td>
                <td width='20%'>$print->vat</td>
                <td width='30%'>
                <a href='admin.php?page=vat-calculator%2Fvat-calculator.php&upt=$print->id'><button type='button'>Edit </button></a>
                 <a href='admin.php?page=vat-calculator%2Fvat-calculator.php&del=$print->id'><button type='button'>Delete</button></a></td>
              </tr>
            ";
          } 
     echo '</tbody>  
          </table>
          <br>';?>
   

    <?php
      if (isset($_GET['upt'])) {
        $upt_id = $_GET['upt'];
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
        foreach($result as $print) {
  
    $currencyname = $print->country;
    $action = $print->vat;
 

        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>

                <td width='20%'>$print->id <input type='hidden' id='uptid' name='uptid' value='$print->id'></td>
                <td width='20%'><input type='text'   id='uptcountry' name='uptcountry' value='$print->country'></td>
                <td width='20%'><input type='number' step=any id='vat' name='uptvat' value='$print->vat'></td>
              <td width='10%'><button id='uptsubmit' name='uptsubmit' type='submit'>UPDATE</button> <a href='admin.php?page=vat-calculator%2Fvat-calculator.php'><button type='button'>CANCEL</button></a></td>
             
              </tr>
            </form>
          </tbody>
        </table>";}
    echo "</div>";
    ?>