<!DOCTYPE html>

<?php 
    include 'db.php';

    $id = (int)$_GET['id'];

    $sql = "select * from tasks where id ='$id'";

    $rows = $db->query($sql);

    $row = $rows->fetch_assoc();
    if(isset($_POST['send'])){

        $task = htmlspecialchars($_POST['task']);
        
        $sql = "update tasks set name='$task' where id='$id'";
    
        $db->query($sql);
    
        header('location: index.php');
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Todo App</title>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 70px;">
               <center><h1>Update Todo List</h1></center>
               <div class="col-md-10 col-md-offset-1">
                    <hr><br>
                        <form method="post">
                            <div class="form-group">
                                <label>Task Name</label>
                                <input type="text" required name="task" value="<?php echo $row['name']; ?>" class="form-control">
                            </div>
                            <input type="submit" name="send" value="Update Task" class="btn btn-success">&nbsp;
                            <a href="index.php" class="btn btn-warning">Back</a>
                        </form>
               </div>
            </div>
        </div>
    </body>
</html>