<?php
include 'common.php';
$foodnames = file_get_contents("files.txt");
    $animalnames = file_get_contents("animals.txt");
    $transportnames = file_get_contents("transport.txt");
    $foodarray = explode("\n", $foodnames);
    $animalarray = explode("\n", $animalnames);
    $transportarray = explode("\n", $transportnames);

    $all_images = array_merge($foodarray, $animalarray, $transportarray)
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
        
        function generateList(){
            var image_bank = getRandom(images_array, 36), listElement = document.getElementById('enter-list'),
            listItem,
            startPath = "icons/",
            i;

            var numberOfListItems = image_bank.length;

            for(i = 0; i < numberOfListItems; ++i){
                listItem = document.createElement('li');

                listItem.innerHTML = "<img src='" + startPath + image_bank[i] + "'>"+ "</img>";

                listElement.appendChild(listItem);
            }

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
    </div>
    <form action="login-confirm.php"
                method="post"> 
        <input type="submit" value="Login"/>

    </form>
</body>
<?php
pFooter();
?>