<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM tools
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'Tool has been deleted' );
  
  header( 'Location: tools.php' );
  die();
  
}

$query = 'SELECT *
  FROM tools
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
    <th align="center">Category</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=tool&id=<?php echo $record['id']; ?>&width=100&height=100&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left"><?php echo htmlentities( $record['name'] ); ?></td>
      <td align="left"><a href="<?php echo htmlentities( $record['url'] ); ?>"><?php echo htmlentities( $record['url'] ); ?></a></td>
      <td align="center"><?php echo htmlentities( $record['category'] ); ?></td>
      <td align="center"><a href="tools_photo.php?id=<?php echo $record['id']; ?>"><i class="fas fa-camera"></i></a></td>
      <td align="center"><a href="tools_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="tools.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this tool?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="tools_add.php"><i class="fas fa-plus-square"></i> Add Tool</a></p>


<?php

include( 'includes/footer.php' );

?>