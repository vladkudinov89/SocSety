<?php

require_once 'header.php';



    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    /*User_name START*/
    if (isset($_POST['user_name'])) {
        $user_name = sanitizeString($_POST['user_name']);

        if ($result->num_rows) {
            queryMysql("UPDATE profiles SET user_name='$user_name' where user='$user'");
        } else {
            queryMysql("INSERT INTO profiles VALUES('$user', '$user_name')");
        }
    } else {
        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $user_name = stripslashes($row['user_name']);
        } else $user_name = "";
    }
    /*User_name END*/

    /*User_SecondName START*/
    if (isset($_POST['user_secondName'])) {
        $user_secondName = sanitizeString($_POST['user_secondName']);

        if ($result->num_rows) {
            queryMysql("UPDATE profiles SET user_secondName='$user_secondName' where user='$user'");
        } else {
            queryMysql("INSERT INTO profiles VALUES('$user', '$user_secondName')");
        }
    } else {
        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $user_secondName = stripslashes($row['user_secondName']);
        } else $user_secondName = "";
    }
    /*User_SecondName END*/

    if (isset($_POST['text'])) {
        $text = sanitizeString($_POST['text']);
        $text = preg_replace('/\s\s+/', ' ', $text);

        if ($result->num_rows)
            queryMysql("UPDATE profiles SET text='$text' where user='$user'");
        else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
    } else {
        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $text = stripslashes($row['text']);
        } else $text = "";
    }

    $user_name = stripslashes(preg_replace('/\s\s+/', ' ', $user_name));
    $user_secondName = stripslashes(preg_replace('/\s\s+/', ' ', $user_secondName));
    $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

    if (isset($_FILES['image']['name'])) {
        $saveto = "$user.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
        $typeok = TRUE;

        switch ($_FILES['image']['type']) {
            case "image/gif":
                $src = imagecreatefromgif($saveto);
                break;
            case "image/jpeg":  // Both regular and progressive jpegs
            case "image/pjpeg":
                $src = imagecreatefromjpeg($saveto);
                break;
            case "image/png":
                $src = imagecreatefrompng($saveto);
                break;
            default:
                $typeok = FALSE;
                break;
        }

        if ($typeok) {
            list($w, $h) = getimagesize($saveto);

            $max = 100;
            $tw = $w;
            $th = $h;

            if ($w > $h && $max < $w) {
                $th = $max / $w * $h;
                $tw = $max;
            } elseif ($h > $w && $max < $h) {
                $tw = $max / $h * $w;
                $th = $max;
            } elseif ($max < $w) {
                $tw = $th = $max;
            }

            $tmp = imagecreatetruecolor($tw, $th);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
            imageconvolution($tmp, array(array(-1, -1, -1),
                array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
            imagejpeg($tmp, $saveto);
            imagedestroy($tmp);
            imagedestroy($src);
        }
    }

?>

<div>Ваш профиль обновлен
    <a href="profile.php">Ваш профиль</a>
</div>

<?php
require_once 'footer.php';
?>