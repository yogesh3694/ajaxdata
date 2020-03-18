<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Product List</title>
   <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/dataTables.bootstrap4.css'?>">

    <style type="text/css">
        .error{
            color:red;
        }
    </style>

</head>
<body>
<div class="container">
        	<!-- Page Heading -->
            <div class="row">
                <div class="col-12">
                    <div class="col-md-12">
                        <h1>Product
                            <small>List</small>
                            <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary addnewdata"><span class="fa fa-plus"></span> Add New</a></div>
                        </h1>
                    </div>
                    
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                    <th class="no-sorts">No.</th>
                                    <th class="no-sorts">First Name</th>
                                    <th class="no-sorts">Last Name</th>
                                    <th class="no-sorts">Email</th>
                                    <th class="no-sorts">Phone</th>
                                    <th class="ss">Gender</th>
                                    <th class="">Hobies</th>
                                    <th class="no-sorts" width="100px;">Image</th>
                                    <th class="no-sorts">Register Date</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            
                        </tbody>
                    </table>
                </div>
            </div>
                
        </div>

		<!-- MODAL ADD -->
              <form class="form-horizontal" role="form" method="post" id="register"  enctype="multipart/form-data">
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span style="color:red;text-align:center;margin:100px 235px" class="all_error"></span>
                    <span style="color:green;text-align:center;margin:100px 235px" class="success"></span>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">First Name</label>
                            <div class="col-md-10">
                             <input type="text" name="first_name" placeholder="FIRST NAME" value=""  class="form-control" value="<?php echo !empty($user->first_name)?$user->first_name:''; ?>">
                             <?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Last Name</label>
                            <div class="col-md-10">
                              <input type="text" name="last_name" placeholder="LAST NAME"  class="form-control" value="<?php echo !empty($user->last_name)?$user->last_name:''; ?>" >
                                <?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                               <input type="email" name="email" placeholder="EMAIL" value="<?php echo !empty($user->email)?$user->email:''; ?>"  class="form-control" value="<?php echo !empty($user->email)?$user->email:''; ?>">
                             <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Phone number</label>
                            <div class="col-md-10">
                             <input type="text" id="phone" name="phone" placeholder="Phone number" class="form-control" value="<?php echo !empty($user->phone)?$user->phone:''; ?>">
                            <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-10">
                             <input type="password" name="password" placeholder="PASSWORD"  class="form-control" id="password">
                                <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Confirm Password</label>
                            <div class="col-md-10">
                             <input type="password" name="conf_password" placeholder="CONFIRM PASSWORD" class="form-control">
                                <?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Profile Image</label>
                            <div class="col-md-10">
                              <input type="file" id="image" name="image" placeholder="image" class="form-control imgfile">
                                <?php echo form_error('image','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <?php 
                        if(!empty($user->gender) && $user->gender == 'Female'){ 
                        $fcheck = 'checkeds="checkeds"'; 
                        $mcheck = ''; 
                        }else{ 
                        $mcheck = 'checkeds="checkeds"'; 
                        $fcheck = ''; 
                        } 
                        ?>
                        <div class="form-group row ">
                            <label class="col-md-2 col-form-label">Gender</label>
                            <div class="col-md-10 ">
                              <div class="col-sm-4 rederr">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" name="gender" value="Female" <?php echo $mcheck; ?>>Female
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" name="gender" value="Male" <?php echo $mcheck; ?>>Male
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Hobies</label>
                            <div class="col-md-10 ">
                                <div class="hberror">
                              <input type="checkbox" name="hobies[]" value="Cicket">Cicket
                              <input type="checkbox" name="hobies[]" value="Music">Music
                              <input type="checkbox" name="hobies[]" value="Dance">Dance
                          </div>
                            </div>
                        </div>
                      
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="sss" value="Save" id="btn_save" class="btn btn-primary">
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <form class="form-horizontal" role="form" method="post" id="editregister"  enctype="multipart/form-data">
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <input type="hidden" name="id" value="" id="edt_ID">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">First Name</label>
                            <div class="col-md-10">
                             <input type="text" name="first_name" placeholder="FIRST NAME" value=""  class="form-control" value="<?php echo !empty($user->first_name)?$user->first_name:''; ?>">
                             <?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Last Name</label>
                            <div class="col-md-10">
                              <input type="text" name="last_name" placeholder="LAST NAME"  class="form-control" value="<?php echo !empty($user->last_name)?$user->last_name:''; ?>" >
                                <?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                               <input type="email" name="email" placeholder="EMAIL" value="<?php echo !empty($user->email)?$user->email:''; ?>"  class="form-control" value="<?php echo !empty($user->email)?$user->email:''; ?>">
                             <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Phone number</label>
                            <div class="col-md-10">
                             <input type="text" id="phone" name="phone" placeholder="Phone number" class="form-control" value="<?php echo !empty($user->phone)?$user->phone:''; ?>">
                            <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Profile Image</label>
                            <div class="col-md-10">
                              <input type="hidden" name="imghidden">
                              <input type="file" id="image" name="image" placeholder="image" class="form-control imgfileedt">
                                <?php echo form_error('image','<p class="help-block">','</p>'); ?>
                                <img class="imgedit"  style="display: none;width: 100;height: 100;">
                            </div>
                        </div>
                       
                        <div class="form-group row ">
                            <label class="col-md-2 col-form-label">Gender</label>
                            <div class="col-md-10 ">
                              <div class="col-sm-4 rederredt">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" name="gender" value="Female" <?php echo $mcheck; ?>>Female
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" name="gender" value="Male" <?php echo $mcheck; ?>>Male
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Hobies</label>
                            <div class="col-md-10 ">
                                <div class="hberroredt">
                              <input type="checkbox" name="hobies[]" value="Cicket" class="hobies">Cicket
                              <input type="checkbox" name="hobies[]" value="Music" class="hobies">Music
                              <input type="checkbox" name="hobies[]" value="Dance" class="hobies">Dance
                          </div>
                            </div>
                        </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <input type="submit" name="sss" value="Update" id="btn_update" class="btn btn-primary">
                   <!--  <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button> -->
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->
         <form >
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="data_delete" id="data_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->


<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/dataTables.bootstrap4.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.validate.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/additional-methods.min.js';?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.addnewdata').on('click',function(){
          $("label.error").css('display','none');
          $("#register").trigger("reset");
          $("#registeredt").trigger("reset");
          $('#Modal_Add').modal('show');
        });
        $('.all_error').html('');
        $('.all_erroredt').html('');
       $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]*$/);
    });
    $('#register').validate({
    ignore: [],
    rules: {
        first_name:{
            required:true,
           // lettersonly:true,
            maxlength:10,           
        },
        last_name: {
            required:true,
           // lettersonly:true,
            maxlength:10,
        },
        email:{
            required:true,
            email:true 
        },
        password : {
        required:true,
        minlength : 5
        },
        conf_password : {
        required:true,
        minlength : 5,
        equalTo : "#password"
        },
         phone:{
            required:true,
            number:true 
        },
        image:{
            required:true,
            extension:"jpg|jpeg|png" 
        },
        gender:"required",
        "hobies[]":"required",
        
         
    },
    messages: {
          first_name:{required:"Please enter first name.", lettersonly:"Please enter valid first name."},
          last_name:{required:"Please enter last name.", lettersonly:"Please enter valid last name."},
          
          email:{
              required:"Please enter email.",
              email:"Please enter valid email."
          },
          password : {
          required:"Please enter password.",
          minlength : "Password minimum length is 5 character."
          },

          conf_password : {
          required:"Please enter confirm password.",
          equalTo : "password mismatch."
          },
          phone:{required:"Please enter phone.", number:"Please enter valid phone."},
         
          image:{
                  required:"please uploade image",
                  extension:"please uploade only jpg,jpeg and png image." 
              },
          gender:"Please select gender",
          "hobies[]":"Please select hobies",
    }, 
    errorPlacement: function(error, element) {
        if(element.attr('name') == "hobies[]"){
            jQuery('.hberror').after(error);
        }
        else if(element.attr('name') == "image"){
            jQuery('.imgfile').after(error);//.append(error);
        }
        else if(element.attr('name') == "gender"){
            jQuery('.rederr').after(error);//.append(error);
        }
        else {
            error.insertAfter(element);
        }
    },     
    submitHandler: function(form) {
            $('.all_error').html('');
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('product/save')?>",
                data: new FormData(form),
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    var response=JSON.parse(data);
                    console.log(response);
                    if(response.error_msg!=''){
                        $('.all_error').html(response.error_msg);
                    }
                    if(response.error_msg!=''){
                        $('.success').html(response.error_msg);
                    }else{

                    }
                   // <p class="status-msg error">'.$error_msg.'</p>
                    $('#Modal_Add').modal('hide');
                    //$('#register').reset();
                    show_product();
                }
            });
            return false;

        //form.submit();
    }
});
    $('#editregister').validate({
    ignore: [],
    rules: {
        first_name:{
            required:true,
           // lettersonly:true,
            maxlength:10,           
        },
        last_name: {
            required:true,
           // lettersonly:true,
            maxlength:10,
        },
        email:{
            required:true,
            email:true 
        },
       
         phone:{
            required:true,
            number:true 
        },
        image:{
            // required:true,
            extension:"jpg|jpeg|png" 
        },
        gender:"required",
        "hobies[]":"required",
        
         
    },
    messages: {
          first_name:{required:"Please enter first name.", lettersonly:"Please enter valid first name."},
          last_name:{required:"Please enter last name.", lettersonly:"Please enter valid last name."},
          
          email:{
              required:"Please enter email.",
              email:"Please enter valid email."
          },
         
          phone:{required:"Please enter phone.", number:"Please enter valid phone."},
         
          image:{
                 // required:"please uploade image",
                  extension:"please uploade only jpg,jpeg and png image." 
              },
          gender:"Please select gender",
          "hobies[]":"Please select hobies",
    }, 
    errorPlacement: function(error, element) {
          if(element.attr('name') == "hobies[]"){
              jQuery('.hberroredt').after(error);
          }
          else if(element.attr('name') == "image"){
              jQuery('.imgfileedt').after(error);//.append(error);
          }
          else if(element.attr('name') == "gender"){
              jQuery('.rederredt').after(error);//.append(error);
          }
          else {
              error.insertAfter(element);
          }
    },     
    submitHandler: function(form) {
            $('.all_erroredt').html('');
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('product/update')?>",
                data: new FormData(form),
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    var response=JSON.parse(data);
                    console.log(response);
                    if(response.error_msg!=''){
                        $('.all_erroredt').html(response.error_msg);
                    }
                    if(response.error_msg!=''){
                        $('.successedt').html(response.error_msg);
                    }else{

                    }
                   // <p class="status-msg error">'.$error_msg.'</p>
                    $('#Modal_Add').modal('hide');
                    //$('#register').reset();
                    show_product();
                }
            });
            return false;

        
    }
});

    show_product(); //call function show all product
        
        $('#mydata').dataTable();
         
        //function show all product
        function show_product(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('Product/getuserlist')?>',
                async : false,
                dataType : 'json',
                success : function(data){
                   
                    $('#show_data').html(data);
                }

            });
        }


        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var id = $(this).data('id');
            var first_name = $(this).data('first_name');
            var last_name  = $(this).data('last_name');
            var email  = $(this).data('email');
            var phone  = $(this).data('phone');
            var gender  = $(this).data('gender');
            var hobies  = $(this).data('hobies');
            var hobiesdata  = [];
            var image  = $(this).data('image');

           
              if(image!=''){
               
                 $('.imgedit').css('display','block');
            }else{
                 $('.imgedit').css('display','none');
            }

            var hobiesres = hobies.split(",");
            var i=0;
            for(i;i<hobiesres.length;i++){
                hobiesdata[i]=hobiesres[i];
            }
            var Dance=hobiesdata.indexOf('Dance') ;
            var Cricket=hobiesdata.indexOf('Cricket') ;
            var Music=hobiesdata.indexOf('Music') ;

            $(":checkbox").prop("checked",false);
            if(Dance!='-1'){
                $(":checkbox[value='Dance']").prop("checked",true);
            }
            if(Cricket!='-1'){
                $(":checkbox[value='Cricket']").prop("checked",true);
            }
            if(Music!='-1'){
                $(":checkbox[value='Music']").prop("checked",true);
            }
            if(gender=='Male'){
                $(":radio[value='Male']").attr('checked', 'checked');
            }
            if(gender=='Female'){
                $(":radio[value='Female']").attr('checked', 'checked');
            }
           
            var srcval='<?php echo site_url('assets/upload/')?>'+image;
            $('.imgedit').attr('src',srcval);
            $('.imgedit').css('width','100px');
             $('[name="id"]').val(id);
            $('[name="first_name"]').val(first_name);
            $('[name="last_name"]').val(last_name);
            $('[name="email"]').val(email);
            $('[name="phone"]').val(phone);
            $('[name="gender"]').val(gender);
            $('[name="hobies"]').val(hobies);
            $('#Modal_Edit').modal('show');
          
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var deleteid = $(this).data('deleteid');
            
            $('#Modal_Delete').modal('show');
            $('[name="data_delete"]').val(deleteid);
        });

        //delete record to database
         $('#btn_delete').on('click',function(){
            var id = $('#data_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('product/delete')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $('[name="data_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    show_product();
                }
            });
            return false;
        });

});
</script>
</body>
</html>