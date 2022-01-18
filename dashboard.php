<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

?>

<ul id="dashboard">
  <li>
    <a href="pages.php">
      <i class="fas fa-chalkboard fa-3x"></i>
      <br>
      Learning Pages
    </a>
  </li>
  <li>
    <a href="evaluations.php">
      <i class="fas fa-quote-left fa-3x"></i>
      <br>
      Evaluations
    </a>
  </li>
  <li>
    <a href="articles.php">
      <i class="fas fa-newspaper fa-3x"></i>
      <br>
      Articles
    </a>
  </li>
  <li>
    <a href="tools.php">
      <i class="fas fa-tools fa-3x"></i>
      <br>
      Tools
    </a>
  </li>
  <li>
    <a href="social.php">
      <i class="fas fa-share-alt-square fa-3x"></i>
      <br>
      Social
    </a>
  </li>
  <li>
    <a href="topics.php">
      <i class="fas fa-columns fa-3x"></i>
      <br>
      Topics
    </a>
  </li>
  <li>
    <a href="users.php">
      <i class="fas fa-user fa-3x"></i>
      <br>
      Users
    </a>
  </li>
</ul>

<?php

include( 'includes/footer.php' );

?>