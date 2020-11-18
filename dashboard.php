<?php
declare(strict_types=1);
require "new_order.php";
$storage = new DB_Storage($mysqli);
$orders = $storage->getAll();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Brand -->
    <a class="navbar-brand" href="#"><img src="https://lh3.googleusercontent.com/proxy/V2AmdXh641IXP0qvHxCeeXgXQY1T-XjoBgdqC0IOKt_wjkrvutoMpaFsyYXgEV2psBIxqnjTsLLgNRkXNNWARWHt_cnWqIKcn3TP-wPPPboX0doMn4I0" alt="logo" width="50"/></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="new_order.html" >New Order</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Orders
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Waiting</a>
                    <a class="dropdown-item" href="#">Closed</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">All orders</a>
                </div>
            </li>
        </ul>
    </div>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0" formaction="login.html">Log out</button>
    </form>
</nav>
<h2>List of orders</h2>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Acceptance Date</th>
        <th scope="col">Closing Date</th>
        <th scope="col">State</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        foreach ($orders as $order) {?>
        <td><?= $order->getId() ?></td>
        <td><?= $order->getName() ?></td>
        <td><?= $order->getSurname() ?></td>
        <td><?= $order->getStart() ?></td>
        <td><?= $order->getEnd() ?></td>
        <td><?= $order->getState() ?></td>
        <?php } ?>
    </tr>
    <!--<tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>01/02/2020</td>
        <td>01/02/2020</td>
        <td>Closed</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Eliz</td>
        <td>Fling</td>
        <td>01/04/2020</td>
        <td>-</td>
        <td>Open</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Peter</td>
        <td>Thorn</td>
        <td>01/09/2020</td>
        <td>-</td>
        <td>Open</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Jonah</td>
        <td>Ghost</td>
        <td>10/09/2020</td>
        <td>-</td>
        <td>Open</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Julie</td>
        <td>Young</td>
        <td>01/10/2020</td>
        <td>-</td>
        <td>Open</td>
    </tr>-->
    </tbody>
</table>

</body>
</html>
