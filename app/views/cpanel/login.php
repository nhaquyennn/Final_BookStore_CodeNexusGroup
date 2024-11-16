<form autocomplete="off" action="<?php  echo BASE_URL;?>/login/authentication_login" method="POST">
  <?php 
  if(isset($msg)){
    echo '<span style="color:green">'.$msg.'</span>';
  } 
  ?>
  <table>
    <tr>
      <td>Username</td>
      <td><input type="text" required="1" name="username"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" required="1" name="password"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="login" value="Login"></td>
    </tr>
  </table>
</form>