<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: topics.php' );
  die();
  
}

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] and $_POST['name'] )
  {
    
    $query = 'UPDATE topics SET
      name = "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
      tag = "'.mysqli_real_escape_string( $connect, $_POST['tag'] ).'",
      icon = "'.mysqli_real_escape_string( $connect, $_POST['icon'] ).'",
      background = "'.mysqli_real_escape_string( $connect, $_POST['background'] ).'",
      teaching = "'.$_POST['teaching'].'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Social has been updated' );
    
  }

  header( 'Location: topics.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM topics
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: social.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

?>

<h2>Edit Social</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities( $record['name'] ); ?>">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">
    
  <br>
  
  <label for="icon">Icon:</label>
  <input type="text" name="icon" id="icon" value="<?php echo htmlentities( $record['icon'] ); ?>">
    
  <br>
  
  <label for="tag">Tag:</label>
  <input type="text" name="tag" id="tag" value="<?php echo htmlentities( $record['tag'] ); ?>">
  
  <br>
  
  <label for="teaching">Teaching:</label>
  <?php
  
  $values = array( 'Yes', 'No' );
  
  echo '<select name="teaching" id="teaching">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $value == $record['teaching'] ) echo ' selected="selected"';
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
    if( $value == $record['background'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
    
  <input type="submit" value="Social">
  
</form>

<p><a href="social.php"><i class="fas fa-arrow-circle-left"></i> Return to Social List</a></p>


<?php

include( 'includes/footer.php' );

?>