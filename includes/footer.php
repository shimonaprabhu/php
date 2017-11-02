</div>

<footer class="text-center" id="footer">&copy;Copyright Shop Till You Drop! <img href="favicon.jpg" rel="icon" type="image/jpg" /></footer>



<script>
jQuery(window).scroll(function(){
  var vscroll=jQuery(this).scrollTop();
  //console.log(vscroll);
  jQuery('#logotext').css({
    "transform" : "translate(0px, "+vscroll/2+"px)"
  });
  });

jQuery(window).scroll(function(){
  var vscroll=jQuery(this).scrollTop();
  jQuery('#back-flower').css({
    "transform" : "translate("+vscroll/5+"px, "-vscroll/12+"px)"
  });
  });

jQuery(window).scroll(function(){
  var vscroll=jQuery(this).scrollTop();
  jQuery('afore-flower').css({
    "transform" : "translate(0px, "+vscroll/2+"px)"
  });
  });

function detailsmodal(id){
  var data ={"id":id};
  jQuery.ajax({
    url:'/E-Commerce/includes/detailsmodal.php',
    method:"post",
    data:data,
    success:function(data){
      jQuery('body').append(data);
      jQuery('#details-modal').modal('toggle');
    },
    error:function(){
      alert("Something went wrong!");
    }
  });


}


function update_cart(mode,edit_id,edit_size){
    var data={"mode":mode,"edit_id":edit_id,"edit_size":edit_size};
    jQuery.ajax({
      url:'/E-Commerce/admin/parsers/update_cart.php',
      method:"post",
      data:data,
      success:function(){location.reload();},
      error:function(){alert('Something went wrong.');},

    });
}



function add_to_cart(){
  jQuery('#modal_errors').html("");
  var size=jQuery('#size').val();
  var quantity = jQuery('#quantity').val();
  var available = parseInt(jQuery('#available').val());
  var error='';
  var data=jQuery('#add_product_form').serialize();
  if(size==''||quantity==''||quantity==0){
    error+='<p class="text-danger text-center">You must choose a size and quantity</p>';
    jQuery('#modal_errors').html(error);
    
    return;
  }else if(quantity>available){
    error+='<p class="text-danger text-center">There are only '+available+' available</p>';
   jQuery('#modal_errors').html(error);
   return;
  }
  else{
    jQuery.ajax({
      url:'/E-Commerce/admin/parsers/add_cart.php',
      method:'post',
      data:data,
      success:function(){
        location.reload();
      },
      error:function(){alert("Something went wrong");}
    });
  }


}

</script>

</body>
</html>
