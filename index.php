<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otrium Challenge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>

<div class="container text-center">

    <h1>Welcome to Otrium Challange</h1>

    <form action="processdata.php" method="post" >
        
        <div class="row">
            <div class="col">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="startDate" id="startDate" value="2018-05-01">
            </div>
            <div class="col">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" class="form-control" name="endDate" id="endDate" value="2018-05-07">
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col">
                <button type="submit" name="turnOverPerBrand" id="turnOverPerBrand" class="btn btn-primary" href="#" role="button">Generate Turnover Per Brand</button>
                <button type="submit" name="turnOverPerDay" id="turnOverPerDay" class="btn btn-primary" href="#" role="button">Generate Turnover Per Day</button>
            </div>
        </div>

        <?php
        
        if (isset($error)){
            echo "<p class='text-danger'><i>{$error}</i></p>";
        }

        ?>
        
    </form>

</div>

</body>
</html>