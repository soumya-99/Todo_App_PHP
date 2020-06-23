<?php

  $errors = "";

  $conn = mysqli_connect('localhost', 'root', '', 'todo');

  if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    if (empty($task)) {
     echo "You must fill the box!!";
    } else {
      mysqli_query($conn, "INSERT INTO tasks (task) VALUES ('$task')");
      header('localhost: index.php');
    }

  }

  #-----Delete Tasks----
  if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
    header('location: index.php');
  }

  $tasks = mysqli_query($conn, "SELECT * FROM `tasks`");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List App</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
        <div class="container my-3">
            <h2 class="text-center text-danger">Add Some Contents in Todo List</h2>
            <hr>
    <form method="post" action="index.php">
            <div class="input-group mb-3">
                <input name="task" type="text" class="form-control" placeholder="Write Something..." required>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit" name="submit">Submit</button>
                  <button class="btn btn-outline-danger" type="reset">Remove</button>
                </div>
            </div>
        </div>
    </form>

    <div class="container text-center">
      <h2 class="text-success">Table of Your Tasks</h2>
      <hr>
        <table class="table table-hover table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th>No.</th>
              <th>Task</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
          <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td class="task"><?php echo $row['task']; ?></td>
              <td class="delete"><a href="index.php?del_task=<?php echo $row['id']; ?>" class="btn btn-outline-danger">Delete</a></td>
            </tr>
      <?php $i++; } ?>
            
          </tbody>
        </table>
      </div>

</body>
</html>