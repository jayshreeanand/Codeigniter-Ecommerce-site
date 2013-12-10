<?php $this->load->view('email_templates/mail_header'); ?>

Dear <?php echo $email;?>
<br/>
<p>Too bad you forgot your password... no worries though.</p>

<p>Your temporary password is <?php echo $password;?></p>

<p>It looks like you are tried hard to remember the password and made an effort today to use our website!
We appreciate that!!</p>

<p>Bring home the International Food Experience from Global Graynz - You and your family will love
experiencing something new every day.</p>

<?php $this->load->view('email_templates/mail_footer'); ?>