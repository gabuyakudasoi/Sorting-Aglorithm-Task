<!DOCTYPE html>
<html>
<head>
    <title>Bubble Sort Example</title>
</head>
<body>
    <h2>Bubble Sort (Ascending / Descending)</h2>
    <form method="post">
        <label>Enter numbers (comma-separated):</label><br>
        <input type="text" name="numbers" value="<?php echo isset($_POST['numbers']) ? htmlspecialchars($_POST['numbers']) : ''; ?>" required>
        <br><br>

        <label>Choose Order:</label><br>
        <input type="radio" name="order" value="asc" <?php if(isset($_POST['order']) && $_POST['order']=="asc") echo "checked"; ?>> Ascending
        <input type="radio" name="order" value="desc" <?php if(isset($_POST['order']) && $_POST['order']=="desc") echo "checked"; ?>> Descending
        <br><br>

        <input type="submit" value="Sort">
    </form>

    <?php
    // Define bubble sort function
    function bubbleSort($arr, $order = "asc") {
        $n = count($arr);
        $swaps = 0;
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                $condition = ($order == "asc") ? ($arr[$j] > $arr[$j + 1]) : ($arr[$j] < $arr[$j + 1]);
                if ($condition) {
                    // Swap values
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $swaps++;
                }
            }
        }
        return ["sorted" => $arr, "swaps" => $swaps];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numbers = explode(",", $_POST["numbers"]);
        $numbers = array_map('trim', $numbers); // remove spaces
        $numbers = array_map('intval', $numbers); // convert to integers
        $order = $_POST["order"] ?? "asc";

        $original = $numbers;
        $result = bubbleSort($numbers, $order);
        $sorted = $result["sorted"];
        $swaps = $result["swaps"];

        echo "<h3>Results:</h3>";
        echo "Original Array: [" . implode(", ", $original) . "]<br>";
        echo "Sorted ($order): [" . implode(", ", $sorted) . "]<br>";
        echo "Total Swaps: $swaps";
    }
    ?>
</body>
</html>
