<?php
    require_once '../scripts/connect.php'; 
    
    $sql = "SELECT * FROM products LIMIT 8"; 
    $result = mysqli_query($conn, $sql); 
    
    $currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    
  if($currentPage == 'index.php'){
    while ($row = mysqli_fetch_assoc($result))
    {
echo<<<PRODUCTS
        <div class="col-sm-12 col-md-4 col-lg-3">
            <div class="card">
              <img src="$row[img_src]" class="card-img-top" alt="product" />
              <div class="card-body">
                <h5 class="card-title">$row[product_name]</h5>
                <p class="card-text">
                  $row[description]
                </p>
                <a href="#" class="btn btn-primary">Zobacz produkt</a>
              </div>
            </div>
          </div>
PRODUCTS;

    }
  }else if($currentPage == 'searchProducts.php'){
    while ($row = mysqli_fetch_assoc($result))
    {
echo<<<PRODUCTS
          <form action="../scripts/addProductToCart.php" method="post">
            <div class="row productBody">
                    <div class="col-lg-2">
                      <img src="$row[img_src]" class="productImg" alt="product" />
                    </div>
                    <div class="productText col-lg-8">
                      <a href = "./product.php?productName=$row[product_name]" name = "productName" value = "$row[product_name]"><h5 class="card-title">$row[product_name]</h5></a>
                      <p>
                      $row[description]
                      </p>
                    </div>
                    <div class="extras col-lg-2">
                      <a type="button" href="#">Sprawdź dostępność</a>
                      <a type="button" href="#">Porównaj</a>
                      <button type="submit" class="btn btn-primary btnBuy" name="product" value="$row[product_id]">Dodaj do koszyka</button>
                    </div>
              </div>
              </form>
PRODUCTS;
    }
  }
 
?>