<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>Live editable table with jQuery AJAX in CodeIgniter</title>

   <!-- jQuery library -->
   <script src="<?= base_url() ?>assets/jquery-3.4.1.min.js"></script>

   <style type="text/css">
    .txtedit{
      display: none;
      width: 98%;
    }
   </style>
</head>
<body>

    <table width='100%' border='1' style='border-collapse: collapse;'>
        <thead>
          <tr>
            <th width='50%'>Name</th>
            <th width='50%'>Email</th>
          </tr>
        </thead>
        <?php 
        // User List
        foreach($userlist as $user){
            $id = $user['id'];
            $name = $user['name'];
            $email = $user['email'];

            echo "<tr>";
            echo "<td>
                <span class='edit' >".$name."</span>
                <input type='text' class='txtedit' data-id='".$id."' data-field='name' id='nametxt_".$id."' value='".$name."' >
            </td>";
            echo "<td>
                <span class='edit' >".$email."</span>
                <input type='text' class='txtedit' data-id='".$id."' data-field='email' id='emailtxt_".$id."' value='".$email."' >
            </td>";
            echo "</tr>";
        }
        ?>

    </table>

    <!-- Script -->
    <script type="text/javascript">
    $(document).ready(function(){

        // On text click
        $('.edit').click(function(){

          // Hide input element
          $('.txtedit').hide();

          // Show next input element
          $(this).next('.txtedit').show().focus();

          // Hide clicked element
          $(this).hide();
        });

        // Focus out from a textbox
        $('.txtedit').focusout(function(){
            // Get edit id, field name and value
            var edit_id = $(this).data('id');
            var fieldname = $(this).data('field');
            var value = $(this).val();

            // Hide Input element
            $(this).hide();

            // Update viewing value and display it
            $(this).prev('.edit').show();
            $(this).prev('.edit').text(value);

            // Send AJAX request
            $.ajax({
              url: '<?= base_url() ?>index.php/users/updateuser',
              type: 'post',
              data: { field:fieldname, value:value, id:edit_id },
              success:function(response){
                console.log(response);
                
              }
            });
        });
    });
    </script>
   
</body>
</html>







