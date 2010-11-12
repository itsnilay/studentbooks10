<?php 
$page_title ='SpindleTree | Contact';
include('include/header.php');
?>
	<h2>Contact Us</h2>
    <!FIXME: reused form id from Sign In page>
    <form id="sign_in" class="span-9">
        <div class="field span-9 last">
            <label class="span-2">Name</label>
            <input id="name" class="span-6 last" />
        </div>
        <div class="field span-9 last">
            <label class="span-2">Email</label>
            <input id="email" class="span-6 last" />
        </div>
        <div class="field span-9 last">
            <label class="span-2">Subject</label>
            <input id="subject" class="span-6 last" />
        </div>
        <div class="field span-9 last">
            <!--label class="span-2">Body</label>-->
            <br/>
            <textarea name="body" rows="12" cols="128" class="span-9 last"></textarea>
        </div>
        <button type="submit">Send</button>
     </form>

<?php 
include('include/footer.php');
?>	
		