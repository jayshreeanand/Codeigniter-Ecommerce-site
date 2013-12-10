<?php $this->load->view('email_templates/mail_header'); ?>

Mail from Customer

<p> Name : <?php echo $name;?></p>
<p> Email : <?php echo $email;?></p>
<p> Phone : <?php echo $phone;?></p>
<p> Subject : <?php echo $subject;?></p>
<p>Message </p>
<p><?php echo $message;?></p>
