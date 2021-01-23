<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
    #Already started
    #session_start(); 
?>

<body>
    <!-- 
    Drag for price and space
    Drop down menu for cities 
    Below the filter have an automatic load of existing spaces
    
        <br>
        <li>Why isnt media working for picture size</li>
        <li>How to make adds drop one after another</li>
        <li>If click picture go to object</li>
  -->
        <div class="searchTopContainer">

        <h3><b>Rent Self-Storage Units, Nearby!</b></h3>
        <p>Looking for storage space? Start browsing here!</p>

        
        <form action="" method="post">
            <div class="field">
                <label for="sqm">Område</label>
                <input type="number" name="sqm" value="">
            </div>

            <div class="field">
                <label for="car">Garage</label>
                <input type="checkbox" id="car" name="car" value="car">
                <br>
                <label for="vehicle1">Vattentillgång</label>
                <input type="checkbox" id="vehicle1" name="water" value="Water">
                

            </div>

            <input type = "submit" value = "Filter" name = "filter" class="btn btn-danger btn-md"> 
        </form> 

        </div>


        
            <!-- Token is unique to this page 
            <input type = "hidden" name = "token" value ="# ?php echo Token::generate(); ?>">
            -->

             

             
</body>
</html>


        
    <?php

        #Shows results after filter
        if(Input::exists()){
            #if user clicked rent button
            if(Input::get('rent')){
                $_SESSION['rent'] = Input::get('objID');
                Redirect::to('rent.php');
            }
            $result = DB::getInstance();

            #filter selected
            if(Input::get('filter')){
                
                $sqlTest = "SELECT * FROM objects WHERE available = :a";
                $params = array('0');

                #Ascii for 'b'
                $chrNmb = 98;

                if(Input::get('car')){
                    array_push($params, '1');
                    $sqlTest .= " AND car = :"; 
                    $sqlTest .= chr($chrNmb);
                    $chrNmb++;
                }

                if(Input::get('water')){
                    array_push($params, '3');
                    $sqlTest .= " AND sqm > :";
                    $sqlTest .= chr($chrNmb);
                    $chrNmb++;
                }


                
                #$params = array('0', '1');
                $result->query2($sqlTest, $params);
                
                #$arrayResults = $result->results();
                #foreach($arrayResults as $value){
                #    echo $value;
                #}
                if(!$result->count()){
                    echo "No objects";
                }else{
                    ?>
                    <div class="textHeadAdds">
                        <h2 class="glow">Discover Our Latest & Greatest Storage Units</h2>
                        
                        <p class="paragraphHeadAdds">You’ve got stuff to store and vehicles to park? Rent Lock-up Garages & Garage Space with Stashbee. It’s a match made in heaven.</p>
                    </div>
                    
                    <div class="container-1">
                        <div class="row">
                    
                    <?php
                    foreach($result->results() as $result){
                        ?>
                               <!--<a href="add.php">-->
                               <div class="box-1">
                                    
                                    <?php if($result->images != null){
                                        $imageName = "images/uploads/" . $result->images;
                                        ?>
                                        <div class="image-container">
                                            <img class="image-object" src="<?php echo $imageName; ?>" class="img-thumbnail" alt="images/paket.jpg" width="404">
                                        </div>
                                        <?php
                                    }else{
                                    ?>
                                    <img src="images/paket.jpg" class="img-thumbnail" alt="images/paket.jpg">
                                    <?php
                                    }
                                    ?>
                                    <div class="text-container">
                                        <h5>Stockholm</h5>
                                        <h4><b><?php echo $result->objName; ?></b></h4>
                                        <p>Yta:<?php echo $result->sqm; ?><br>Plats:<br>Från datum:</p>
                                        <h5><b><?php echo $result->price; ?></b>/month</h5>
                                    </div>
                                    
                                    
                                    <form action="" method="post">
                                        <input type="hidden" name="objID" value="<?php echo $result->id ?>"> 
                                        <input type="submit" name="rent" value="Titta på annons">
                                
                                    </form>
                                    
                                </div>
                                <!--</a>-->
    
                                 
                    <?php   
                        }
                }
            }


            #If user has not selected filters, list all available
        }else{
            $result = DB::getInstance();
            $result->get("objects", array('available', '=', '0'));
                #$arrayResults = $result->results();
                #foreach($arrayResults as $value){
                #    echo $value;
                #}
                if(!$result->count()){
                    echo "No objects";
                }else{
                    ?>
                    <div class="textHeadAdds">
                        <h2 class="glow">Discover Our Latest & Greatest Storage Units</h2>
                        
                        <p class="paragraphHeadAdds">You’ve got stuff to store and vehicles to park? Rent Lock-up Garages & Garage Space with Stashbee. It’s a match made in heaven.</p>
                    </div>
                    
                    <div class="container-1">
                        <div class="row">
                    
                    <?php
                    


                    foreach($result->results() as $result){
                    ?>
                           
                           <div class="box-1">
                                
                                <?php if($result->images != null){
                                    $imageName = "images/uploads/" . $result->images;
                                    ?>
                                    <div class="image-container">
                                        <img class="image-object" src="<?php echo $imageName; ?>" class="img-thumbnail" alt="images/paket.jpg" width="404">
                                    </div>
                                    <?php
                                }else{
                                ?>
                                <img src="images/paket.jpg" class="img-thumbnail" alt="images/paket.jpg">
                                <?php
                                }
                                ?>
                                <div class="text-container">
                                    <h5>Stockholm</h5>
                                    <h4><b><?php echo $result->objName; ?></b></h4>
                                    <p>Yta:<?php echo $result->sqm; ?><br>Plats:<br>Från datum:</p>
                                    <h5><b><?php echo $result->price; ?></b>/month</h5>
                                </div>
                                
                                
                                <form action="" method="post">
                                    <input type="hidden" name="objID" value="<?php echo $result->id ?>"> 
                                    <input type="submit" name="rent" value="Titta på annons">
                            
                                </form>
                                
                            </div>     
                <?php   
                    }
                ?>
  
            </div>
            <?php
                }
        }
        ?>
    