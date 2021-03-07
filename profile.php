<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>



<?php
$result = DB::getInstance();
$user = new User();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
    if(Input::exists()){
        if(Input::get('removeOwn')){
            $result->delete("objects", array('id', '=', Input::get('objID')));
        }
        if(Input::get('stopRenting')){
           $user->stopRenting(Input::get('objID'));
        }
    }
?>

<h1>Your information</h1>
<p>Name:<?php echo $user->data()->username;?>
<br>Email:<?php echo $user->data()->email;?>
</p>
<h1>Objects you're renting out</h1>
<?php
$result = $result->get("objects", array('userID', '=', $user->data()->userID));

if(!$result->count()){
    echo "No objects";
}else{
    foreach($result->results() as $result){
    ?>
                <h3><?php echo $result->objName; ?></h3>
                <?php if($result->images != null){
                    $imageName = "images/uploads/" . $result->images;
                    ?>
                    <img src="<?php echo $imageName; ?>" class="img-thumbnail" alt="images/paket.jpg" width="404">

                    <?php
                }else{
                ?>
                <img src="images/paket.jpg" class="img-thumbnail" alt="images/paket.jpg" width="404">
                <?php
                }
                ?>


                <p>Price:<?php echo $result->price; ?><br>Space:<?php echo $result->sqm; ?><br>Place:<br>Available from:</p>
                <form action="" method="post">
                    <input type="hidden" name="objID" value="<?php echo $result->id ?>"> 
                    <input type="submit" name="removeOwn" value="Remove object">

            
                </form>

                <hr class="itemDivider">
 <?php   
    }
}
?>

<h1>Objekt du hyr</h1>

<?php
$result = DB::getInstance();
$result->get("objects", array('renterID', '=', $user->data()->userID));

if(!$result->count()){
    echo "No objects";
}else{
    foreach($result->results() as $result){
    ?>
                <h3><?php echo $result->objName; ?></h3>
                <?php if($result->images != null){
                    $imageName = "images/uploads/" . $result->images;
                    ?>
                    <img src="<?php echo $imageName; ?>" class="img-thumbnail" alt="images/paket.jpg" width="404">
                    <?php
                }else{
                ?>
                <img src="images/paket.jpg" class="img-thumbnail" alt="images/paket.jpg" width="404">
                <?php
                }
                ?>


                <p>Price:<?php echo $result->price; ?><br>Space:<?php echo $result->sqm; ?><br>Place:<br>Available from:</p>
                <form action="" method="post">
                    <input type="hidden" name="objID" value="<?php echo $result->id ?>"> 
                    <input type="submit" name="stopRenting" value="Stop renting">
            
                </form>

                <hr class="itemDivider">
 <?php   
    }
}
?>
<br>
<a href="logout.php" class="btn btn-danger btn-lg">Logga ut</a>