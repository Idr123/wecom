<?php require_once("../resources/config.php");?>
<?php require_once(TEMPLATE_FRONT.DS."header.php");?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
      <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
      <h1>Panier</h1>

<!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="yourmail@gmail.com"> --> 

  <table class="table table-striped">
        <thead>
          <tr>
           <th>Produit</th>
           <th>Prix</th>
           <th>Quantité</th>
           <th>Sous-total</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
        </tbody>
    </table>
    <?php echo show_confirm(); ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Total du panier</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Articles:</th>
<td><span class="amount"><?php echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0" ;?></span></td>
</tr>
<tr class="shipping">
<th>Mode de livraison</th>
<td>Livraison Gratuite</td>
</tr>

<tr class="order-total">
<th>commande total</th>
<td><strong><span class="amount"><?php echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0" ;?>
 FCFA </span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


      </div>
    <!-- /.container -->
<?php require_once(TEMPLATE_FRONT.DS."footer.php");?>