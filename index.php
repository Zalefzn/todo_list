<!DOCTYPE html>

<?php 
    include 'db.php';
    
    $page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
    $perPage = (isset($_GET['per-page'])  && (int)$_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 5);
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $sql = "select * from tasks limit ".$start." , ".$perPage." ";
    $total = $db->query("select * from tasks")->num_rows;
    $pages = ceil($total / $perPage);

    $rows = $db->query($sql);
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
               <center><h1>Todo List</h1></center>
               <div class="col-md-10 col-md-offset-1">

                    
                
               <table class="table table-hover">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Task</button>
                <button type="button" class="btn btn-warning pull-right">Print</button>
                <hr><br>

                <div class="col-md-10 col-md-offset-1 text-center" style="margin-top: 20px; margin-bottom: 20px">
                <p>Search</p>
                    <form method="post" action="search.php" class="form-group">
                        <input type="text" placeholder="search name here..." class="form-control" name="search">
                    </form>
                </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Task</h4>
                    </div>
                    <div class="modal-body">
                       <form method="post" action="add.php">
                            <div class="form-group">
                                <label>Task Name</label>
                                <input type="text" required name="task" class="form-control">
                            </div>
                            <input type="submit" name="send" value="Add Task" class="btn btn-success">
                       </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <thead>
                <tr>
                <th scope="col">id.</th>
                <th scope="col">Task</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    while($row = $rows->fetch_assoc()):
                ?>    
                <th scope="row"><?php echo $row['id'] ?></th>
                <td class="col-md-10"><?php echo $row['name'] ?></td>
                <td><a href="update.php?id= <?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
                <td><a href="delete.php?id= <?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
                <?php
                    endwhile;
                ?>
            </tbody>
        </table>
        <center>
            <ul class="pagination">
                <?php 
                    for($i = 1; $i <= $pages; $i++):
                ?>
                <li><a href="?page=<?php echo $i ?>&per-page=<?php echo $perPage ?>"><?php echo $i ?></a></li>
                <?php
                    endfor;
                ?>
            </ul>
        </center>
               </div>
            </div>
        </div>
    </body>
</html>