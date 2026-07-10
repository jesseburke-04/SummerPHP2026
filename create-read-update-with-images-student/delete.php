<?php
    require_once 'includes/database.php';
    require_once 'includes/user.php';
    $db = (new Database())->connect();
    $user = new User($db);
    $id = $_GET['id'] ?? null;
    if($id){
        $u = $user->getById($id);
        if($u){
            // clean out the file system trace assets prior to removing DB rows.
            if(!empty($u['image']) && file_exists("uploads/" . $u['image'])){
                unlink("uploads/" . $u['image']);
            }
            $user->delete($id);
        }
    }
    header("Location: index.php");
    exit;
?>