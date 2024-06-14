<?php
function calculateSellingPrice($buyingPrice, $vatPercent, $expensesPercent, $profitMarginPercent) {
    $vat = ($vatPercent / 100) * $buyingPrice;
    $expenses = ($expensesPercent / 100) * $buyingPrice;
    $profitMargin = ($profitMarginPercent / 100) * ($buyingPrice + $vat + $expenses);
    $sellingPrice = $buyingPrice + $vat + $expenses + $profitMargin;
    return array('vat' => $vat, 'expenses' => $expenses, 'profit_margin' => $profitMargin, 'selling_price' => $sellingPrice);
}

$buyingPrices = $_POST['buying_price'];
$vats = $_POST['vat'];
$expenses = $_POST['expenses'];
$profitMargins = $_POST['profit_margin'];

$results = array();

for ($i = 0; $i < count($buyingPrices); $i++) {
    $result = calculateSellingPrice($buyingPrices[$i], $vats[$i], $expenses[$i], $profitMargins[$i]);
    $results[] = $result;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calculation Results</title>
</head>
<body>
    <h1>Calculation Results</h1>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Buying Price (Ksh)</th>
            <th>VAT (Ksh)</th>
            <th>General Expenses (Ksh)</th>
            <th>Profit Margin (Ksh)</th>
            <th>Selling Price (Ksh)</th>
        </tr>
        <?php for ($i = 0; $i < count($results); $i++): ?>
        <tr>
            <td>Product <?php echo $i + 1; ?></td>
            <td><?php echo number_format($buyingPrices[$i], 2); ?></td>
            <td><?php echo number_format($results[$i]['vat'], 2); ?></td>
            <td><?php echo number_format($results[$i]['expenses'], 2); ?></td>
            <td><?php echo number_format($results[$i]['profit_margin'], 2); ?></td>
            <td><?php echo number_format($results[$i]['selling_price'], 2); ?></td>
        </tr>
        <?php endfor; ?>
    </table>
</body>
</html>
