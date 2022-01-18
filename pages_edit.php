<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: pages.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'UPDATE pages SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
      content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
      tinkercadId = "'.mysqli_real_escape_string( $connect, $_POST['tinkercadId'] ).'",
      arduinoId = "'.mysqli_real_escape_string( $connect, $_POST['arduinoId'] ).'",
      githubId = "'.mysqli_real_escape_string( $connect, $_POST['githubId'] ).'",
      youtubeId = "'.mysqli_real_escape_string( $connect, $_POST['youtubeId'] ).'",
      date = "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'",
      topicId = "'.mysqli_real_escape_string( $connect, $_POST['topicId'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    
    mysqli_query( $connect, 'DELETE FROM pageTopicLinks WHERE pageId = '.$_GET['id'] );
    
    if( isset( $_POST['relatedTopicId'] ) and count( $_POST['relatedTopicId'] ) )
    {

      foreach( $_POST['relatedTopicId'] as $key => $value )
      {

        $query = 'INSERT INTO pageTopicLinks (
            pageId,
            topicId
          ) VALUES (
            '.$_GET['id'].',
            '.$value.'
          )';
        mysqli_query( $connect, $query );

      }
      
    }
    
    set_message( 'Page has been updated' );
    
  }

  header( 'Location: pages.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *,(
      SELECT GROUP_CONCAT(pageTopicLinks.topicId)
      FROM pageTopicLinks
      WHERE pageTopicLinks.pageId = pages.id
    ) AS relatedTopics
    FROM pages
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: pages.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  $record['relatedTopics'] = explode( ',', $record['relatedTopics'] );
  
}

?>

<h2>Edit Page</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="5"><?php echo htmlentities( $record['content'] ); ?></textarea>
  
  <script>

  ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="tinkercadId">TinkerCad ID:</label>
  <input type="text" name="tinkercadId" id="tinkercadId" value="<?php echo htmlentities( $record['tinkercadId'] ); ?>">
    
  <br>
  
  <label for="arduinoId">Arduino ID:</label>
  <input type="text" name="arduinoId" id="arduinoId" value="<?php echo htmlentities( $record['arduinoId'] ); ?>">
  
  <br>
  
  <label for="githubId">GitHub ID:</label>
  <input type="text" name="githubId" id="githubId" value="<?php echo htmlentities( $record['githubId'] ); ?>">
  
  <br>
  
  <label for="youtubeId">YouTube ID:</label>
  <input type="text" name="youtubeId" id="youtubeId" value="<?php echo htmlentities( $record['youtubeId'] ); ?>">
  
  <br>
  
  <label for="date">Date:</label>
  <input type="date" name="date" id="date" value="<?php echo htmlentities( $record['date'] ); ?>">
    
  <br>
  
  <label for="topicId">Topic:</label>
  <?php
  
  $query = 'SELECT *
    FROM topics
    ORDER BY name';
  $result = mysqli_query( $connect, $query );
  
  echo '<select name="topicId" id="topicId">
    <option value="0"></option>';
  while( $topic = mysqli_fetch_assoc( $result ) )
  {
    echo '<option value="'.$topic['id'].'"';
    if( $record['topicId'] == $topic['id'] ) echo ' selected="selected"';
    echo '>'.htmlentities( $topic['name'] ).'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <label for="relatedTopicId">Related Topics:</label>
  <?php
  
  $query = 'SELECT id,name
    FROM topics
    ORDER BY name';
  $result = mysqli_query( $connect, $query );
  
  echo '<select name="relatedTopicId[]" id="relatedTopicId" size="10" multiple>';
  while( $topic = mysqli_fetch_assoc( $result ) )
  {
    echo '<option value="'.$topic['id'].'"';
    if( in_array( $topic['id'], $record['relatedTopics'] ) ) echo ' selected="selected"';
    echo '>'.htmlentities( $topic['name'] ).'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Edit Page">
  
</form>

<p><a href="pages.php"><i class="fas fa-arrow-circle-left"></i> Return to Page List</a></p>


<?php

include( 'includes/footer.php' );

?>