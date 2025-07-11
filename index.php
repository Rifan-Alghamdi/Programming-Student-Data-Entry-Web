<?php
date_default_timezone_set('Asia/Riyadh');
$currentDT = (new DateTime())->format('l, F j, Y H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Student Records</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<div class="container">

  <h2>Student Information</h2>

  <form method="POST" action="insert.php" autocomplete="off">
    <div class="input-group">
      <i class="fa fa-user icon"></i>
      <input type="text" name="name" placeholder="Name" required />
    </div>
    <div class="input-group">
      <i class="fa fa-calendar icon"></i>
      <input type="number" name="age" placeholder="Age" min="1" required />
    </div>
    <div class="input-group">
      <i class="fa fa-phone icon"></i>
      <input type="text" name="phone" placeholder="Phone" required />
    </div>
    <div class="input-group">
      <i class="fa fa-envelope icon"></i>
      <input type="email" name="email" placeholder="Email" required />
    </div>
    <button type="submit">Add Student</button>
  </form>

  <h3>Current Records</h3>
  <table>
    <thead>
      <tr><th>ID</th><th>Name</th><th>Age</th><th>Phone</th><th>Email</th></tr>
    </thead>
    <tbody>
      <?php
      $conn2 = new mysqli("localhost", "root", "", "prog_task2");
      if ($conn2->connect_error) {
          echo "<tr><td colspan='5'>Connection failed</td></tr>";
      } else {
          $result = $conn2->query("SELECT * FROM users ORDER BY id ASC");
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>" . htmlspecialchars($row['id']) . "</td>
                          <td>" . htmlspecialchars($row['name']) . "</td>
                          <td>" . htmlspecialchars($row['age']) . "</td>
                          <td>" . htmlspecialchars($row['phone']) . "</td>
                          <td>" . htmlspecialchars($row['email']) . "</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='5'>No records found</td></tr>";
          }
          $conn2->close();
      }
      ?>
    </tbody>
  </table>

  <div class="datetime"><?php echo $currentDT; ?></div>

</div>

</body>
</html>