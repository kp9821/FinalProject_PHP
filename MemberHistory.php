<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>Member History</title>
        <style>
            .amt{
                text-align: right;
            }
            body, table {

                font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
            }
            p.totalAmount {
                font-size: 1.5em;

            }



        </style>
    </head>

    <body>
        <h1>Member Transaction History</h1>
        <?php
        $memberID = $_GET['MemId'];

        if ($memberID) {

            require_once './dbtest.php';

            $query = "SELECT * FROM tblMembers WHERE MemID = '$memberID';";

            $result = mysqli_query($dbc, $query);

            if (mysqli_num_rows($result)) {

                $row = mysqli_fetch_array($result);

                echo "<p>Member ID: " . $row['MemID'] . "<br>";

                echo "<p>Member Name: " . $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . "<br>";

                echo "<p>Member Joined: " . $row['MemDt'] . "<br>";

                echo "<p>Member Status: " . $row['Status'] . "<br> </p>";
            } else {

                echo "<p> Member Not Found </p>";
            }

            echo "<table border = '1'>";
            echo "<caption> Transaction History</caption>";
            echo "<tr>";
            echo "<th> Purchase Date </th>";
            echo "<th> Transaction Code </th>";
            echo "<th> Transaction Desc. </th>";
            echo "<th> Transaction Type </th>";
            echo "<th> Transaction Amount </th>";
            echo "</tr>";

            $query2 = "SELECT p.Memid, p.PurchaseDt, p.TransCd, c.TransDesc, 
                   p.TransType, p.Amount FROM tblpurchases p, tblcodes c
                   WHERE p.TransCd = c.TransCd AND p.MemId = '$memberID'
                ORDER BY p.MemId, p.PurchaseDt, p.TransCd;";

            $result2 = mysqli_query($dbc, $query2);

            $total_purchase = 0;

            while ($row = mysqli_fetch_array($result2)) {

                echo "<tr>";
                echo "<td>" . $row['PurchaseDt'] . "</td>";
                echo "<td>" . $row['TransCd'] . "</td>";
                if ($row['TransCd'] != '00') {
                    $total_purchase += $row['Amount'];
                }
                echo "<td>" . $row['TransDesc'] . "</td>";
                echo "<td>" . $row['TransType'] . "</td>";
                echo "<td class='amt'>$" . number_format($row['Amount'], 2) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<p> No member history found.</p>";
        }

        echo "</table>";

        echo "<p class='totalAmount'> Total Purchase in Club = $" . number_format($total_purchase, 2) . "</p>";
        ?>
    </body>

</html>