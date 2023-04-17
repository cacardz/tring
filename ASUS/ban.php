<?php
function checkIfBanned($loginAttmpt = false, $loginSuccess = false)
{
    $limit =  3;

    $string = "mysql:host=localhost; dbname=asus";
    if (!$con = new PDO($string, 'root', '')) {
        die("could not connect");
    }

    $ip = get_ip();
    $query =  "select * from banneduser where ipAddress = :ip limit 1";
    $stm = $con->prepare($query);
    if ($stm) {
        $check = $stm->execute(['ip' => $ip,]);
        if ($check) {
            $row = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($row) && count($row) > 0) {
                $row = $row[0];
                $time = time();
                if ($row['banned'] > $time) {
                    //kung ma ban
                    header("Location: denied.php");
                    die;
                } else {
                    if ($loginAttmpt) {
                        if ($row['loginAttempt'] >= $limit && !$loginSuccess) {
                            if (!isset($_SESSION['delay'])) {
                                //kung wala pa na set ang delay atong e set ug 30 sec
                                $delay = 30;
                            } else {
                                $delay = $_SESSION['delay'];
                            }
                            $query = "update banneduser set banned = :banned, loginAttempt = loginAttempt + 1, startingTime = startingTime + .5 where id = :id limit 1";
                            $expire = strtotime("$delay second");
                            $stm = $con->prepare($query);
                            $check = $stm->execute(['id' => $row['id'], 'banned' => $expire,]);
                            $delay += 30;
                            $_SESSION['delay'] = $delay;
                            return;
                        } else if ($loginSuccess) {
                            //e reset ang login attempt kung mo success
                            unset($_SESSION['delay']);
                            $query = "update banneduser set banned = 0, loginAttempt = 0, startingTime = 0 where id = :id limit 1";
                            $stm = $con->prepare($query);
                            $check = $stm->execute(['id' => $row['id'],]);
                        } else {
                            //dungagan ang login attempt kung mo fail
                            $query = "update banneduser set loginAttempt = loginAttempt + 1 where id = :id limit 1";
                            $stm = $con->prepare($query);
                            $check = $stm->execute(['id' => $row['id'],]);
                        }
                    }
                }
                return;
            }
        }
    }
    $loginAttempt = 0;
    $banned = 0;
    $query = "insert into banneduser (ipAddress, loginAttempt, banned) values (:ipAddress, :loginAttempt, :banned)";
    $stm = $con->prepare($query);
    $check = $stm->execute(['ipAddress' => $ip, 'banned' => $banned, 'loginAttempt' => $loginAttempt,]);
}

function get_ip()
{
    $ip = "";
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
