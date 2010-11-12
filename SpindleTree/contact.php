<?php 
$page_title ='Spindle Tree | ';
include('include/header.php');
?>
	<h1>Contact Us</h1>
    <!FIXME: reused form id from Sign In page>
    <form id="sign_in" class="span-12">
        <div class="field span-12 last">
            <label class="span-2">Name</label>
            <input id="name" class="span-6 last" />
        </div>
        <div class="field span-12 last">
            <label class="span-2">Email</label>
            <input id="email" class="span-6 last" />
        </div>
        <div class="field span-12 last">
            <label class="span-2">Subject</label>
            <input id="subject" class="span-6 last" />
        </div>
        <div class="field span-12 last">
            <label class="span-2">Body</label>
            <textarea rows="12" cols="128" id="body" class="span-9 last" />
        </div>
        <button type="submit">Send</button>
     </form>

<?php 
include('include/footer.php');
?>	
		