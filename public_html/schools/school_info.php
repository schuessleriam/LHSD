<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>


<!--organization tabs-->
<div class="schooltab" style="overflow:hidden;">
  <div class="subtab" style="overflow:hidden;">
  <button class="subtablinks" onclick="loadSimpleTab('ViewSchools', 'school_list.php')">Back</button>
  <button id="school_default" class="subtablinks" onclick="openSubTab(event, 'gen')">General</button>
  <button class="subtablinks" onclick="openSubTab(event, 'Population')">Population</button>
  <button class="subtablinks" onclick="openSubTab(event, 'Directors')">Directors</button>
  <button class="subtablinks" onclick="openSubTab(event, 'Grad_stats')">Graduation Statistics</button>
  </div>
</div>

<!--Tab displaying general information-->
<div id="gen" class="subtabcontent">

<!--end of General info tab-->
</div>


<!--tab displaying enrollment statistics-->
<div id="Population" class="subtabcontent">


<!--end of population tab-->
</div>


<!--tab displaying directors-->
<div id="Directors" class="subtabcontent">


<!--close directors tab-->
</div>

<!--tab displaying directors-->
<div id="Grad_stats" class="subtabcontent">


<!--close directors tab-->
</div>
