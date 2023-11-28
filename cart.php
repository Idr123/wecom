<?php require_once("config.php");?>

<?php
    if(isset($_GET['add'])){


        $query = query("SELECT * FROM products WHERE product_id=".escape_string($_GET['add'])." ");
        confirm($query);
        //var_dump($query= fetch_array($query));die();

        while($row = fetch_array($query)){

            if($row['product_quantity'] != $_SESSION['product_'.$_GET['add']]){
                $_SESSION['product_'.$_GET['add']] += 1;
                redirect("../public/checkout.php");
            }else{
                set_message("We have only ".$row['product_quantity']." {$row['product_title']} "."available");
                redirect("../public/checkout.php");
            }
        }
       /* $_SESSION['product_'.$_GET['add']] += 1;
        redirect('index.php');*/
    }



    if(isset($_GET['remove'])){
        $_SESSION['product_'.$_GET['remove']]--;
        if($_SESSION['product_'.$_GET['remove']] <1){
            unset($_SESSION['item_total']);
            unset($_SESSION['item_quantity']);  
            redirect("../public/checkout.php");
        }else{
            redirect("../public/checkout.php");
        }
    }
    

    if(isset($_GET['delete'])){
         $_SESSION['product_'.$_GET['delete']] = '0';
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);  
         redirect("../public/checkout.php");
     }


     function cart(){
            $total = 0;
            $item_quantity = 0;
            $item_name = 1;
            $item_number = 1;
            $amount = 1;
            $quantity = 1;


            $product_ids_array = array(); // Initialiser un tableau pour stocker les ID des produits


            foreach ($_SESSION as $name => $value) {
            if($value>0){
            if(substr($name, 0, 8) == "product_"){
            //$length = strlen($name) - 8;
                $length = strlen($name);
            $id = substr($name, 8, $length);
              // Ajouter l'ID du produit au tableau
              $product_ids_array[] = $id;
                $query = query("SELECT * FROM products WHERE product_id =".escape_string($id)." ");
                confirm($query);
                while ($row = fetch_array($query)) {
                    $sub = $row['product_price'] * $value;
                    $item_quantity += $value;
                    $product_image = display_image($row['product_image']);
                    $product = <<<DELIMETER

                     <tr>
                        <td>{$row['product_title']}<br>
                        <img width="100"  src="../resources/{$product_image}" alt=""></td>
                        <td>{$row['product_price']} FCFA</td>
                        <td>{$value}</td>
                        <td>{$sub} FCFA</td>
                        <td><a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></a>
                        <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
                      
                    </tr>
<input type="hidden" name="item_name_1" value="chocolat">
<input type="hidden" name="item_name_2" value="noisette">
<input type="hidden" name="notify_url" value="localhost/ecom/public/thank_you.php">

<input type="hidden" name="quantity_1" value="6">
<input type="hidden" name="quantity_2" value="10">
<input type="hidden" name="amount_1" value="3.00">
<input type="hidden" name="amount_2" value="6.00">
DELIMETER;
        echo $product;
        $item_name++;
        $item_number++;
        $amount++;
        $quantity++;    }
                    $_SESSION['item_total'] = $total +=$sub;
                    $_SESSION['item_quantity']  =$item_quantity;
            }
        }
        }
          // Convertir le tableau d'ID en une chaîne séparée par des virgules
    $product_ids = implode(',', $product_ids_array);

    // Enregistrez $product_ids dans la table registration
   // save_product_ids_to_registration($product_ids);

    }


  function show_confirm(){
      if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity']>0){
     
    
    echo '<a href="../public/confirm.php" style="text-decoration: none;">';
    echo '<button style="background-color: #4CAF50; /* Green */
                       border: none;
                       color: white;
                       padding: 15px 32px;
                       text-align: center;
                       text-decoration: none;
                       display: inline-block;
                       font-size: 16px;
                       margin: 4px 2px;
                       cursor: pointer;">';
    echo 'Acheter Maitenant';
    echo '</button>';
    echo '</a>';
    
    

  }
  }



       function process_transaction(){

            if(isset($_GET['tx'])){
            $amount = $_GET['amt'];
            $currency = $_GET['cc'];
            $transaction = $_GET['tx'];
            $status = $_GET['st'];
           
            $last_id = last_id();
            //echo "<h1>$last_id</h1>";


            $total = 0;
            $item_quantity = 0;
            foreach ($_SESSION as $name => $value) {
            if($value>0){
            if(substr($name, 0, 8) == "product_"){
                $length = strlen($name) - 8;
                $id = substr($name, 8, $length);

                $send_order = query("INSERT INTO orders(order_amount, order_transaction, order_status, order_currency) VALUES('{$amount}','{$transaction}','{$status}','{$currency}')");
                confirm($send_order);

                    $query = query("SELECT * FROM products WHERE product_id =".escape_string($id)." ");
                    confirm($query);
                    while ($row = fetch_array($query)) {
                        $product_price = $row['product_price'];
                        //$product_quantity = $row['product_quantity'];
                        $product_title = $row['product_title'];
                        $sub = $row['product_price'] * $value;
                        $item_quantity += $value;


                        $insert_report = query("INSERT INTO reports(product_id,order_id,product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
                        confirm($insert_report);
                        }
                        $total +=$sub;
                       echo  $item_quantity;
                }
            }
        }
    session_destroy();
    }else{
        redirect("index.php");//localhost/ecom/public/thank_you.php?tx=34567&cc=USD&st=Completed&amt=345
    }

    }
?>