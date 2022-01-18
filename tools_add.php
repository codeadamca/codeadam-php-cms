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
    
    $query = 'INSERT INTO tools (
        name,
        url,
        category
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.$_POST['category'].'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Tool has been added' );
    
  }
  
  header( 'Location: tools.php' );
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
  
  <label for="home">Category:</label>
  <?php
  
  $values = array( 'Coding', 'Design', 'Learning' );
  
  echo '<select name="category" id="category">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
    
  <input type="submit" value="Add Tool">
  
</form>

<p><a href="tools.php"><i class="fas fa-arrow-circle-left"></i> Return to Tools</a></p>


<?php

include( 'includes/footer.php' );

?>