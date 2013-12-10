<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Privacy Policy','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
?>

<!--main contents area starts here -->
<style>
.box-area p{
	text-align:justify;
}
</style>
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>Privacy Policy</h4>					
				</div>
				<div class="box-part container">
	                <div class="box contact">
					    <div class="box-area"><br/>
    	<p>This Privacy Policy governs the manner in which Global Graynz collects, uses, maintains and discloses
information collected from users (each, a "User") of the <a href="<?php echo site_url();?>">www.globalgraynz.com</a> website ("Site"). This
privacy policy applies to the Site and all products and services offered by Global Graynz.</p>

	<p><strong>Personal identification information</strong></p>
	<p>We may collect personal identification information from Users in a variety of ways, including, but not
limited to, when Users visit our site, register on the site, place an order, subscribe to the newsletter, fill
out a form, and in connection with other activities, services, features or resources we make available
on our Site. Users may be asked for, as appropriate, name, email address, mailing address, phone
number, and credit card information. Users may, however, visit our Site anonymously. We will collect
personal identification information from Users only if they voluntarily submit such information to us. Users
can always refuse to supply personally identification information, except that it may prevent them from
engaging in certain Site related activities.</p>

		<p><strong>Non-personal identification information</strong></p>
		<p>We may collect non-personal identification information about Users whenever they interact with our
Site. Non-personal identification information may include the browser name, the type of computer and
technical information about Users means of connection to our Site, such as the operating system and the
Internet service providers’ utilized and other similar information.</p>
	
		<p><strong>Web browser cookies</strong></p>
		<p>Our Site may use "cookies" to enhance User experience. User's web browser places cookies on their
hard drive for record-keeping purposes and sometimes to track information about them. User may choose
to set their web browser to refuse cookies, or to alert you when cookies are being sent. If they do so, note
that some parts of the Site may not function properly.</p>
	
		<p><strong>How we use collected information</strong></p>
		<p>
			Global Graynz may collect and use Users personal information for the following purposes:
			<ul>
				<li>- To improve customer service <br/>
					<p>Information you provide will help us respond to your customer service requests and support
needs more efficiently.</p>
				</li>

				<li>- To improve our Site<br/>
					<p>We may use feedback you provide to improve our products and services.</p>
				</li>

				<li>- To process payments<br/>
					<p>We may use the information Users provide about themselves when placing an order only to
provide service to that order. We do not share this information with outside parties except to the
extent necessary to provide the service.</p>
				</li>

				<li>- To send periodic emails<br/>
					<p>We may use the email address to send User information and updates pertaining to their order. It
may also be used to respond to their inquiries, questions, and/or other requests. If User decides
to opt-in to our mailing list, they will receive emails that may include company news, updates,
related product or service information, etc. If at any time the User would like to unsubscribe from
receiving future emails, we include detailed unsubscribe instructions at the bottom of each email
or User may contact us via our Site.</p>
				</li>
			</ul>
		</p>
		<p><strong>How we protect your information</strong></p>
		<p>We adopt appropriate data collection, storage and processing practices and security measures to protect
against unauthorized access, alteration, disclosure or destruction of your personal information, username,
password, transaction information and data stored on our Site.</p>
		<p>Sensitive and private data exchange between the Site and its Users happens over a SSL secured
communication channel and is encrypted and protected with digital signatures.</p>

		<p><strong>Sharing your personal information</strong></p>
		<p>We do not sell, trade, or rent Users personal identification information to others. We may share generic
aggregated demographic information not linked to any personal identification information regarding
visitors and users with our business partners, trusted affiliates and advertisers for the purposes outlined
above.</p>

	<p><strong>Third party websites</strong></p>

	<p>Users may find advertising or other content on our Site that link to the sites and services of our partners,
suppliers, advertisers, sponsors, licensors and other third parties. We do not control the content or links
that appear on these sites and are not responsible for the practices employed by websites linked to or
from our Site. In addition, these sites or services, including their content and links, may be constantly
changing. These sites and services may have their own privacy policies and customer service policies.
Browsing and interaction on any other website, including websites which have a link to our Site, is subject
to that website's own terms and policies.</p>

	<p><strong>Changes to this privacy policy</strong></p>
	<p>Global Graynz has the discretion to update this privacy policy at any time. When we do, we will revise
the updated date at the bottom of this page. We encourage Users to frequently check this page for any
changes to stay informed about how we are helping to protect the personal information we collect. You
acknowledge and agree that it is your responsibility to review this privacy policy periodically and become
aware of modifications.</p>

	<p><strong>Your acceptance of these terms</strong></p>
	<p>By using this Site, you signify your acceptance of this policy. If you do not agree to this policy, please
do not use our Site. Your continued use of the Site following the posting of changes to this policy will be
deemed your acceptance of those changes.</p>

	<p><strong>Contacting us</strong></p>
	<p>If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this
site, please contact us at:</p>
		<p>Global Graynz<br/>
		<a href="<?php echo site_url();?>">www.globalgraynz.com</a><br/>
		A-4, 4th Floor, 18th Avenue, Ashok Nagar Chennai - 600083 Tamil Nadu India<br/>
		91-44-4216-8588<br/>
		<a href="mailto:email@globalgraynz.com">email@globalgraynz.com</a><br/>
</p>

<p>This document was last updated on March 21, 2013</p>

</div>
					</div>                 				
				</div> 				
			</div>   	
        </div>
    </div>	
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array()));?>
