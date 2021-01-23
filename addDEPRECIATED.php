<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>


<?php
    $objID = $_SESSION['rent'];
    $result = DB::getInstance();
    $result->get("objects", array('id', '=', $objID));


    if(Input::exists()){
        #if user clicked rent button
        if(Input::get('rent')){
            $_SESSION['rent'] = $objID;
            Redirect::to('rent.php');
        }
    }
    
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
    
    
                    <p>Pris:<?php echo $result->price; ?><br>Yta:<?php echo $result->sqm; ?><br>Plats:<br>Från datum:</p>
                    <form action="" method="post">
                        <input type="hidden" name="objID" value="<?php echo $result->id ?>"> 
                        <input type="submit" name="rent" value="Hyr">
                
                    </form>
    
                    <hr class="itemDivider">
     <?php   
        }
    }
    ?>



