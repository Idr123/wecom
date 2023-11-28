<!DOCTYPE html>
<html>
  <head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Formulaire de commande</h1>
          </div>
          <div class="panel-body">
            <form action="connect.php" method="post">
              <div class="form-group">
                <label for="name">Nom</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                />
              </div>
              <div class="form-group">
                <label for="address">Adresse</label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  name="address"
                />
              </div>
            
              <div class="form-group">
                <label for="number">Numéro de téléphone</label>
                <input
                  type="number"
                  class="form-control"
                  id="number"
                  name="number"
                />
              </div>
              <div class="form-group">
                <label for="methods">Methode de paiement</label>
                <div>
                  <label for="c" class="radio-inline"
                    ><input
                      type="radio"
                      name="methods"
                      value="c"
                      id="c"
                      checked
                    />paiement à la livraison</label
                  >
                
                </div>
              </div>
              <input type="submit" class="btn btn-primary" />
            </form>
          </div>
          <div class="panel-footer text-right">
            <small>&copy; Shop225</small>
          </div>
        </div>
      </div>
    </div>
 
  </body>
</html>