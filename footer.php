<html>
<body>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script src="ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	CKEDITOR.replace('myeditor');
</script>

<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
 
    var id = $(this).attr('delete-id');
 
    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
 
            if(result==true){
                $.post('delete.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });
 
    return false;
});
</script>

<script type="text/javascript">
function CheckProduct(val){
 var element=document.getElementById('pro');
 var element1=document.getElementById('sel');
 if(val=='Select Product'||val=='others')
   element.style.display='block';
 //  element1.style.display='none';
 else  
   element.style.display='block';
   element.value=element1.value;
  // element1.style.display='block';
}
</script> 
<script src="libs/js/jquery.min.js"></script>
<script src="libs/js/jquery.validate.min.js"></script>
   <script>
   
   $(function ()
{
    $("form[name='myform']").validate({
        rules:{
            
            Product_part: "required",
            chap_id:" required"
           
        },
        messages:{
          
            Product_part:"please Chapter name",
            chap_id:"please provide chapter id"
            
        },
        submitHandler:function(form){
            form.submit();
        }
    });
});
</script>


</body>
</html>