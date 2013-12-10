<?php $this->load->view('email_templates/mail_header'); ?>

Dear <?php echo $email;?>
<br/>
<p>Welcome to the Global Graynz experience!</p>

<p>Your user name is <?php echo $email;?></p>

<p>Your password is <?php echo $password;?> </p>

<p>We bring high quality top of the line international foods ingredients to your door step at the click of a
button. Visit <a href="<?php echo site_url();?>">www.globalgraynz.com</a> to browse through many exciting recipes, read about cuisines and
shop from a wide variety of product options. We offer individual ingredients, recipe packs, gift options
and much more.</p>

<p>If you ever think we can help you with something: want to know how to use an ingredient, would like
to see a certain recipe / product on the site or would like your products packed a certain way, or pretty
much anything else, feel free to give us a call (044-4216-8588 / email@globalgraynz.com) and we'll
make it happen. That is just one way we show you how important you are to us and is where the Global
Graynz experience begins!!</p>

<p>Bring home the International Food Experience from Global Graynz– You and your family will love
experiencing something new every day.</p>

<p>As a thank you for trying Global Graynz, you can use the following coupon to get 10% off your first
purchase: EXPERIENCE. Just send us an email with the coupon code as the subject and you will be
automatically billed for 10% less.</p>

<?php $this->load->view('email_templates/mail_footer'); ?>