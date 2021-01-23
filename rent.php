<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>


<?php
    $user = new User();
    $objID = $_SESSION['rent'];

    if(Input::exists()){

        if(Input::get("pay")){
            #Dummy method for pay method
            $payObj = new Pay();

            if($payObj->pay() == 1){
                echo "Payment succesful";
                $rentObj = new User();
                #pass obj id and ID of user logged in
                $rentObj->rent($objID);
                Redirect::to('profile.php');
            }else{
                echo "Payment not succesful";
            }
            #pay method that returns 1 followed by
            #rent method that pairs users
        }
    }


    $result = DB::getInstance();
        $result->get("objects", array('id', '=', $objID));
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

                        <!-- Make sure user doesn't own add and is not renting it-->
                        <?php
                            $userID = $user->data()->userID;
                            $testy = $result->userID;
                            #if userID doesn't match userID in object record
                            if($userID != $testy){
                                ?>
                                <form action="" method="post">
                                    <input type="submit" name="pay" value="Rent">
                                </form>
                                <?php
                            }elseif($result->available != 0){
                                echo "Otur, annons redan uthyrd :/";
                            }else{
                                echo "Din egen annons";
                            }
                      
                        ?>
                        <hr class="itemDivider">
         <?php   
            }
?>

