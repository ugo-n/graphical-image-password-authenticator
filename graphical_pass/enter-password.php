<?php
include 'common.php';
include 'db_controller.php';
session_start();
if(isset($_POST['submit1'])){
    $_SESSION["username"] = $_POST['username'];
}

$username = $_SESSION['username'];


$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql =   $sql ="SELECT * FROM userinfo WHERE username='$username'";
$result = $conn->query($sql);
$arr;
if($row = mysqli_fetch_assoc($result)){
    $arr[] = $row['pass_id1'];
    $arr[] = $row['pass_id2'];
    $arr[] = $row['pass_id3'];
    $arr[] = $row['pass_id4'];
    $arr[] = $row['pass_id5'];
}

$conn->close();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['submit1'])){

    }else if($_POST['submit2']){
        if($_POST['pass1'] == $arr[0] and $_POST['pass2'] == $arr[1] and $_POST['pass3'] == $arr[2] and $_POST['pass4'] == $arr[3] and $_POST['pass5'] == $arr[4]){
            header('Location: https://www.google.com/');
            exit();
        }else{
            echo "you didn't do that right";
        }
    }
}


$foodnames = file_get_contents("food_names.txt");
$animalnames = file_get_contents("animal_names.txt");
$transportnames = file_get_contents("transport_names.txt");
$foodarray = explode("\n", $foodnames);
$animalarray = explode("\n", $animalnames);
$transportarray = explode("\n", $transportnames);
//$pass = file_get_contents("pass-test.txt");
//$pass_array = explode(",", $pass);



$all_images = array_merge($foodarray, $animalarray, $transportarray);
// $r_array = array_rand($all_images, 31);
// for($i = 0; $i < 31; $i++){
//     $r_array[$i] = $all_images[$r_array[$i]];
// }

/*function create_unique($pass_array, $r_array, $all_images){
    $merged = array_merge($pass_array, $r_array);
    $unique = array_unique($merged);
    /*while(count($unique) != 36){
        $new = array_rand($all_images, 36 - count($unique));
        for($i = 0; $i < count($new); $i++){
            $new[$i] = $all_images[$new[$i]];
        }
        $merged = array_merge($unique, $new);
        $unique = array_unique($merged);
    }
    return $unique;
}

$unique = create_unique($pass_array, $r_array, $all_images);*/
//$unique =  shuffle($unique);
//$merged = array_merge($pass_array, $r_array);
//$merged = array_unique($merged);
//shuffle($merged);


print_r($arr);

?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Password Prototype</title>
    <link rel="stylesheet" href="prototype.css">

    <!--script for generating images-->
    <!--needs to be cleaned,,,-->
    <script type="text/javascript">
        var images_array = 
        <?php echo json_encode($all_images); ?>; 
        var count = 0;
        var tracker = new Map();
        var password = "";
        
        function generateList(){
            var array = <?php echo json_encode($arr); ?>;
            console.log(array);
            var image_bank =  new Map();

            for(var k = 0; k < 5; k++){
                image_bank.set(array[k]);
            }       
            while(image_bank.size < 36){
                var img = getRandomItem(images_array);
                if(image_bank.has(img)){
                    continue;
                }else{
                    image_bank.set(img)
                }
            }

            var image_bank_shuffled = Array.from(image_bank.keys());
            image_bank_shuffled = shuffle(image_bank_shuffled);

            <?php //echo json_encode($merged); ?> //getRandom(images_array, 36), 
            var listElement = document.getElementById('enter-list'),
            listItem, imageItem,
            startPath = "icons/",
            i;

            var numberOfListItems = image_bank_shuffled.length;

            for(i = 0; i < numberOfListItems; ++i){
                listItem = document.createElement('li');
                imageItem = document.createElement('img');
                imageItem.setAttribute('src', startPath + image_bank_shuffled[i] + '.png');
                imageItem.setAttribute('id', image_bank_shuffled[i]);
                imageItem.setAttribute('class', "images");
                listItem.appendChild(imageItem);
                listElement.appendChild(listItem);
            }

            let imgs = document.querySelectorAll('.images');
            var passText = document.getElementById("pass-text").childNodes;

            for (i of imgs) {
                i.addEventListener('click', function() {
                    //console.log(imageSelect[count])
                    //if all images for password have not been selected
                    if(count <= 4){
                        //check if this image has already been chosen
                        if(!tracker.has(this.id)){
                            //if not chosen yet, select image
                            tracker.set(this.id);
                            passText[count].value = this.id;
                            console.log( passText[count].value);
                            this.style.opacity = 0;
                            count++;
                        }   
                    }
                    console.log(password);
                });
            }
        }
        function clearSelect(){
            //redisplay images

            var imageSelect = document.getElementsByClassName("images");
            var passText = document.getElementById("pass-text").childNodes;
            for(var i = 0; i <= 35; i++){
                imageSelect[i].style.opacity = .65;
            }
            tracker.clear();
            for(var i = 0; i <= 4; i++){
                passText[i].value = "";
            }
            count = 0;
        }
        function getRandomItem(arr){
             // get random index value
            const randomIndex = Math.floor(Math.random() * arr.length);
            // get random item
            const item = arr[randomIndex];
            return item;
        }
        //https://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
        function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {

            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
        }
        //code referenced from Bergi
        //link: https://stackoverflow.com/questions/19269545/how-to-get-a-number-of-random-elements-from-an-array
        /*function getRandom(arr, n) {
            var result = new Array(n),
                len = arr.length,
                taken = new Array(len);
            if (n > len)
                throw new RangeError("getRandom: more elements taken than available");
            while (n--) {
                var x = Math.floor(Math.random() * len);
                result[n] = arr[x in taken ? taken[x] : x];
                taken[x] = --len in taken ? taken[len] : len;
            }
            return result;
        }*/
        //end code referenced from bergi
        //link: https://stackoverflow.com/questions/19269545/how-to-get-a-number-of-random-elements-from-an-array
    </script>
</head>

<body onload="generateList()">
    <h2>Enter Password:</h2>
    <div id = "password-enter">
    <ul id="enter-list"> 
        <!--generate list of random icons-->
    </ul>
    <button id = "clear" onclick="clearSelect()"> clear selection </button>
    </div>
    <form action="enter-password.php"
                method="post"> 
            <div id="pass-text" ><input type="text" id="pass1" name="pass1" style=><input type="text" id="pass2" name="pass2" ><input type="text" id="pass3" name="pass3" ><input type="text" id="pass4" name="pass4" ><input type="text" id="pass5" name="pass5" >
            </div>
        
        <input type="submit" name="submit2" value="Login"/>

    </form>
</body>
<?php
pFooter();
?>