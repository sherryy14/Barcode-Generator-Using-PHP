<?php


require 'vendor/autoload.php';
if (isset($_POST['generate'])) {

    $code = $_POST['isbn'];
    // This will output the barcode as HTML output to display in the browser

    $n=10;
    function getName($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
     
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
     
        return $randomString;
    }
     
    $name =getName($n);
    
    $redColor = [0, 0, 0];

    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    file_put_contents("images/$name.png", $generator->getBarcode($code, $generator::TYPE_CODE_128, 3, 50, $redColor));

    // ------------- save image as an HTML -----------
    // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    // $saveImage = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_128, 3, 50, $redColor)) . '">';


    // ------------- save image in a folder ----------
    // $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
    // file_put_contents('barcode.jpg', $generator->getBarcode($code, $generator::TYPE_CODABAR));
}

?>




<!DOCTYPE html>
<html>

<head>
    <title>Generate PNG Image with Barcode</title>
</head>
<style>
  
</style>
<body>
    <h2>Generate PNG Image with Barcode</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>ISBN Number:</label>
        <input type="text" name="isbn" required><br><br>

        <input type="submit" name="generate" value="Generate Image">
    </form>

    <div class='container'><?php echo
    @$saveImage
    ?></div>
</body>

</html>