<?php
include 'common.php';
    $foodnames = file_get_contents("food_names.txt");
    $animalnames = file_get_contents("animal_names.txt");
    $transportnames = file_get_contents("transport_names.txt");
    $foodarray = explode("\n", $foodnames);
    $animalarray = explode("\n", $animalnames);
    $transportarray = explode("\n", $transportnames);
    $pass = file_get_contents("pass-test.txt");
    $pass_array = explode(",", $pass);



    $all_images = array_merge($foodarray, $animalarray, $transportarray);
    $r_array = array_rand($all_images, 31);
    for($i = 0; $i < 31; $i++){
        $r_array[$i] = $all_images[$r_array[$i]];
    }

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
    $merged = array_merge($pass_array, $r_array);
    $merged = array_unique($merged);
    shuffle($merged);

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
            var image_bank =  <?php echo json_encode($merged); ?>, //getRandom(images_array, 36), 
            listElement = document.getElementById('enter-list'),
            listItem, imageItem,
            startPath = "icons/",
            i;

            var numberOfListItems = image_bank.length;

            for(i = 0; i < numberOfListItems; ++i){
                listItem = document.createElement('li');
                imageItem = document.createElement('img');
                imageItem.setAttribute('src', startPath + image_bank[i] + '.png');
                imageItem.setAttribute('id', image_bank[i]);
                imageItem.setAttribute('class', "images");
                listItem.appendChild(imageItem);
                listElement.appendChild(listItem);
            }

            let imgs = document.querySelectorAll('.images');

            for (i of imgs) {
                i.addEventListener('click', function() {
                    //console.log(imageSelect[count])
                    //if all images for password have not been selected
                    if(count <= 4){
                        //check if this image has already been chosen
                        if(!tracker.has(this.id)){
                            //if not chosen yet, select image
                            tracker.set(this.id);
                            password += this.id + ",";
                            document.getElementById("text-input").value = password;
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
            for(var i = 0; i <= 35; i++){
                imageSelect[i].style.opacity = .65;
            }
            tracker.clear();
            password = "";
            document.getElementById("text-input").value = password;
            count = 0;
        }
        //code referenced from Bergi
        //link: https://stackoverflow.com/questions/19269545/how-to-get-a-number-of-random-elements-from-an-array
        function getRandom(arr, n) {
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
        }
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
    <form action="login-confirm.php"
                method="post"> 
        <input type="text" id = "text-input" name="password" style="display:none">
        
        <input type="submit" value="Login"/>

    </form>
    <?php print_r($merged); ?>
</body>
<?php
pFooter();
?>