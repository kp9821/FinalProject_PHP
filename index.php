<!DOCTYPE html>
<!--This should include Ajax using Jquery I also have left legacy style Ajax, but
files are commented out so would not load in the DOM.-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Club DB</title>
        <!--<script type = "text/javascript" src="ajax.js"></script>-->
        <script type = "text/javascript" src="jqueryAjax.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <!--<script src="Member.js"></script>-->
        <style>
            body, table {

                font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;

            }
         
        </style>
    </head>
    <body>
        <h1>Club Member Purchases Review</h1>
        <p>Select a member and click go to see transactions for that Member.</p>
        <form id="MemberForm" action="MemberHistory.php" method="get">

            <?php
            require_once './dbtest.php';

            $query = "SELECT LastName,FirstName,MiddleName,MemId 
                FROM tblMembers ORDER BY LastName, FirstName, MiddleName;";

            $result = mysqli_query($dbc, $query);

            if (mysqli_num_rows($result) > 0) {

                echo "<select id = 'MemId' name='MemId'>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value ='" . $row['MemId'] . "'>"
                    . $row['LastName'] . ", " . $row['FirstName'] .
                    " " . $row['MiddleName'] . "</option>";
                }

                echo "</select>";
            } else {
                echo "<p> No Members Found!</p>";
            }
            ?>

            <input type="submit" name="go" id="go" value="Go"/>

        </form>
        <div id="MemberHTML"></div>
    </body>
</html>
