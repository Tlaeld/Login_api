<?php

 
require 'conn.php';
header('Content-Type:text/html;charset=utf-8');

//过滤表
function lib_replace_end_tag($str) {
    if (empty($str)) return false;
    $str = htmlspecialchars($str);
    $str = str_replace('/', "", $str);
    $str = str_replace('"', "", $str);
    $str = str_replace('(', "", $str);
    $str = str_replace(')', "", $str);
    $str = str_replace('CR', "", $str);
    $str = str_replace('ASCII', "", $str);
    $str = str_replace('ASCII 0x0d', "", $str);
    $str = str_replace('LF', "", $str);
    $str = str_replace('ASCII 0x0a', "", $str);
    $str = str_replace(',', "", $str);
    $str = str_replace('%', "", $str);
    $str = str_replace(';', "", $str);
    $str = str_replace('eval', "", $str);
    $str = str_replace('open', "", $str);
    $str = str_replace('sysopen', "", $str);
    $str = str_replace('system', "", $str);
    $str = str_replace('$', "", $str);
    $str = str_replace("'", "", $str);
    $str = str_replace("'", "", $str);
    $str = str_replace('ASCII 0x08', "", $str);
    $str = str_replace('"', "", $str);
    $str = str_replace('"', "", $str);
    $str = str_replace("", "", $str);
    $str = str_replace("&gt", "", $str);
    $str = str_replace("&lt", "", $str);
    $str = str_replace("<SCRIPT>", "", $str);
    $str = str_replace("</SCRIPT>", "", $str);
    $str = str_replace("<script>", "", $str);
    $str = str_replace("</script>", "", $str);
    $str = str_replace("select", "", $str);
    $str = str_replace("join", "", $str);
    $str = str_replace("union", "", $str);
    $str = str_replace("where", "", $str);
    $str = str_replace("insert", "", $str);
    $str = str_replace("delete", "", $str);
    $str = str_replace("update", "", $str);
    $str = str_replace("like", "", $str);
    $str = str_replace("drop", "", $str);
    $str = str_replace("DROP", "", $str);
    $str = str_replace("sleep", "", $str);
    $str = str_replace("create", "", $str);
    $str = str_replace("modify", "", $str);
    $str = str_replace("rename", "", $str);
    $str = str_replace("alter", "", $str);
    $str = str_replace("cas", "", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace(">", "", $str);
    $str = str_replace("<", "", $str);
    $str = str_replace(" ", chr(32), $str);
    $str = str_replace(" ", chr(9), $str);
    $str = str_replace("    ", chr(9), $str);
    $str = str_replace("&", chr(34), $str);
    $str = str_replace("'", chr(39), $str);
    $str = str_replace("<br />", chr(13), $str);
    $str = str_replace("''", "'", $str);
    $str = str_replace("css", "'", $str);
    $str = str_replace("CSS", "'", $str);
    $str = str_replace("<!--", "", $str);
    $str = str_replace("convert", "", $str);
    $str = str_replace("md5", "", $str);
    $str = str_replace("passwd", "", $str);
    $str = str_replace("password", "", $str);
    $str = str_replace("../", "", $str);
    $str = str_replace("./", "", $str);
    $str = str_replace("Array", "", $str);
    $str = str_replace("or 1='1'", "", $str);
    $str = str_replace(";set|set&set;", "", $str);
    $str = str_replace("`set|set&set`", "", $str);
    $str = str_replace("--", "", $str);
    $str = str_replace("OR", "", $str);
    $str = str_replace('"', "", $str);
    $str = str_replace("*", "", $str);
    $str = str_replace("-", "", $str);
    $str = str_replace("+", "", $str);
    $str = str_replace("/", "", $str);
    $str = str_replace("=", "", $str);
    $str = str_replace("'/", "", $str);
    $str = str_replace("-- ", "", $str);
    $str = str_replace(" -- ", "", $str);
    $str = str_replace(" --", "", $str);
    $str = str_replace("(", "", $str);
    $str = str_replace(")", "", $str);
    $str = str_replace("{", "", $str);
    $str = str_replace("}", "", $str);
    $str = str_replace("-1", "", $str);
    $str = str_replace(".", "", $str);
    $str = str_replace("response", "", $str);
    $str = str_replace("write", "", $str);
    $str = str_replace("|", "", $str);
    $str = str_replace("`", "", $str);
    $str = str_replace(";", "", $str);
    $str = str_replace("etc", "", $str);
    $str = str_replace("root", "", $str);
    $str = str_replace("//", "", $str);
    $str = str_replace("!=", "", $str);
    $str = str_replace("$", "", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("&&", "", $str);
    $str = str_replace("==", "", $str);
    $str = str_replace("#", "", $str);
    $str = str_replace("@", "", $str);
    $str = str_replace("mailto:", "", $str);
    $str = str_replace("CHAR", "", $str);
    $str = str_replace("char", "", $str);
	return $str;	 
}



$action = $_GET['mode'];
switch ($action) {
 
    //查询用户信息，返回0或1，0表示不存在openid
    case "0";
        $openid = lib_replace_end_tag($_POST['openid']);
        $wechat_name = lib_replace_end_tag($_POST['wechat_name']);
        $sql = "select openid,wechat_name from `users` where openid='$openid'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        //row为空说明数据库中不存在该openID
        if ($row === NULL) {
            echo 0;
            break;
        } else {
            //如果当前微信号与数据库不匹配，说明用户变更了微信号，则在数据库中进行更新
            if ($row['wechat_name'] != $wechat_name && $wechat_name != NULL){
                $sql_update_wechat_name = "update `user`.`users` set `wechat_name` = '" . $wechat_name . "' where `openid` = '" . $openid . "'";
                mysqli_query($conn, $sql_update_wechat_name);
            }
            echo 1;
            break;
    }
    break;
 
    //插入sql   0-->密码错误  1-->插入成功
    case"1";

        $username = lib_replace_end_tag(trim($_POST['username']));
        $password2 = $_POST['password'];
        $openid = lib_replace_end_tag(trim($_POST['openid']));
        $wechat_name = lib_replace_end_tag($_POST['wechat_name']);
        //对密码进行md5加密
        $password = md5("$password2");
        $sqluser = "select username,password  from `users` where username='" . $username . "' and password='" . $password . "'";
        $queryuser = mysqli_query($conn, $sqluser);
        $rowuser = mysqli_fetch_array($queryuser);
        //确保获取数据正确，并且不为空
        if ($rowuser && is_array($rowuser) && !empty($rowuser)) {
            //密码和用户名都正确
            if ($rowuser['username'] == $username && $rowuser['password'] == $password) {
                //密码正确
                if ($rowuser['password'] == $password) {
                    //更新openid
                    $updatesql = "update `user`.`users` set `openid` = '" . $openid . "' where `username` = '" . $username . "'";
                    $query = mysqli_query($conn, $updatesql);
                    //更新WeChat_name 可能存在用户不允许获取
                    if ($wechat_name != NULL) {
                        $updatesql = "update `user`.`users` set `wechat_name`='" . $wechat_name . "' where `username` = '" . $username . "'";
                        $query = mysqli_query($conn, $updatesql);
                    }
                    echo 1;
                    exit();
                } else {
                    echo 0;
                    exit();
                }
            } else {
                echo 0;
                exit();
            }
        } else {
            echo 0;
            exit();
        }

    //pc登录  1-->登陆成功 管理员+token        0-->登录失败
    case"2";
        $username = lib_replace_end_tag($_POST['username']);
        $password2 = $_POST['password'];
        $password = md5("$password2" );
        $sqluser = "select username,password,Authority  from `users` where username='" . $username . "' and password='" . $password . "'";
        $queryuser = mysqli_query($conn, $sqluser);
        $rowuser = mysqli_fetch_array($queryuser);
        //确保获取数据正确，并且不为空
        if ($rowuser && is_array($rowuser) && !empty($rowuser)) {
            //密码和用户名有都正确
            if ($rowuser['username'] == $username && $rowuser['password'] == $password) {
                //密码正确
                if ($rowuser['password'] == $password) {
                    //判断是否为管理员
                    if($rowuser['Authority'] == "Y"){
                        //睡一秒，保证token不相同
                        sleep(1);
                        //生成token
                        $token = md5($username . $password2 . $password .  time());
                        //token有效期 7200s --> 2小时
                        $token_exp =  time() + 7200;
                        $insert_token = "INSERT INTO `user` . `users_token`(`user_token`, `expire_time` ) VALUES ( '" . $token . "', FROM_UNIXTIME('" . $token_exp . "'))";
                        mysqli_query($conn, $insert_token);
                        //构造json
                        $result = array(
                            'state' => '1',
                            'token' => $token
                        );
                        echo json_encode($result);
                        exit();
                    }
                    //如果不是管理员则不返回token
                    $result = array(
                        'state' => '1',
                    );
                    echo json_encode($result);
                    exit();
                } else {
                    $result = array(
                        'state' => '0',
                    );
                    echo json_encode($result);
                    exit();
                }
            } else {
                $result = array(
                    'state' => '0',
                );
                echo json_encode($result);
                exit();
            }
        } else {
            $result = array(
                'state' => '0',
            );
            echo json_encode($result);
            exit();
        }
        break;
    

    case "3";
        $token = lib_replace_end_tag($_POST['token']);
        $sql_token = "select user_token,expire_time from `users_token` where user_token='" . $token . "'";
        $queryuser = mysqli_query($conn, $sql_token);
        $operating = lib_replace_end_tag($_GET['operating']);
        $rowuser = mysqli_fetch_array($queryuser);
        //当存在token
        if ($rowuser > 0) {
            //当token过期，从表中清除token
            if (strtotime($rowuser['expire_time']) < time()) {
                $del_sql = "delete from `users_token` where `user_token` = '" . $token . "'";
                mysqli_query($conn, $del_sql);
            }
            //说明没过期
            else{
                //根据operating选择操作模式  1为查询所用用户信息，2为增加一个用户，3为删除一个用户，4为修改用户信息
                switch ($operating) {
                    //查询所用用户信息
                    case "1";
                        $query_sql = "select username,wechat_name,Authority from `users` ";
                        $resoure = mysqli_query($conn, $query_sql);
                        //$row = mysqli_fetch_array($resoure);
                        while ($row = mysqli_fetch_array($resoure, MYSQLI_BOTH)) {
                            $arr = array(
                                'username' => $row['username'],
                                'wechat_name' => $row['wechat_name'],
                                'Authority' => $row['Authority']
                            );
                            $data[]=$arr;
                        }
                        //把数据转换为JSON数据.
                        $json = json_encode($data);
                        echo "{" . '"users"' . ":" . $json . "}";
                        break;
                    //增加一个用户,成功返回1，失败返回-1
                    case "2";
                        $username = lib_replace_end_tag($_POST['username']);
                        $password2 = $_POST['password'];
                        $password =  md5("$password2");
                        $Authority = lib_replace_end_tag($_POST['Authority']);
                        if(!empty($username) && !empty($password2) && !empty($Authority) && ($Authority=="Y" || $Authority=="N" )){
                            $add_sql = "INSERT INTO `user`.`users`(`username`, `password`, `Authority`) VALUES ('" . $username . "', '" . $password . "', '" . $Authority . "')";
                            $result = mysqli_query($conn, $add_sql);
                            if (!$result) {
                                echo "{\"state\": '-1'}";
                                break;
                            }
                            echo "{\"state\": '1'}";
                        }
                        else{
                            echo "{\"state\": '-1'}";
                        }
                        break;

                    //删除一个用户,成功返回1，失败返回-1
                    case "3";
                        $username = lib_replace_end_tag($_POST['username']);
                        if (!empty($username)) {
                            $del_sql = "DELETE FROM `user`.`users` WHERE `username` = '" . $username . "'";
                            $result = mysqli_query($conn, $del_sql);
                            if (!$result) {
                                echo "{\"state\": '-1'}";
                            }
                            echo "{\"state\": '1'}";
                        }
                        else{
                            echo "{\"state\": '-1'}";
                        }
                        break;

                    //修改用户信息，成功返回1，失败返回-1
                    case "4";
                        $username = lib_replace_end_tag($_POST['username']);
                        $password2 = $_POST['password'];
                        $password =  md5("$password2");
                        $Authority = lib_replace_end_tag($_POST['Authority']);
                        if (!empty($username) && !empty($password2) && !empty($Authority) && ($Authority=="Y" || $Authority=="N" )) {
                            $update_sql = "UPDATE `user`.`users` SET `password` = '" . $password . "', `Authority` = '" . $Authority . "' WHERE `username` = '" . $username . "'";
                            $result = mysqli_query($conn,$update_sql);
                            if (!$result) {
                                echo "{\"state\": '-1'}";
                                break;
                            }
                            echo "{\"state\": '1'}";
                        }
                        else{
                            echo "{\"state\": '-1'}";
                        }
                        break;
                    default:
                        echo "{\"state\": '0'}";
                }
                    
            }
        }
        else{
            echo "{\"state\": '0'}";
        }
    default:
        exit();
    }
?>
