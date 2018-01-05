<?php

class CsvProcessor {

    private $fileData;

    public function __construct($pathToFile)
    {
        $this->fileData = fopen($pathToFile, 'r');
    }

    private function getCsvRow() {
        return fgetcsv($this->fileData, 4096,',');
    }

    private function convertToUSD($number) {
        setlocale(LC_MONETARY,"en_US");
        return money_format('$%i',$number);
    }

    private function formatCadConversionApiUrl($float)
    {
        return sprintf('https://finance.google.com/finance/converter?a=%s&from=USD&to=CAD',$float);
    }

    private function convertUsdToCad($float) {
        $ch = curl_init();
        $timeout = 5;
        $url = $this->formatCadConversionApiUrl($float);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function csvToHtmlTable()
    {
        $counter            = 0;
        $totalCost          = 0;
        $totalPrice         = 0;
        $totalQty           = 0;
        $totalProfitMargin  = 0;
        $costKey            = null;
        $priceKey           = null;
        $headerColumns      = [];
        $footerColumns      = ['Average Price','Total QTY','Average Profit Margin','Total Profit (USD)','Total Profit (CAD)'];
        $table              = '<table>';
        $color = 'green';


        while($data = $this->getCsvRow())
        {
            // $data == array of columns
            $table .= $counter == 0 ? '<thead>' : $counter == 1 ? '<tbody>' : '';
            $table .= '<tr>';
            for($c = 0; $c < count($data); $c++)
            {
                $columnData = $data[$c];
                if($counter == 0) {
                    $headerColumns[$c] = $data[$c];
                    if($data[$c] == 'Cost') {
                        $costKey = $c;
                    }

                    if($data[$c] == 'Price') {
                        $priceKey = $c;
                    }
                } else {
                    $currentPrice = $data[$priceKey];
                    $currentCost  = $data[$costKey];

                    switch ($headerColumns[$c]) {
                        case 'Cost':
                            $totalCost += $columnData;
                            $columnData = $this->convertToUsd($columnData);
                            break;
                        case 'Price':
                            $totalPrice += $columnData;
                            $columnData = $this->convertToUsd($columnData);
                            break;
                        case 'QTY':
                            $color = $columnData < 0 ? 'red' : 'green';
                            $totalQty += $columnData;
                            break;
                        case 'Profit Margin':
                            $color = $columnData < 0 ? 'red' : 'green';
                            $totalProfitMargin += (($currentPrice - $currentCost) / $currentCost);
                            $columnData = "%" . ($totalProfitMargin * 100);
                            break;
                        case 'Total Profit (USD)':
                            $color = $columnData < 0 ? 'red' : 'green';
                            $columnData = $this->convertToUsd($currentPrice - $currentCost);
                            // convert to USD
                            break;
                        case 'Total Profit (CAD)':
                            $color = $columnData < 0 ? 'red' : 'green';
                            $columnData = $this->convertUsdToCad($currentPrice - $currentCost);
                            // convert to CAD
                            break;
                        default;
                            break;
                    }
                }


                $table .= $counter == 0 ? sprintf('<th>%s</th>',$columnData) : sprintf('<td style="color: %s;">%s</td>',$color,$columnData);
            }
            $table .= '</tr>';
            $table .= $counter == 0 ? '</thead>' : '';
            ++$counter;
        }

        /** add footer */
        $table .= '<tfoot>';
        $table .= '<tr>';
        foreach ($footerColumns as $column)
        {
            $table .= sprintf('<th>%s</th>', $column);
        }
        $table .= '</tr>';
        $table .= sprintf('<td>%s</td>',$totalPrice / ($counter + 1)); // average price
        $table .= sprintf('<td>%s</td>',$totalQty); // total quantity
        $table .= sprintf('<td>%%s</td>',($totalPrice - $totalCost) / $totalCost) * 100;
        $table .= sprintf('<td>%s</td>',$totalPrice - $totalCost);
        $table .= sprintf('<td>%s</td>',$totalPrice - $totalCost);
        $table .= '</tfoot>';

        $table .= '</tbody></table>';

        return $table;
    }
}

