<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Php-crud</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
    </head>

    <body>
    <?php require_once 'process.php'; ?>
    <?php
    if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message'])
        ?>
    </div>
    <?php endif; ?>
        <div class="row justify-content-center pt-3 " >
            <form action="process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group" >
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="E.g.: Jon Doe...">
                </div>
                <div class="form-group">
                    <label>Technology</label>
                    <input type="text" class="form-control" name="tech" value="<?php echo $tech; ?>" placeholder="E.g.: Angular">
                </div>
                <div class="form-group">
                    <?php if ($update == true): ?>
                    <button type="submit" class="btn btn-primary btn-block rounded" name="update">Update</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary btn-block rounded" name="save">Save</button>
                    <?php endif ?>
                </div>
            </form>
        </div>
        <hr style="width: 90%">
    <?php
        $mysqli = new mysqli('localhost', 'root','1234', 'data') or die(mysqli_error($mysqli));
        $result = $mysqli->query('SELECT * FROM data') or die($mysqli->error);
        ?>
    <div class="justify-content-center" style="margin-left: 20%;margin-right: 20%">
        <table class="table" style="text-align: center; border-bottom: lightgray 1px solid">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Technology</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php while($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['tech']; ?></td>
                <td>
                    <a class="btn btn-info" href="index.php?edit=<?php echo $row['id'];?>">Edit</a>
                    <a class="btn btn-danger" href="process.php?delete=<?php echo $row['id'];?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    </body>
</html>