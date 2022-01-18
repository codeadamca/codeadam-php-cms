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
    
    $query = 'INSERT INTO topics (
        name,
        url,
        tag,
        teaching,
        icon,
        background
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['tag'] ).'",
         "'.$_POST['teaching'].'",
         "'.mysqli_real_escape_string( $connect, $_POST['icon'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['background'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Topic has been added' );
    
  }
  
  header( 'Location: topics.php' );
  die();
  
}

?>

<h2>Add Topic</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
    
  <br>
  
  <label for="icon">Icon:</label>
  <input type="text" name="icon" id="icon">
    
  <br>
  
  <label for="tag">Tag:</label>
  <input type="text" name="tag" id="tag">
    
  <br>
  
  <label for="teaching">Teaching:</label>
  <?php
  
  $values = array( 'Yes', 'No' );
  
  echo '<select name="teaching" id="teaching">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <label for="background">Background:</label>
  <?php
  
  $values = array( 'Dark', 'Light' );
  
  echo '<select name="background" id="background">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Add Topic">
  
</form>

<p><a href="topics.php"><i class="fas fa-arrow-circle-left"></i> Return to Topics</a></p>


<?php

include( 'includes/footer.php' );

?>