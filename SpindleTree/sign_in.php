<?php 
$page_title ='SpindleTree | Sign In';
include('include/header.php');
?>
     <h2>Sign In</h2>
     <form id="sign_in" class="span-9 push-7 last">
         <div class="field span-9 last">
             <label class="span-3">Username</label>
             <input id="username" class="span-6 last"/>
         </div>
         <div class="field span-9 last">
             <label class="span-3">Password</label>
             <input id="password" class="span-6 last" />
         </div>
         <button type="submit">Sign in</button>
     </form>
<?php 
include('include/footer.php');
?>	
		