<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM social
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'Social has been deleted' );
  
  header( 'Location: social.php' );
  die();
  
}

$query = 'SELECT *
  FROM social
  ORDER BY name';
$result = mysqli_query( $connect, $query );

include 'includes/wideimage/WideImage.php';

?>

<h2>Manage Social</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="left">URL</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=social&id=<?php echo $record['id']; ?>&width=100&height=100&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['name'] ); ?>
        <br>
        <?php echo ($record['photo']) ? '<i class="fas fa-camera"></i>' : ''; ?>
        <?php echo ($record['home'] == 'Yes') ? icon('home') : ''; ?>
        <?php echo ($record['header'] == 'Yes') ? icon('header') : ''; ?>
        <?php echo ($record['about'] == 'Yes') ? icon('about') : ''; ?>
      </td>
      <td align="left"><a href="<?php echo htmlentities( $record['url'] ); ?>"><?php echo htmlentities( $record['url'] ); ?></a></td>
      <td align="center"><a href="social_photo.php?id=<?php echo $record['id']; ?>"><i class="fas fa-camera"></i></a></td>
      <td align="center"><a href="social_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="social.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this social?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="social_add.php"><i class="fas fa-plus-square"></i> Add Social</a></p>


<?php

include( 'includes/footer.php' );

?>