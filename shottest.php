<?php




function endpoint_tikun(){
   wp_localize_script('jquery','tikun',array(
     'ajax' => admin_url('admin-ajax.php')
   ));
}

add_action('wp_enqueue_scripts', 'endpoint_tikun');



add_shortcode('tikun_form', function () { // insurance form shortcode
  ob_start();
  tikun_form_html();
  return ob_get_clean();
});


function tikun_form_html()
{
?>
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+Hebrew" rel="stylesheet">
  <style>
 @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Hebrew:wght@100&display=swap');

* {
  box-sizing: border-box;
}
        [type=button], [type=submit], button {
    display: inline-block;
    font-weight: 400;
    color: #6001d3;
    text-align: center;
    white-space: nowrap;
    background-color: transparent;
    border: 1px solid #6001d3;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border-radius: 3px;
}
    [type=button]:focus, [type=button]:hover, [type=submit]:focus, [type=submit]:hover, button:focus, button:hover {
    color: #fff;
    background-color: #6001d3;
    text-decoration: none;
}
 

head {
  font-family: 'Noto Sans Hebrew', sans-serif;

}

body {
  background-color: #ffffff;
  font-family: 'Noto Sans Hebrew', sans-serif;
}


/* Firefox */
/* hide selection errows */
input[type=number] {
  -moz-appearance: textfield;
  border: none;
  border-bottom: 2px solid #204056;
}


input[type='text'] {
  font-family: 'Noto Sans Hebrew', sans-serif !important;

}
    
    .choises {
    display: flex;
    }  
    
        #validtext {
    display: none;
          color:  #6001d3;
    font-size: inherit;
      
    }
      
        .blocks input[type="radio"] {
  display: none;
}

.blocks span {
  display: inline-block;
  padding: 10px;
  text-transform: uppercase;
  border: 2px solid black;
  border-radius: 3px;
  color: #6001d3;
}
    .blocks{
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: larger;
    padding: 10px;
    }
.blocks input[type="radio"]:checked + span {
  background-color: #6001d3 ;
  color: white;
 
}
  
    #nextStep {
    display: inline-block;
 padding: 12px 24px;
 border: 1px solid #4f4f4f;
 border-radius: 4px;
      display: block;
      background-color: #6001d3 ;
  color: white;
      
    }
    
    #prevstep{
        display: inline-block;
 padding: 12px 24px;
 border: 1px solid #4f4f4f;
 border-radius: 4px;
      display: block;
      color: #6001d3;
   }
    
    
    #sendData{
    display:none;
      
 padding: 12px 24px;
 border: 1px solid #4f4f4f;
 border-radius: 4px;
     
      background-color: #6001d3 ;
  color: white;
      
    }
    
    #checkCode {
     padding: 12px 24px;
 border: 1px solid #4f4f4f;
 border-radius: 4px;
     
      background-color: #6001d3 ;
  color: white;
    }  
    
    #buttonim {
         padding: 10px !important;
          display: grid;
       flex-wrap: wrap;
    gap: 16px;
    }

    .step {
    dispaly:none !important;
    }
    
    .koteret {
       font-size: 1.2rem;
      padding: 0.5rem;
    }
    
    .tab {
     flex-wrap: wrap;
    gap: 1rem;
    font-size: larger;
    padding: 10px;
    
    }
    </style>


<div class="tab">

   <label  class="koteret" id="validtext" align="right">נא מלא את כל השדות</label>

  <div class="step" display="block">
  
    <label  class="koteret" align="right">שם</label>
    <input id="fname" type="text" placeholder="הכנס את שימך" name="fname">
  
     <label  class="koteret" align="right">גיל</label>
    
        <div  class="blocks"> 
    
    <label><input type="radio" name="gil" class="item-list" value="<50"  ><span>עד 50</span></label>
  <label><input type="radio" name="gil" class="item-list" value="51-65" ><span>51-65</span></label>
  <label><input type="radio" name="gil" class="item-list" value="66-75"  ><span>66-75</span></label>
  <label><input type="radio" name="gil" class="item-list" value=">75"  ><span>מעל 75</span></label>
  
    </div>
  </div>
    

   
    <div class="step" style="display: none;">
  
    <label class="koteret" align="right">בכדי שאוכל לבדוק את זכאותך, אצטרך הערכה משוערת של גובה החסכונות הקיימים.</label>
   <div  class="blocks"> 
    
    <label><input type="radio" name="savings"  value="300-500K"  ><span>300 ל- 500 אלף ₪</span></label>
  <label><input type="radio" name="savings"  value="500K-מילון"  ><span>500 אלף ₪ למיליון ₪</span></label>
  <label><input type="radio" name="savings" value="1-2 מיליון"  ><span>בין מיליון ל- 2 מיליון ₪</span></label>
  <label><input type="radio" name="savings"  value="מעל 2 מיליון"  ><span>מעל 2 מיליון ₪</span></label>
      <label><input type="radio" name="savings" value="עד 300K"  ><span>עד 300 אלף ₪</span></label>
  
    </div>
  
  </div>
  
  
  <div class="step" style="display: none;">
  
    <label  class="koteret" align="right">הטבת המס תיקון 190 מושפעת מגובה קצבת הפנסיה.
להערכתך, האם הפנסיה הנוכחית\עתידית שלך מעל 4,500 ש"ח?
לא כולל ביטוח לאומי</label>
   <div  class="blocks"> 
    
    <label><input type="radio" name="pension" class="item-list" value="כן"  ><span>כן</span></label>
  <label><input type="radio" name="pension" class="item-list" value="לא"  ><span>לא</span></label>

  
    </div>
  
  </div>
  
   <div class="step" style="display: none;">
  
    <label  class="koteret" align="right">מהו אזור המגורים שלך?</label>
   <div  class="blocks"> 
    
    <label><input type="radio" name="area" class="item-list" value="הגליל והגולן"  ><span>הגליל והגולן</span></label>
  <label><input type="radio" name="area" class="item-list" value="אריאל והשומרון"  ><span>אריאל והשומרון</span></label>
    <label><input type="radio" name="area" class="item-list" value="חיפה והקריות"  ><span>חיפה והקריות</span></label>
  <label><input type="radio" name="area" class="item-list" value="ירושלים והסביבה"  ><span>ירושלים והסביבה</span></label>
  <label><input type="radio" name="area" class="item-list" value="באר שבע והסביבה"  ><span>באר שבע והסביבה</span></label>
  <label><input type="radio" name="area" class="item-list" value="המרכז והשרון"  ><span>המרכז והשרון</span></label>
      <label><input type="radio" name="area" class="item-list" value="ערבה ואילת"  ><span>ערבה ואילת</span></label>
  
    </div>
  
  </div>
  
  <div class="step" style="display: none;">
    
       <label  class="koteret" align="right">מהו מספר הטלפון שלך?</label>
    <input id="phonenum" type="text" placeholder="מספר טלפון" name="phonenum">
   
  </div>
  
  
  
     <div class="stepLast" style="display: none;">

      <label  class="koteret" align="right">שלחנו לך אסמס עם קוד אימות, אנא הכנס את הקוד מטה?</label>
      <input id="kod" type="text" placeholder="הכנס קוד אימות" name="phonenum">

    </div>
    

  
   </div>
  
  <div id="buttonim">
 
    <button id="nextStep" onclick="showtab(1)">לחץ להתחלת הבדיקה </button> 
     <button id="checkCode" style="display: none;"> סיים את הבדיקה</button>
    <button id="sendData" >שלח </button>
     <button id="prevstep" onclick="showtab(0)" style="display: none;" > חזור אחורה</button>
    
       
</div>
          
</div>
<script>
  
 // var currentStep = 0; // Current tab is set to be the first tab (0)
   //   showStep(currentStep); // Display the current tab
  
  function showStep(cs){
 debugger
    // to start with step 1
     // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("step");
    x[cs].style.display = "block";
    
  }
  
    var currentStep = 0;
   var stepnum = document.getElementsByClassName("step");
   stepnum[currentStep].style.display="block";
  
  
      function validPhone(){

        
        const regex = /^05([0-9])[0-9]{7}$/;
            
               const fieldFhone = jQuery('#phonenum').val();
                if (fieldFhone.length === 10 && regex.test(fieldFhone) === true){
                  validtext.style.display="none";
                    return true;
                    
                }

                else{
                  
                  validtext.style.display="block";
                }
      }

  
  
  function showtab(n){
 if (valitest()){
     validtext.style.display="none"; 
   // moving the step back and forth
   var stepnum = document.getElementsByClassName("step");
	var stepArr = [stepnum];
    stepnum[currentStep].style.display="none";
     
    
       if (n>0) {
 	currentStep++;
         
    stepnum[currentStep].style.display="block";
    }
	 else {
     currentStep--;
    stepnum[currentStep].style.display="block";
     
     }
    debugger

    if(currentStep >0 && currentStep<stepnum.length ){
      document.getElementById("nextStep").innerHTML = "המשך";
       document.getElementById("nextStep").style.display="inline-block";
      document.getElementById("prevstep").style.display="inline-block";
      document.getElementById("sendData").style.display="none";
    }
  
    if(currentStep == stepnum.length-1){
     document.getElementById("prevstep").style.display="inline-block";
       document.getElementById("nextStep").style.display="none";
       document.getElementById("sendData").style.display="inline-block";
    }
    
    if(currentStep==0) {
      document.getElementById("nextStep").innerHTML = "לחץ להתחלת הבדיקה";
        document.getElementById("prevstep").style.display="none";
       document.getElementById("nextStep").style.display="inline-block";
       document.getElementById("sendData").style.display="none";
    }
   
    } 
    else{
    validtext.style.display="block";
    }
    
  }
  
      
  function valitest(){
  debugger
         var valid = true;
            var x = document.getElementsByClassName("step");
           var thistab = x[currentStep];
           var blocks = thistab.getElementsByClassName("blocks");
  			if( jQuery('#fname').val()=="" && currentStep==0 ) {
            return false;
            }
  
           for (let i = 0; i < blocks.length; i++) {
  
            var inputs = blocks[i].getElementsByTagName("input");
  
            for (let j = 0; j < inputs.length; j++) {
  
              if(inputs[j].checked) {
                break;
              }
              if(j==inputs.length-1 && !inputs[j].checked){
                validtext.style.display="block";
                valid = false;
                return false;
                break;
              }
  
            }
  
  
          } return valid;
  }

  
      function sendDataCrm(){
        const name =  jQuery('#fname').val();
        const phone = jQuery('#phonenum').val();
        const age = jQuery('input[name="gil"]:checked').val();
        const savings = jQuery('input[name="savings"]:checked').val();
        const pension = jQuery('input[name="pension"]:checked').val();
       const area = jQuery('input[name="area"]:checked').val();       
       
        
        jQuery.ajax({
          type: 'POST',
          url: tikun.ajax,
          data:{
           action: "send_data_crm",
           'name':name,
          'phone': phone,
           'age': age,
           'pension' : pension,
           'savings' : savings,
           'address1': area
            
          }, 
          success:(data) => {  
           const leadID = data;
           localStorage.setItem('leadId',leadID);

  		
            
          }
        });
      }
      jQuery('#sendData').on('click',(event) => {
        debugger
      event.preventDefault();
      if(jQuery('#phonenum').val()!="" && validPhone()) {
      sendDataCrm();
        	 var page = document.getElementsByClassName("stepLast");
              page[0].style.display = "block";
      			document.getElementById("sendData").innerHTML = "שלח קוד שוב";
        	document.getElementById("sendData").style.backgroundColor ="none";
       			 document.getElementById("prevstep").style.display = "none";
        	document.getElementById("checkCode").style.display = "inline";
      
      
      }
      else {
      validtext.style.display="block";
      }
    });
    
    
    
    
      function checkCode(event){
    debugger
       event.preventDefault();
      const phone = jQuery('#phonenum').val();
      const userCode = jQuery('#kod').val();    
      jQuery.ajax({
        type:'POST',
       url: tikun.ajax,
        data:{
          action: 'check_code_tikun',
          'leadId': localStorage.getItem('leadId'),
          'fld_170946': phone,
          'code_input': userCode,
        },
        success:(code) => {
       
         if(!code) jQuery('#kod').after('<p>קוד האימות שגוי</p>');
        /// location.replace('https://www.tiktax.co.il/?page_id=191');
          else window.location = "https://nownet.co.il/?page_id=2";
        },
      })
      }
      
      jQuery('#checkCode').on('click',checkCode);
   
    
  
  
  </script>

<?php }



function send_data_crm()
{
 send_sms_tikun();
 $data = [
     'lm_form' => 63546,
     'lm_key' => "a25cbd0434",
     'name' => $_POST['name'],
     'phone' =>  $_POST['phone'],
   // 'name' =>  $_POST['name'], // status
    'age' =>  $_POST['age'], //status_partner
    'pension' =>  $_POST['pension'], //salary
    'savings' =>  $_POST['savings'], //salary_partner
 'address1' =>  $_POST['address1'], //salary_partner
     ];
  
$url = "https://proxy.leadim.xyz/apiproxy/global/submit.cors.v2.ashx";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = json_decode(curl_exec($ch));
    echo $response->result;
  
  wp_die();
}

add_action('wp_ajax_send_data_crm','send_data_crm');
add_action('wp_ajax_nopriv_send_data_crm','send_data_crm');


function send_sms_tikun(){
 $phone_number = $_POST['phone'];
  $code = '';
  for($i = 0; $i < 4; $i++){
    $code .= wp_rand(0 , 9);
  }
  
  $_SESSION['code'] = $code;
  $msg = ' שלום הקוד שלך הוא ' .$code;
 SendSMSInforU($msg, $phone_number);
}


function check_code_tikun(){
 $code_user = $_POST['code_input'];
 $codeSend =  $_SESSION['code'];
 $current_code =  $codeSend === $code_user;
 if($current_code) success_sms_tikun();
 echo $current_code;  
  wp_die();
}
add_action('wp_ajax_check_code_tikun','check_code_tikun');
add_action('wp_ajax_nopriv_check_code_tikun','check_code_tikun');
  

function success_sms_tikun(){
  $phone_number = $_POST["fld_170946"];
    $message_text = "פנייתך התקבלה בהצלחה באתר nownet";

    SendSMSInforU($message_text, $phone_number);
    $leadmehomat = 'כן';
    $data = [
        'APIKEY' => 'U-D99BC2A12F0E4CA9.A469B6EB26C9DF5C',
        'by_id' => $_POST['leadId'],
        'fld_170988' => $_SESSION['code'],
        'fld_194639' => $leadmehomat
    ];
    $url = 'https://proxy.leadim.xyz/apiproxy/5285/lead_update.ashx';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    curl_close($ch);
}