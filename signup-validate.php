<?php


        function PasswordValidate()
        {
            $wachtwoord = $_POST['Password'];
            if (strlen($wachtwoord) <= 8) {
                echo "<p>Je wachtwoord moet minimaal 8 tekens lang zijn. </p>";
            } elseif (!preg_match("#[0-9]+#", $wachtwoord)) {
                echo "<p>Je wachtwoord moet minimaal 1 getal bevatten. </p>";
            } elseif (!preg_match("#[a-zA-Z]+#", $wachtwoord)) {
                echo "<p>Je wachtwoord Moet minimaal 1 hoofdletter bevatten. </p>";
            }

            function PasswordCompare()
            {
                $wachtwoord = $_POST['Password'];
                $wachtwoord2 = $_POST['Confirm password'];
                if ($wachtwoord !== $wachtwoord2) {
                    echo "<p>Wachtwoorden komen niet overeen</p>";
                }
            }
        }
