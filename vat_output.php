<?php

 function wpb_fx_shortcode() { 
  global $wpdb;
  ob_start();
   $table_name = $wpdb->prefix . 'vatcalculator';?>

<script type="text/javascript">

     function Vat(){         
      var vat_rate=parseFloat(document.vat_form.vat_r.value);
      var tax_action=document.vat_form.tax_action.value;
      var amount=parseFloat(document.vat_form.amount.value);

      if(tax_action=='add_tax'){
          
        var tax_amount = ( amount*vat_rate)/100;
        var net_price=amount+tax_amount;
        document.getElementById("vat").innerHTML ="Result = "+ net_price.toFixed(2);

      }else if(tax_action=='remove_tax'){
          var tax_amount = ( amount*vat_rate)/100;
        var net_price=amount-tax_amount;
        document.getElementById("vat").innerHTML ="Result = "+ net_price.toFixed(2);
      }


     }
   // for clear all from the form
     function clearvat(elementID){
        document.getElementById(elementID).innerHTML = "";
      }
     
    // function for get vat by change function

    function ChangeVat() {
         var vatRate =document.getElementById("country").value;
         var aa=vatRate.toString();
         document.getElementById("vat_r").value = aa;
        }
                
                
   </script>


<style type="text/css">


.main-div select{
      color:black;
    border:1px solid #e4ddcb;
    border-radius:8px;
    background-color:#f7f5f4;
 
    
}

.main-div td{
    
    margin-left:5px;
}
.main-div input, textarea, button{    
    padding:10px !important;
    color:black;
    border:1px solid #e4ddcb;
    border-radius:8px;
    background-color:#f7f5f4;
}

  table td, table th{
    border: none;
  }
  .main-div{
    max-width:560px;
    margin: 0 auto;
    background-color: #f4efe3;
    padding: 10px;
    border:2px solid #e4ddcb;
    border-radius:5px;
    font-family:time new roman;
    position:relative;
  }
  td{
      width:50%;
      pdding-left:2%;
  }
  .fixed-wide{
    margin-left: 0px;
  }  
#calculate{      
    width:100%;
   margin-right:3%;
   float:left;
   background-color: #f96e5b;
   color:white;
  }
  #calculate:hover{
   background-color: white;
   color:black;
  }
  
   #reset:hover{
    background-color: white;
   color:black;
  }
  #reset{
      
    width:100%;
   margin-left:2%;
   float:right;
  }  
  
  #h6-mr{
    margin-left: 5px;
  }
  #vat{
    text-align: center;
    font-weight: bold;
  }
</style>

<div class="main-div">
  <form name="vat_form" method="post" action="">
   <table>      
        <tr>
               <td style="padding-right:5px;">
        <h6 id="h6-mr"> Select Country</h6>
        <select class='fixed-wide' name='country' id="country" onchange="ChangeVat();">
          <option value="">Select</option>
        <?PHP
        $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
           echo "<option value='$print->vat'>$print->country </option>";
          }
          echo "</select>.</td>.<td>";?>
       
      
                <h6 id="h6-mr"> VAT Rate</h6>
                <!-- <div id="vat_r"></div> -->
                <input class="fixed-wide" type="text" name="vat_rate" id="vat_r" />
              </td>
        
     </tr> 
    <tr> 
    
         <td>
              <h6 id="h6-mr"> Enter Amount</h6>
               <input class="fixed-wide" type="number" name="amount"/>
            </td>
  
              <td>
                <h6 id="h6-mr">Select</h6>
                <select class="fixed-wide" name="tax_action">
                  <option value="add_tax">Add TAX</option>
                  <option value="remove_tax">Remove Tax</option>
               
                </select>
              </td>   
              
           
              
    </tr>
            <tr>
         
              <td>
                <button  id="calculate" class="fixed-wide" onclick="Vat();return false;">Calculate</button>
              </td>           
               <td>            
                <button id="reset" class="fixed-wide" type="reset"  onclick="clearvat('vat')"return false;>Reset</button>
              </td>             
              </tr>            
      
              <tr>
                 <td colspan="2">
                  <output class="fixed-wide" id="vat"></output>
                  </td> 
              </tr>               
     
  </table>
 
  </form>  
  
</div>


<?php

return ob_get_clean();

//echo print_r($result, true);
} 

add_shortcode('vat-calculator', 'wpb_fx_shortcode'); ?>