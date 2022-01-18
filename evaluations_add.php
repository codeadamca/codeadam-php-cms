<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['text'] ) )
{
  
  if( $_POST['text'] and $_POST['text'] )
  {
    
    $query = 'INSERT INTO evaluations (
        text
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['text'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Evaluation has been added' );
    
  }

  header( 'Location: evaluations.php' );
  die();
  
}

?>

<h2>Add Evaluation</h2>

<form method="post">
  
  <label for="text">Text:</label>
  <textarea name="text" id="text" rows="5"></textarea>
    
  <br>
  
  <input type="submit" value="Add Evaluation">
  
</form>

<p><a href="evaluations.php"><i class="fas fa-arrow-circle-left"></i> Return to Evaluation List</a></p>


<?php

include( 'includes/footer.php' );

?>