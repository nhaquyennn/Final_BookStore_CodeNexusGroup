<form autocomplete="off" action="<?php  echo BASE_URL;?>category/insertcategory" method="POST">
  <?php 
  if(isset($msg)){
    echo '<span style="color:green">'.$msg.'</span>';
  } 
  ?>
  <table>
    <tr>
      <td>Title</td>
      <td><input type="text" required="1" name="title_category_product"></td>
    </tr>
    <tr>
      <td>Description</td>
      <td><input type="text" required="1" name="desc_category_product"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="submit" value="Save"></td>
    </tr>
  </table>
</form>