<?php 
$page_title ='SpindleTree | User Account';
include('include/header.php');
?>
    <!NOTE: h1 has been hijacked - just saying>
    <h2>User Account</h2><br/>
    <h3>Change Password</h3>
    <!FIXME: reused form id from Sign In page>
    <form id="sign_in" class="span-9">
        <div class="field span-9 last">
            <label class="span-3">Old Password</label>
            <input id="oldpassword" class="span-6 last" />
        </div>
        <div class="field span-9 last">
            <label class="span-3">New Password</label>
            <input id="newpassword" class="span-6 last" />
        </div>
        <button type="submit">Update</button>
     </form>
    <h3>Default Shipping Information</h3>
    <!TODO: Address form is begging for a function>
        <!FIXME: reused form id from Sign In page>
        <form id="sign_in" class="span-9">
            <?php include('include/addressform.php'); ?>
            <button type="submit">Update</button>
        </form>
<?php 
include('include/footer.php');
?>	
		