<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: evaluations.php' );
  die();
  
}

if( isset( $_POST['text'] ) )
{
  
  if( $_POST['text'] and $_POST['text'] )
  {
    
    $query = 'UPDATE evaluations SET
      text = "'.mysqli_real_escape_string( $connect, $_POST['text'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
        
    set_message( 'Evaluation has been updated' );
    
  }

  header( 'Location: evaluations.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM evaluations
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: evaluations.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

?>

<h2>Edit Evaluation</h2>

<form method="post">
  
  <label for="text">Text:</label>
  <textarea name="text" id="text" rows="5"><?php echo htmlentities( $record['text'] ); ?></textarea>
  
  <br>
    
  <input type="submit" value="Edit Evaluation">
  
</form>

<p><a href="evaluations.php"><i class="fas fa-arrow-circle-left"></i> Return to Evaluation List</a></p>


<?php

include( 'includes/footer.php' );

?>