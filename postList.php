<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>

<?php

    $test = new User();

    #Implement verification
    #Can I implement create method from user, what's the benefit of using it?
    if($test->isLoggedIn() ){
        if(Input::exists() && Token::check(Input::get('token'))){

            #$image = new Upload();
            #$image->upload();
            upload(Input::get('objName'));
            #Finds extension and concatenates with objName for filename in DB
            $target_file = basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $imageName = Input::get('objName') .".". $imageFileType;
            $test->testSpaceInsert(Input::get('objName'), Input::get('price'), Input::get('sqm'), $imageName);  
            Redirect::to('profile.php');
        }
    ?>
    <body>
        <br>
        <div class="addTopContainer">

        <div class="box-2">
            <h3><b>Create add!</b></h3>
            <p>Pleae specify details about the add</p>
        </div>

          
          <!--<div class="container-2"> -->
            <form action="" method="post" enctype="multipart/form-data">
      
                <div class="box-2">
                    <!--<label for="objName">Beskrivning av yta</label>-->
                    <input type="text" name="objName" id="objName" placeholder="Beskrivning av yta">
                </div>

                <div class="box-2">
                    <!--<label for="sqm">Storlek i kvadratmeter</label>-->
                    <input type="number" name="sqm" value="" placeholder="Storlek i kvadratmeter">
                </div>

                <div class="box-2">
                    <!--<label for="price">Månadsavgift</label>-->
                    <input type="number" name="price" value="" placeholder="Månadsavgift">
                </div>


                <div class="box-2">
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Access to water</label>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Garage</label>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Key</label>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">24/7 tillgång</label><br>
                </div>


                <!-- Token is unique to this page -->
                <input type = "hidden" name = "token" value ="<?php echo Token::generate(); ?>">
                <!--<input type = "submit" value = "Register"> -->
                <div class="box-2">
                <input type="file" name="fileToUpload" id="fileToUpload">
                </div>


                <div class="box-2">
                <input type="submit" value="Skapa annons" name="submit">
                </div>
            </form>
          <!--</div>-->
        </div>

        
        
    </body>
<?php


}else{
    echo "Log in to post listing";
}

    function upload($objName){
    $target_dir = "images/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        #echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        #echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check file size 500000
    if ($_FILES["fileToUpload"]["size"] > 500000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    #$user = new User();
    
    #$user->testFileInsert("hej");
    
    //Renames file objID + time
    $newfilename = $objName. "." .$imageFileType;
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

        ?>