<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'INSERT INTO pages (
        title,
        url,
        content,
        tinkercadId,
        arduinoId,
        githubId,
        youtubeId,
        topicId,
        date
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['tinkercadId'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['arduinoId'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['githubId'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['youtubeId'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['topicId'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    $id = mysqli_insert_id( $connect );
    
    if( isset( $_POST['relatedTopicId'] ) and count( $_POST['relatedTopicId'] ) )
    {

      foreach( $_POST['relatedTopicId'] as $key => $value )
      {

        $query = 'INSERT INTO pageTopicLinks (
            pageId,
            topicId
          ) VALUES (
            '.$id.',
            '.$value.'
          )';
        mysqli_query( $connect, $query );

      }
      
    }
    
    set_message( 'Page has been added' );
    
  }
  
  header( 'Location: pages.php' );
  die();
  
}

?>

<h2>Add Page</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="10"></textarea>
      
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
  <input type="text" name="tinkercadId" id="tinkercadId">
    
  <br>
  
  <label for="arduinoId">Arduino ID:</label>
  <input type="text" name="arduinoId" id="arduinoId">
  
  <br>
  
  <label for="githubId">GitHub ID:</label>
  <input type="text" name="githubId" id="githubId">
  
  <br>
  
  <label for="youtubeId">YouTube ID:</label>
  <input type="text" name="youtubeId" id="youtubeId">
  
  <br>
  
  <label for="date">Date:</label>
  <input type="date" name="date" id="date">
  
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
    echo '<option value="'.$topic['id'].'">'.htmlentities( $topic['name'] ).'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Add Page">
  
</form>

<p><a href="pages.php"><i class="fas fa-arrow-circle-left"></i> Return to Page List</a></p>


<?php

include( 'includes/footer.php' );

?>