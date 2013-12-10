<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Payment','cssFiles' =>array())); 

$itemCount = $this->cart->total_items();


$shippingCost = calculateShippingCost($delivery_cust['city'], $delivery_cust['state']);
$Amount = ($this->cart->total_discount()+$shippingCost);

//$Order_Id = 'test_'.$this->session->userdata('oid');
$Order_Id = $this->session->userdata('oid');
$Redirect_Url = site_url('payment_check/validate_order');
$Merchant_Id = "test" ;
//This id(also User Id)  available at "Generate Working Key" of "Settings & Options"  
$WorkingKey = "test"  ;

$Checksum = getCheckSum($Merchant_Id,$Amount,$Order_Id ,$Redirect_Url,$WorkingKey);
$Merchant_Param= '';

$errors='';
if(isset($error) && (strlen($error) > 3)) $errors=$error;
?>
<style>
.payment-now {
 background: url(<?php echo $staticContentUrl;
?>images/paynow-btn.png) no-repeat;
	border: medium none;
	height: 36px;
}
</style>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap"> <?php echo showBanner();?>
  <div class="container">
    <div class="row-fluid">
      <div class="gredient_main">
        <div class="gredient_main_top container">
          <h4>Payment Confirmation</h4>
        </div>
        <div class="payment_main container"> 
          <!--<formmm name="paymentform" id="paymentform" method="post" action="https://www.ccavenue.com/shopzone/cc_details.jsp">-->
          <form name="paymentform" id="paymentform" method="post" action="http://www.ccavenue.com/shopzone/cc_details.jsp">
            <?php if($itemCount){?>
            <div class="order_summery_details">
              	<table width="96%" border="0">
                <!--<tr>
                  <td colspan="3"><p class="ordersumm">Order Summary</p></td>
                </tr>-->
                </table>
                <div class="orderlist-mz">
                <table>
                <tr>
                <td width="65%"><p class="ordersumm">Description</p></td>
                <td width="20%"><p class="ordersumm">Qty X Price</p></td>
                <td width="15%"><p class="ordersumm">Sub Total</p></td>
                </tr>
                <?php foreach ($this->cart->contents() as $items){?>
                <tr>
                  <td><strong><?php echo $items['name'];?></strong></td>
                  <td align="right"><?php echo '<span>'.$items['qty'].' X &nbsp;</span><span class="WebRupee">&#x20B9;&nbsp;</span>&nbsp;<span>'.$this->cart->format_number($items['price']).'  </span>';?></td>
                  <td style="padding-left:3px;"><span class="WebRupee">&#x20B9;</span>&nbsp; <?php echo  $this->cart->format_number($items['qty']*$items['price']);?></td>
                </tr>
                <?php } ?>
                </table>
                </div>
                
                <div class="amount-mz">
                <table>
                <tr>
                  <td colspan="3">&nbsp;<br/></td>
                </tr>
                <tr><td  width="70%">&nbsp;<br/></td>
                  <td width="16%"><strong>Subtotal</strong></td>
                  <td width="14%"><span class="WebRupee">&#x20B9;</span>&nbsp; <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                </tr>
                <tr><td>&nbsp;<br/></td>
                  <td><strong>Discount</strong></td>
                  <td><span class="WebRupee">&#x20B9;</span>&nbsp; <?php echo $this->cart->format_number($this->cart->total()-$this->cart->total_discount()); ?></td>
                </tr>
                <tr><td>&nbsp;<br/></td>
                  <td><strong>Shipping</strong></td>
                  <td><span class="WebRupee">&#x20B9;</span>&nbsp; <?php echo empty($shippingCost) ? 'FREE' : $shippingCost;?></td>
                </tr>
                <tr><td>&nbsp;<br/></td>
                  <td><strong>Order Total</strong></td>
                  <td><span class="WebRupee">&#x20B9;</span>&nbsp; <?php echo $Amount; ?></td>
                </tr>
              </table>
              </div>
              <div class="shipp-mz">
                <table>
                <tr>
                  <td colspan="3"><p>Shipping Details</p></td>
                </tr>
                <tr>
                  <td colspan="3">Name:&nbsp;<?php echo $delivery_cust['first_name'].' '.$delivery_cust['last_name']; ?></td>
                </tr>
                <tr>
                  <td colspan="3">Address:&nbsp;<?php echo ',&nbsp;'.$delivery_cust['address1'].',&nbsp;'.$delivery_cust['address2'].' '.$delivery_cust['city'].',&nbsp;'.getStateName($delivery_cust['state'],$delivery_cust['country']).',&nbsp;'.getCountry($delivery_cust['country']).' - '.$delivery_cust['postal_code']; ?></td>
                </tr>
                <tr>
                  <td colspan="3">Mobile:&nbsp;<?php echo $delivery_cust['mobile']; ?></td>
                </tr>
                </table>
                </div>
                <div class="shipp-mz">
                <table>
                <tr>
                  <td colspan="3"><p>Billing Details</p></td>
                </tr>
                <tr>
                  <td colspan="3">Name:&nbsp;<?php echo $billing_cust['first_name'].' '.$billing_cust['last_name']; ?></td>
                </tr>
                <tr>
                  <td colspan="3">Address:&nbsp;<?php echo ',&nbsp;'.$billing_cust['address1'].',&nbsp;'.$billing_cust['address2'].' '.$billing_cust['city'].',&nbsp;'.getStateName($billing_cust['state'],$billing_cust['country']).',&nbsp;'.getCountry($billing_cust['country']).' - '.$billing_cust['postal_code']; ?></td>
                </tr>
                <tr>
                  <td colspan="3">Mobile:&nbsp;<?php echo $billing_cust['mobile']; ?></td>
                </tr>
                </table>
                </div>
                <table>
                <tr>
                  <td colspan="3"><strong>Payment Method</strong> : CCAvenue
                  </td></tr>
                  <tr>
                  <td colspan="3">
                  <br/>
                  Please leave a note to us with your order if you want to:
                  </td></tr>
                  <tr>
                  <td colspan="3">
                  <textarea class="paytext" name="delivery_cust_notes"></textarea>
                  </td>
                  </tr>
                  </table>
                  
            </div>
            <?php }?>
            <input type="hidden" name="Merchant_Id" value="<?php echo $Merchant_Id; ?>">
            <input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
            <input type="hidden" name="Order_Id" value="<?php echo $Order_Id; ?>">
            <input type="hidden" name="Redirect_Url" value="<?php echo $Redirect_Url; ?>">
            <input type="hidden" name="Checksum" value="<?php echo $Checksum; ?>">
            <input type="hidden" name="billing_cust_name" value="<?php echo $billing_cust['first_name'].' '.$billing_cust['last_name']; ?>">
            <input type="hidden" name="billing_cust_address" value="<?php echo $billing_cust['address1']; ?>">
            <input type="hidden" name="billing_cust_country" value="<?php echo getCountry($billing_cust['country']); ?>">
            <input type="hidden" name="billing_cust_state" value="<?php echo getStateName($billing_cust['state'],$billing_cust['country']); ?>">
            <input type="hidden" name="billing_zip_code" value="<?php echo $billing_cust['postal_code']; ?>">
            <input type="hidden" name="billing_cust_tel" value="<?php echo $billing_cust['mobile']; ?>">
            <input type="hidden" name="billing_cust_email" value="<?php echo $this->session->userdata('e'); ?>">
            <input type="hidden" name="delivery_cust_name" value="<?php echo $delivery_cust['first_name'].' '.$delivery_cust['last_name'];?>">
            <input type="hidden" name="delivery_cust_address" value="<?php echo $delivery_cust['address1']; ?>">
            <input type="hidden" name="delivery_cust_country" value="<?php echo getCountry($delivery_cust['country']); ?>">
            <input type="hidden" name="delivery_cust_state" value="<?php echo getStateName($delivery_cust['state'],$delivery_cust['country']); ?>">
            <input type="hidden" name="delivery_cust_tel" value="<?php echo $delivery_cust['mobile']; ?>">
            <input type="hidden" name="delivery_cust_notes" value="">
            <input type="hidden" name="Merchant_Param" value="<?php echo $Merchant_Param; ?>">
            <input type="hidden" name="billing_cust_city" value="<?php echo $billing_cust['city']; ?>">
            <input type="hidden" name="delivery_cust_city" value="<?php echo $delivery_cust['city']; ?>">
            <input type="hidden" name="delivery_zip_code" value="<?php echo $delivery_cust['postal_code']; ?>">
            <input type="hidden" name="billingPageHeading" value="Global Graynz">
            
            <!-- <a class="btn" style="padding:9px;width:87px;" href="<?php //echo site_url('payment/cancel');?>">Cancel</a>--> 
           <div style="width:300px;margin: 2%;">
            <input type="button" class="cancel1" name="cancel" value="Cancel" onclick="document.location = '<?php echo site_url('payment/cancel');?>'" >
            <input class="payment-now" type="submit" name="submit" style="width: 141px;" value="" >
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer', array('jsFiles' => array())); ?>
