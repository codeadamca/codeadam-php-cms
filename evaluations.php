<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM evaluations
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'Evaluations has been deleted' );
  
  header( 'Location: evaluations.php' );
  die();
  
}

$query = 'SELECT *
  FROM evaluations
  ORDER BY dateAdded';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Evaluations</h2>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Text</th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['text'] ); ?>
      </td>
      <td align="center"><a href="evaluations_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="evaluations.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this evaluation?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="evaluations_add.php"><i class="fas fa-plus-square"></i> Add Evaluation</a></p>


<?php

include( 'includes/footer.php' );

?>