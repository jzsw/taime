<?php
//taime核心库
class Taime{
    const host = "localhost";
    const dbname = "db";
    const username = "db";
    const password = "db123456";
    
    public $mysqli;

    function __construct(){
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $this -> mysqli = new mysqli($this::host, $this::username, $this::password, $this::dbname);
        if ($this->mysqli->connect_error) {
            die("数据库连接出错: " . $this->mysqli->connect_error);
        }

    }

    function __destruct(){
        
    }

    //规范化输出
    function output($data){
        echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    //获取数据库列表
    function generateList(){
        $sql = "SELECT * FROM `taime` WHERE 1";
        $result= $this->mysqli->query($sql);
        $lists=[];
        //查询数据库操作
        while($row = $result->fetch_assoc()) {
            $lists[]=[
                "id" => $row["id"],
                "title" => $row["title"],
                "author" => $row["author"],
                "album" => $row["album"]
            ];
        }
        return $lists;

    }

    //获取指定id的歌曲信息
    function getMusicById($id){
        $sql = "SELECT * FROM `taime` WHERE `id` = ".(int)$id;
        $result= $this->mysqli->query($sql);
        $lists=[];
        //查询数据库操作
        while($row = $result->fetch_assoc()) {
            $lists[]=[
                "id" => $row["id"],
                "title" => $row["title"],
                "author" => $row["author"],
                "album" => $row["album"]
            ];
        }
        return $lists;
    }

    //获取指定作者的所有歌曲
    function getMusicByAuthor($author){
        $sql = "SELECT * FROM taime WHERE author = '" . mysqli_real_escape_string($this->mysqli, $author) . "'";
        $result= $this->mysqli->query($sql);
        $lists=[];
        //查询数据库操作
        while($row = $result->fetch_assoc()) {
            $lists[]=[
                "id" => $row["id"],
                "title" => $row["title"],
                "author" => $row["author"],
                "album" => $row["album"]
            ];
        }
        return $lists;
    }

    //获取指定专辑的所有歌曲
    function getMusicByAlbum($album){
        $sql = "SELECT * FROM taime WHERE album = '" . mysqli_real_escape_string($this->mysqli, $album) . "'";
        $result= $this->mysqli->query($sql);
        $lists=[];
        //查询数据库操作
        while($row = $result->fetch_assoc()) {
            $lists[]=[
                "id" => $row["id"],
                "title" => $row["title"],
                "author" => $row["author"],
                "album" => $row["album"]
            ];
        }
        return $lists;
    }

    //搜索歌曲
    function serachMusic($key){
        $key = mysqli_real_escape_string($this->mysqli, $key);
        $sql = "SELECT * FROM taime WHERE title LIKE '%$key%' OR author LIKE '%$key%' OR album LIKE '%$key%'";
        $result= $this->mysqli->query($sql);
        $lists = [];
        //查询数据库操作
        while($row = $result->fetch_assoc()) {
            $lists[]=[
                "id" => $row["id"],
                "title" => $row["title"],
                "author" => $row["author"],
                "album" => $row["album"]
            ];
        }
        return $lists;
    }
    
    function addMusic($title,$author,$album = NULL){
        if($album==NULL){
            $sql = "INSERT INTO `taime` (`title`, `author`) VALUES ('$title', '$author')";
        } else {
            $sql = "INSERT INTO `taime` (`title`, `author`, `album`) VALUES ('$title', '$author', '$album')";
        }

        return $this->mysqli->query($sql) === TRUE;
    }


}    

