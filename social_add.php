<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] and $_POST['name'] )
  {
    
    $query = 'INSERT INTO social (
        name,
        url,
        home,
        about,
        header
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.$_POST['home'].'",
         "'.$_POST['about'].'",
         "'.$_POST['header'].'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Social has been added' );
    
  }
  
  header( 'Location: social.php' );
  die();
  
}

?>

<h2>Add Social</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
    
  <br>
  
  <label for="home">Home:</label>
  <?php
  
  $values = array( 'Yes', 'No' );
  
  echo '<select name="home" id="home">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <label for="about">About:</label>
  <?php
  
  echo '<select name="about" id="about">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <label for="header">Header:</label>
  <?php
  
  echo '<select name="header" id="header">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Add Social">
  
</form>

<p><a href="social.php"><i class="fas fa-arrow-circle-left"></i> Return to Social</a></p>


<?php

include( 'includes/footer.php' );

?>