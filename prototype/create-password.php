<?php
include 'common.php';
    $foodnames = file_get_contents("files.txt");
    $animalnames = file_get_contents("animals.txt");
    $transportnames = file_get_contents("transport.txt");
    $foodarray = explode("\n", $foodnames);
    $animalarray = explode("\n", $animalnames);
    $transportarray = explode("\n", $transportnames);


    $username;
    $count;

    //password == string of names separated by commas from selected images 
    $password;
    //Include the DB config
    require_once 'database.php';

    //regex for name requirementments
    //need to add  validation if check
    $regex = '/^[A-Za-z][A-Za-z0-9]{3,12}';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(isset($_POST['username'])) {
            // Checking if username already exists 
            $username = strtolower($_POST['username']);
            $sql = 'SELECT * FROM users WHERE username = :username';
            // Prepare a select statement
            $stmt = $conn->prepare($sql);

            //Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $rows = $stmt->rowCount();
            
            //if the username is available 
            //and the user has selected 5 images
            // if($rows != 1 && $count == 5) {
            //     unset($stmt);
            //     $sql = 'INSERT INTO users (username, password) VALUES
            //     (:username, :password)';
            //     $stmt = $conn->prepare($sql);

            //     $stmt->bindParam(':username', $username);
            //     $stmt->bindParam(':password', $password);

            //     if($stmt->execute()){
            //         header("location: signup-confirm.php");
            //         unset($stmt);
            //         unset($conn);
            //     }
            // }
            if($rows == 1 && $count < 5) {
                echo 'username already exists \n please select 5 images';
                unset($stmt);
            }else if($rows != 1  && $count < 5) {
                echo 'username is available but please select 5 images';
                unset($stmt);
            }else if($rows == 1 && $count == 5) {
                echo 'username already exists';
                unset($stmt);
            }else {
                //username available and 5 images selected
                unset($stmt);
                $sql = 'INSERT INTO users (username, password) VALUES
                (:username, :password)';
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);

                if($stmt->execute()){
                    header("location: signup-confirm.php");
                    unset($stmt);
                    unset($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Password Prototype</title>
    <link rel="stylesheet" href="prototype.css">
    <!--script for generating images-->
    <!--needs to be cleaned,,,-->
    <script type="text/javascript">
        var type = 1;
        var animalArray =  
            <?php echo json_encode($animalarray); ?>; 
        var tranportArray =  
            <?php echo json_encode($transportarray); ?>; 
        
        var foodArray =  
            <?php echo json_encode($foodarray); ?>; 

        function makeList(num){
            //make list based on start
            var listData,
            listContainer = document.getElementById('image-select-grid'),
            listElement = document.getElementById('image-list'),
            listItem,
            i,
            startPath = "icons/",
            type = num;
            //make conditional based on startPath
            switch(type){
                case 1:
                listElement = document.getElementById('image-list'),
                listData = foodArray;
                break;
                case 2:
                listElement = document.getElementById('t-image-list'),
                listData = tranportArray;
                break;
                case 3: 
                listElement = document.getElementById('a-image-list'),
                listData = animalArray;
                break;
                default:
                break;
            }

            var numberOfListItems = listData.length;

            for(i = 0; i < numberOfListItems; ++i){
                listItem = document.createElement('li');

                listItem.innerHTML = "<img src='" + startPath + listData[i] + "'>"+ "</img>";

                //set ID attribute to each list container
                //may conflict, since we have multipe lists yet same IDs possibly
                listItem.setAttribute("id", i);
                
                listElement.appendChild(listItem);
            }
        }

        function makeLists(){
            makeList(2);
            makeList(1);
            makeList(3);
        }
        

        function showAnimal(){
            document.getElementById("a-image-list").style.display = "block";
            document.getElementById("t-image-list").style.display = "none";
            document.getElementById("image-list").style.display = "none";
        }
        function showFood(){
            document.getElementById("a-image-list").style.display = "none";
            document.getElementById("t-image-list").style.display = "none";
            document.getElementById("image-list").style.display = "block";
        }
        function showTransport(){
            document.getElementById("a-image-list").style.display = "none";
            document.getElementById("t-image-list").style.display = "block";
            document.getElementById("image-list").style.display = "none";
        }

        
    </script>
</head>
<body onload="makeLists()">
<!--display of the page-->



<!-- TESTING  -->
<div class="index-box">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Create a Username: 
        <input type="text" name="username" maxlength="12" size="12"
        placeholder='3-12 characters letters and numbers only'
        pattern = '/^[A-Za-z][A-Za-z0-9]{3,12}'
        required/>
        <!--limit username length to make display consistent-->
        <input type="submit" value="Sign Up"/>
     </form>
</div>
<!-- TESTING  -->



<div id = "pass-category">
    <h2>Create a Password:</h2>
    <button id = "btn" onclick="showFood()"> food list</button>
    <button id = "btn1" onclick="showTransport()"> transport list</button>
    <button id = "btn2" onclick="showAnimal()"> animal list</button>
</div>

<div id="image-select-grid">

    <ul id="image-list"> 
        <!--generate list in js of all icons for category-->
    </ul>
    <ul id="a-image-list">
    </ul>
    <ul id="t-image-list">
    </ul>
</div>

<!-- need to keep count of number of selected images -->
<h2>Chosen Images:</h2>
<div id="password-display">
    <ul id="images-selected">
        <li id = "image-1"></li>
        <li id = "image-2"></li>
        <li id = "image-3"></li>
        <li id = "image-4"></li>
        <li id = "image-5"></li>
    </ul>
</div>
<?php
pFooter();
?>

