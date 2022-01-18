<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM pages
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  $query = 'DELETE FROM pageTopicLinks
    WHERE pageId = '.$_GET['delete'];
  mysqli_query( $connect, $query );
    
  set_message( 'Page has been deleted' );
  
  header( 'Location: pages.php' );
  die();
  
}

$query = 'SELECT *
  FROM pages
  ORDER BY date DESC';
$result = mysqli_query( $connect, $query );

include 'includes/wideimage/WideImage.php';

?>

<h2>Manage Pages<?php // echo isset($_GET['filter']) ? ': '.ucfirst($_GET['filter']) : ''; ?></h2>

<!--
<p style="padding: 0 1%; text-align: center;">
  <a href="/articles.php?filter=home"><?php echo icon('home'); ?> Home</a> | 
  <a href="/articles.php?filter=industry"><?php echo icon('industry'); ?> Industry Projects</a> | 
  <a href="/articles.php?filter=professional"><?php echo icon('professional'); ?> Professional Development</a> | 
  <a href="/articles.php?filter=research"><?php echo icon('research'); ?> Research and Publishings</a> | 
  <a href="/articles.php?filter=speaking"><?php echo icon('speaking'); ?> Speaking Engagements</a> | 
  <a href="/articles.php?filter=technology"><?php echo icon('technology'); ?> Technology</a> | 
  <a href="/articles.php?filter=tinkering"><?php echo icon('tinkering'); ?> Tinkering</a>
</p>
-->

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="center">Date</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=page&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
        <small><?php echo $record['content']; ?></small>
        <?php echo ($record['photo']) ? '<i class="fas fa-camera"></i>' : ''; ?>
        <?php echo ($record['youtubeId']) ? '<i class="fab fa-youtube"></i>' : ''; ?>
        <?php echo ($record['githubId']) ? '<i class="fab fa-github"></i>' : ''; ?>
        <?php echo ($record['tinkercadId']) ? '<i class="fas fa-th"></i>' : ''; ?>
        <?php echo ($record['arduinoId']) ? '<i class="fas fa-infinity"></i>' : ''; ?>
      </td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['date'] ); ?></td>
      <td align="center"><a href="https://codeadam.ca/learning/<?php echo $record['url']; ?>"><i class="fas fa-search"></i></a></td>
      <td align="center"><a href="pages_photo.php?id=<?php echo $record['id']; ?>"><i class="fas fa-camera"></i></a></td>
      <td align="center"><a href="pages_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="pages.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this page?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="pages_add.php"><i class="fas fa-plus-square"></i> Add Page</a></p>


<?php

include( 'includes/footer.php' );

?>