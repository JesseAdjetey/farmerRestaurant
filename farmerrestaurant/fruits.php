<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List of Fruits</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background-image: url('background.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        font-family: monospace;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: white
    }
    .fruits {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .fruit-button {
        margin: 10px;
        padding: 30px 70px;
        font-size: 16px;
        background-color: rgba(255, 255, 255, 0.7); 
        border: none;
        border-radius: 15px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .fruit-button:hover {
        background-color: orange;
    }
    .fruit-info {
        display: none;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 20px;
        position: absolute;
        top: 50%;
        left: 280px; /* Adjusted to move to the far left */
        transform: translate(-50%, -50%);
        z-index: 999;
    }
    .fruit-info img {
        width: 500px; /* Adjust image width */
        height: auto;
        float: left;
        margin-right: 20px;
    }
    .fruit-details {
        font-size: 18px;
    }
</style>
</head>
<body>
<h1>FRUITS   </h1>
<?php
$url = 'http://awt.eastus.cloudapp.azure.com/test/api.php';
$response = file_get_contents($url);
$fruits = json_decode($response, true);

if ($fruits !== null) {
    echo '<div class="fruits">';
    foreach ($fruits as $index => $fruit) {
        echo '<button class="fruit-button" data-index="' . $index . '">' . $fruit['Fruit'] . ' - ' . $fruit['Amount'] . '</button>';
    }
    echo '</div>';
} else {
    echo 'Failed to fetch fruits.';
}
?>

<div id="fruit-info-container" class="fruit-info">
    <span id="fruit-name"></span><br>
    <span id="fruit-amount"></span><br>
    <img id="fruit-image" src="" alt="Fruit Image">
</div>

<script>
    const fruitButtons = document.querySelectorAll('.fruit-button');
    const fruitInfoContainer = document.getElementById('fruit-info-container');
    const fruitName = document.getElementById('fruit-name');
    const fruitAmount = document.getElementById('fruit-amount');
    const fruitImage = document.getElementById('fruit-image');

    fruitButtons.forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            const selectedFruit = <?php echo json_encode($fruits); ?>[index];
            fruitName.textContent = selectedFruit.Fruit;
            fruitAmount.textContent = 'Amount: ' + selectedFruit.Amount;
            fruitImage.src = 'pic' + (parseInt(index) + 1) + '.jpg'; // Assuming images are named pic1.jpg, pic2.jpg, etc.
            fruitInfoContainer.style.display = 'block';
        });
    });

    fruitInfoContainer.addEventListener('click', function(event) {
        if (!event.target.closest('.fruit-info')) {
            fruitInfoContainer.style.display = 'none';
        }
    });
</script>

</body>
</html>
