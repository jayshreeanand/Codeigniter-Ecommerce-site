<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Payment','cssFiles' =>array())); 

$itemCount = $this->cart->total_items();


$shippingCost = calculateShippingCost($delivery_cust['city'], $delivery_cust['state']);

$Amount = $this->cart->format_number($this->cart->total_discount()+$shippingCost);

$Order_Id = $this->session->userdata('oid');
$Redirect_Url = site_url('payment/complete');
$Merchant_Id = "User ID" ;//This id(also User Id)  available at "Generate Working Key" of "Settings & Options"  
$WorkingKey = "Your Working Key"  ;

$Checksum = getCheckSum($Merchant_Id,$Amount,$Order_Id ,$Redirect_Url,$WorkingKey);
$Merchant_Param= '';

$errors='';
if(isset($error) && (strlen($error) > 3)) $errors=$error;
?>
<style>
.payment-submit {
 background: url(<?php echo $staticContentUrl;
?>images/cartpage3.png);
	border: medium none;
	height: 40px;
}
</style>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
<?php echo showBanner();?>
<div class="container">
<div class="row-fluid">
<div class="gredient_main">
<div class="gredient_main_top container">
  <h4>Payment Information</h4>
</div>
<div class="payment_main container">
<div class="payment_main_left">
<div class="payment_main_left_top"> <img src="<?php echo $staticContentUrl;?>images/payment1.png" alt="DONE" />
  <p>Address added successfully</p>
  <?php 
								if($this->session->userdata('fm')){ 
									echo "<p>".$this->session->userdata('fm')."</p>";
									$this->session->unset_userdata('fm');
								}
							 ?>
</div>
<div class="payment_main_left_bottom">
<p>Choose Payment Method</p>
<?php if($errors){?>
<?php echo $errors;?>
<?php } ?>
<form name="paymentform" id="paymentform" method="post" action="<?php echo $Redirect_Url; ?>">
<!-- form name="paymentform" id="paymentform" method="post" action="https://www.ccavenue.com/shopzone/cc_details.jsp">    
                              <input type="hidden" name="Merchant_Id" value="<?php //echo $Merchant_Id; ?>">
							  <input type="hidden" name="Amount" value="<?php //echo $Amount; ?>">
							  <input type="hidden" name="Order_Id" value="<?php //echo $Order_Id; ?>">
							  <input type="hidden" name="Redirect_Url" value="<?php //echo $Redirect_Url; ?>">
							  <input type="hidden" name="Checksum" value="<?php //echo $Checksum; ?>">

							  <input type="hidden" name="billing_cust_name" value="<?php //echo $billing_cust['first_name'].' '.$billing_cust['last_name']; ?>">
							  <input type="hidden" name="billing_cust_address" value="<?php // echo $billing_cust['address1']; ?>">
							  <input type="hidden" name="billing_cust_country" value="<?php // echo getCountry($billing_cust['country']); ?>">
							  <input type="hidden" name="billing_cust_state" value="<?php // echo getStateName($billing_cust['state'],$billing_cust['country']); ?>">
							  <input type="hidden" name="billing_zip" value="<?php // echo $billing_cust['postal_code']; ?>">
							  <input type="hidden" name="billing_cust_tel" value="<?php // echo $billing_cust['mobile']; ?>">
							  <input type="hidden" name="billing_cust_email" value="<?php // echo $this->session->userdata('e'); ?>">

							  <input type="hidden" name="delivery_cust_name" value="<?php // echo $delivery_cust['first_name'].' '.$delivery_cust['last_name'];?>">
							  <input type="hidden" name="delivery_cust_address" value="<?php // echo $delivery_cust['address1']; ?>">
							  <input type="hidden" name="delivery_cust_country" value="<?php // echo getCountry($delivery_cust['country']); ?>">
							  <input type="hidden" name="delivery_cust_state" value="<?php // echo getStateName($delivery_cust['state'],$delivery_cust['country']); ?>">
							  <input type="hidden" name="delivery_cust_tel" value="<?php // echo $delivery_cust['mobile']; ?>">
							  <input type="hidden" name="delivery_cust_notes" value="">
							  
							  <input type="hidden" name="Merchant_Param" value="<?php // echo $Merchant_Param; ?>">

							  <input type="hidden" name="billing_cust_city" value="<?php // echo $billing_cust['city']; ?>">
							  <input type="hidden" name="billing_zip_code" value="<?php // echo $billing_cust['postal_code'] ?>">

							  <input type="hidden" name="delivery_cust_city" value="<?php // echo $delivery_cust['city']; ?>">
							  <input type="hidden" name="delivery_zip_code" value="<?php // echo $delivery_cust['postal_code']; ?>" -->
<ul>
  <li>
    <input type="radio" name="payment_mode" value="COD" checked />
    <img src="<?php echo $staticContentUrl;?>images/cashondelivery.png" alt="cash on delivery" /></li>
  <li>
    <input type="radio" name="payment_mode" value="PTP"/>
    <img src="<?php echo $staticContentUrl;?>images/visamaster.png" alt="visamaster" /></li>
</ul>
<a class="cancel" href="<?php echo site_url('payment/cancel');?>">Cancel</a>
<input class="payment-submit" type="submit" name="submit" style="width: 141px;" value="" >

<!--/form-->
</div>
</div>
<?php if($itemCount){?>
<div class="payment_main_right">
  <div class="payment_main_right_inner">
    <div class="order_summery1">
      <p>Order Summary</p>
      <span>Items:<?php echo $itemCount;?></span> <a href="<?php echo site_url('ggcart');?>">Edit Cart</a> </div>
    <?php foreach ($this->cart->contents() as $items){?>
    <div class="order_summery2">
      <div class="or_right">
        <p><?php echo $items['name'];?></p>
        <ul>
          <li><?php echo $items['qty'].' X  <span class="WebRupee">&#x20B9;</span> '.$this->cart->format_number($items['price']).'  = ';?></li>
          <li style="padding-left:3px;"><span class="WebRupee">&#x20B9;</span> <?php echo  $this->cart->format_number($items['qty']*$items['price']);?></li>
        </ul>
      </div>
    </div>
    <?php } ?>
    <div class="order_summery3">
      <ul class="os_l">
        <li>Subtotal</li>
        <li>Discount</li>
        <li style="margin-top:5px;<?php if(!$shippingCost){echo 'color:red;';}?>" >Shipping</li>
        <li style="margin-top:5px;">Order Total</li>
      </ul>
      <ul class="os_r">
        <li><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total()); ?></li>
        <li>-<span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total()-$this->cart->total_discount()); ?></li>
        <li <?php if(!$shippingCost){echo 'style="color:red;"';}?> ><span class="WebRupee">&#x20B9;</span> <?php echo empty($shippingCost) ? 'FREE' : $shippingCost;?> </li>
        <li><span class="WebRupee">&#x20B9;</span> <?php echo $Amount; ?></li>
      </ul>
    </div>
  </div>
</div>
<?php }?>
</div>
</div>
</div>
</div>
</div>
<?php $this->load->view('footer', array('jsFiles' => array())); ?>
