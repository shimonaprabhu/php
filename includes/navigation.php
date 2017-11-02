<?php

$sql = "SELECT * FROM categories WHERE parent=0";
$pquery = $db->query($sql);
?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <a href="project.php" class="navbar-brand">Shop Till You Drop</a>
     <ul class="nav navbar-nav">
     <?php while($parent=mysqli_fetch_assoc($pquery)):?>
      <?php 
      $parent_id = $parent['id'];
      $sql2="SELECT * FROM categories WHERE parent='$parent_id'";
      $cquery = $db->query($sql2);
      ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category'];?><span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
        <?php while($child=mysqli_fetch_assoc($cquery)):?>
          <li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category'];?></a></li>
          <?php endwhile;?>
        </ul>
      </li>
      <?php endwhile;?>
      <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
     <!--  <li><a href="contact_us.php"><span class="glyphicon glyphicon-phone-alt"></span> Contact Us!</a></li> -->
 <li><a href="#" data-toggle="modal" data-target="#contactModal"><span  class="glyphicon glyphicon-phone-alt"></span> Contact Us</a></li>
 <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
    </ul>
  </div>
</nav>
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="contactModalLabel">Please leave your details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Fill in the required fields</h5><br><br>
         <div class="row">
         <form action="contact_us.php" method="post" id="contact-form">

            
              <div class="form-group col-md-12">
                <label for="full_name">Full Name:</label>
                <input class="form-control" name="fullname" id="fullname" type="text">
              </div>
              <div class="form-group col-md-12">
                <label for="email">Email:</label>
                <input class="form-control" name="emailid" id="emailid" type="email">
              </div>
             
      </div>
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="alertcontact();">Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>
<script >
  function alertcontact(){
    $('#contactModal').modal('hide');
    alert('Our team will get back to you soon.');

  }
</script>

