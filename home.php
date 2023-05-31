<?php
session_start();
// echo "こんにちは".$_SESSION["user_name"]."さん"; -->
?>

<!DOCTYPE html>
<html lang="ja">
<!-- 最初の設定は終わっています　必要な方は触ってください -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style2.css">
  <!-- <link rel="stylesheet" href="main.js"> -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
</head>

<body>

<div class="header" style="display:flex; align-items:center;">
    <div id="logo" style="width:25%;height:100%; display:flex; align-items:center;">
          <img style="width:15%;margin:5px;" class="logo_img" src="img/logo1.jpeg" alt="Flourimist">
          <div class="service_name" style="width:85%;margin-left:10px;font-size:300%;font-family: 'Chalkduster',sans-serif;">Flourimist</div>
    </div>
    <div id="nav" style="width:50%;display:flex;justify-content:space-around;align-items:center;">
            <button id="btn_all" class="btn_header" style="padding:0 3%;border-right: 2px solid #6eac8c;border-left: 2px solid #6eac8c;background:none;border-top:none;border-bottom:none;">
                全ユーザー
            </button>
            <button id="btn_follow" class="btn_header" style="padding:0 3%;border-right: 2px solid #6eac8c;border-left: 2px solid #6eac8c;background:none;border-top:none;border-bottom:none;">  
                フォロー中
            </button>
            <button id="btn_question" class="btn_header" style="padding:0 5%;border-right: 2px solid #6eac8c;border-left: 2px solid #6eac8c;background:none;border-top:none;border-bottom:none;">
                質問
            </button>
            <button id="btn_like" class="btn_header" style="padding:0 4%;border-right: 2px solid #6eac8c;border-left: 2px solid #6eac8c;background:none;border-top:none;border-bottom:none;">
                いいね 
            </button> 
    </div>
    <div style="width:25%;display:flex;justify-content:end;align-items:center;">
    <?php
    if($_SESSION["admin"]==1){
        ?>
        <div id="admin" style="width:80%;padding-left:50%;margin-top:1%;text-align:center;display:flex;flex-flow:column;">
            <a href="admin.php">
            <div>
            <img style="width:35%;"src="img/graph.png" alt="admin">
            </div>
            </a>
        <div>admin</div>
        </div>
        <div id="logout" style="width:20%;margin-right:8%;margin-top:1%;text-align:center;display:flex;flex-flow: column;">
        <a href="first.php">
        <div>
        <img style="width:55%;" src="img/logout1.png" alt="Flourimist">
    <?php  }else{ ?>
        <div id="logout" style="width:80%;margin-right:8%;text-align:right;display:flex;flex-flow: column;">
        <a href="first.php">
        <div>
        <img style="width:12%;" src="img/logout1.png" alt="Flourimist">
    <?php }
        ?>
        </div>
        </a>
        <div>Logout</div>
        </div>
    </div>
</div>
<!-- /.header -->

<div class="content">
    <div class="page" id="user_page">
        <div id="user_prof" style="display:flex;justify-content:center;">
            <div id="user_prof_img" style="width:30%;margin:5%;align-items:center;">
                <img src="./img/<?=$_SESSION["fname"]?>" alt="プロフィール画像" style="padding-top:5px;width:110px;height:110px;border-radius:50%; object-fit: cover;">
            </div>
            <div style='width:70%;margin:0% 0% 1% 3%;'>
            <div style='text-align:right;margin-bottom:15%;'>
            <button id='setting'style='width:15%;border:none;'><img style='width:100%;' src="img/set.png" alt="setting"></button>
            </div>
            <div style="margin-left:1%;font-size:85%;"><?="ID: ".$_SESSION["user_id"]."<br> Name: ".$_SESSION["name"]?></div>
            </div>
        </div>
        <div id="bio" style='margin:0% auto 10%;width: 80%;height: auto;border: 2px solid #79BD9A;'>
            <div style='padding:3%'><?=$_SESSION['bio']?></div>
        </div>
        <div id="user_post">
            <form action="post.php" method="post">
                <input type="text" name="title" placeholder="タイトル(10字以内)" maxlength="10" style='width:80%;padding-left:10px;margin-bottom:5px;'>
                <textarea name="body" placeholder="内容(140字以内)" maxlength="140" style='width:80%;height:200px;padding:0 10px;'></textarea><br>
                <button class="btn btn-outline-success" type="submit">投稿</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
                    $("#setting").on('click', function() {
                        let edit_user_id = prompt("新しいIDを入力してください", "<?= $_SESSION["user_id"] ?>");
                        let edit_user_name = prompt("内容を入力してください", "<?= $_SESSION["name"] ?>");
                        let bio = prompt("bioを入力してください", "例: G's ACADEMY Tokyo LAB15/JS選手権優勝/三度の飯よりG's");
                        if (edit_user_id != null && edit_user_name != null) {
                            $.ajax({
                                url: "edit_profile.php",
                                type: "POST",
                                data: {
                                    id: <?=$_SESSION["user_id_id"]?>,
                                    edit_user_id: edit_user_id,
                                    edit_user_name: edit_user_name,
                                    bio: bio
                                    // updated timeの追加
                                },
                                success: function(response) {
                                    // 更新成功時の処理
                                    alert("投稿が更新されました。再度ログインしてください。");
                                    location = 'first.php';
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    });
                });    


    </script>
    <div class="page" id="timeline">
        <?php
            try{
                $pdo = new PDO('mysql:dbname=gs_db_525; charset=utf8;host=localhost', 'root','');
            } catch(PDOException $e){
                exit('DbConnectError:'.$e->getMessage());
            }

            $stmt = $pdo->prepare("SELECT * FROM articles ORDER BY created_at DESC");
            $status = $stmt->execute();

            $view = "";
            if($status == false){
                $error = $stmt->errorInfo();
                exit("ErrorQuery:".$error[2]);
            }else{
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $view .= "<div style='font-size:20px; display:flex; justify-content:space-between; align-items: center;'>";
                    $view .= "<div style='width:20%; margin-left:20px;font-size:80%;margin-bottom:5px;'><img src='./img/".$result["prof_img_name"]."' style='padding:5px;width:110px;height:110px;border-radius:50%; object-fit: cover;'><br>";
                    if($_SESSION["user_id_id"]!=$result["user_id_id"]){
                        $view .= "<form id='for' action='user_profile.php' method='post'>";
                        $view .= "<input id='ui' type='text' name='user_id_id' style='display: none;' value='".$result['user_id_id']."'>";
                        $view .= "<button id='user_profile' style='border:none;outline: none;background: transparent;'>".$result["name"]."</button></form></div>";
                    }else{
                        $view .= $result["name"]."</div>";
                    }
                    $view .= "<div style='width:56%; padding:20px;'><h5 style='font-weight:bold;'>タイトル：【";
                    $view .= $result["title"]."】</h5>".$result["body"]."</div><br><br><div style='width:24%;margin-top:5px;'>";
                    if($_SESSION["user_id_id"]==$result["user_id_id"]){
                    $view .= "<button id='update".$result["id"]."'class='btn btn-outline-success' style='font-size:15px;margin-right:2.5px;width:40%;'>編集</button>";
                    $view .= "<button id='delete".$result["id"]."'class='btn btn-outline-success' style='font-size:15px;margin-left:2.5px;width:40%;'>削除</button>";
                    }
                    $view .= "<div id='post_time' style='padding:10px;font-size:14px;'>";
                    if(($result["created_at"]!=$result["updated_at"]) && ($result["updated_at"]!= NULL)){
                        $view .= "Updated at<br>".$result["updated_at"];
                    }else{
                    $view .= $result["created_at"];
                    }
                    $view .= "</div><button id='article".$result["id"]."'class='btn btn-outline-success' style='width:82%;font-size:15px;margin-bottom:5px;'>コメント</button>";
                    $view .= "</div></div>";?>
                    <div class="post">
                        <?=$view?>
                    </div>
            <script>

                $(document).ready(function() {
                    $("#article<?= $result['id'] ?>").on('click', function() {
                        $("#res").html("<?php
                            $com = "";
                            $com .= "<div style='font-size:15px; display:flex; align-items:center;margin:0 2%;border-bottom:1px solid #79BD9A;'>";
                            $com .= "<div style='width:38%; margin-left:5px;font-size:80%;margin-bottom:5px;'><img src='./img/".$result["prof_img_name"]."' style='padding:5px;width:90px;height:90px;border-radius:50%; object-fit: cover;'><br>";
                            $com .= $result["name"]."</div><div style='width:62%;padding-right:2%;'><p style='font-weight:bold;'>タイトル：【";
                            $com .= $result["title"]."】</p>".$result["body"]."</div><br><br></div>";
                            echo $com;
                        ?>");
                        $("#form").css('visibility', 'visible');
                        $("#ai").val("<?= $result['id'] ?>");
                        $("#commenthtml").css('visibility', 'visible');
                        $.ajax({
                            url: "fetch_comments.php", // コメントデータを取得するPHPファイルのパス
                            type: "GET",
                            data: {
                                article_id: <?= $result['id'] ?>, // 記事のIDをパラメータとして渡す
                                impression: <?= $result['impression'] ?>
                            },
                            success: function(response) {
                                $("#commentpage").html(response);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });
                $(document).ready(function() {
                    $("#update<?= $result['id'] ?>").on('click', function() {
                        let title = prompt("タイトルを入力してください", "<?= $result['title'] ?>");
                        let body = prompt("内容を入力してください", "<?= $result['body'] ?>");
                        if (title != null && body != null) {
                            $.ajax({
                                url: "edit.php",
                                type: "POST",
                                data: {
                                    id: <?= $result['id'] ?>,
                                    title: title,
                                    body: body
                                    // updated timeの追加
                                },
                                success: function(response) {
                                    // 更新成功時の処理
                                    alert("投稿が更新されました");
                                    location.reload(); // ページをリロードして更新を反映
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    });
                });

                $(document).ready(function() {
                    $('#delete<?= $result['id'] ?>').click(function() {
                        // 確認ダイアログを表示
                        if (confirm('この投稿を削除しますか？')) {
                            // AJAXリクエストを送信して投稿を削除
                            $.ajax({
                                url: 'delete.php',
                                type: 'POST',
                                data: { postId: <?= $result['id']?> },
                                success: function(response) {
                                    // 成功時の処理
                                    location.reload(); // ページをリロードして更新を反映
                                },
                                error: function(xhr, status, error) {
                                    // エラー時の処理
                                    console.log(error);
                                }
                            });
                        }
                    });
                });

                // 悔しい！
                // $("< ?="#article".$result["id"]?>").on('click',function(){
                //     $("#res").html("<?php
                //         $com = "";
                //         $com .= "<div style='font-size:15px; display:flex; align-items:center;margin:0 10px;border-bottom:1px solid #79BD9A;'>";
                //         $com .= "<div style='width:38%; margin-left:5px;font-size:15px;margin-bottom:5px;'><img src='./img/".$result["prof_img_name"]."' style='padding:5px;width:90px;height:90px;border-radius:50%; object-fit: cover;'><br>";
                //         $com .= $result["name"]."</div><div style='width:62%;padding-right:20px;'><p style='font-weight:bold;'>タイトル：【";
                //         $com .= $result["title"]."】</p>".$result["body"]."</div><br><br></div>";
                //         echo $com;
                //         ?>");
                    // $("#form").css('visibility', 'visible');
                    // $("#ai").val("< ?=$result['id']?>"); 
                    // $("#commenthtml").css('visibility', 'visible');
                    <?php
                        // try{
                        //     $pdo = new PDO('mysql:dbname=gs_db_525; charset=utf8;host=localhost', 'root','');
                        // } catch(PDOException $e){
                        //     exit('DbConnectError:'.$e->getMessage());
                        // }
                        // $n = "";
                        // $n = $result["id"];
                        // $stm = $pdo->prepare("SELECT * FROM comment WHERE article_id = $n");
                        // $statu = $stm->execute();

                        // if($statu == false){
                        //     $error = $stm->errorInfo();
                        //     exit("ErrorQuery:".$error[2]);
                        // }else{
                        //     $commentHtml = ''; // コメントのHTMLを格納する変数を初期化
                        //     while($resul = $stm->fetch(PDO::FETCH_ASSOC)){
                                // $comm = "";
                                // $comm .= "<div style='font-size:15px; display:flex; align-items:center;margin:0 10px;border-bottom:1px solid #79BD9A;'>";
                                // $comm .= "<div style='width:38%; margin-left:5px;font-size:15px;margin-bottom:5px;'><img src='./img/".$resul["prof_img_name"]."' style='padding:5px;width:90px;height:90px;border-radius:50%; object-fit: cover;'><br>";
                                // $comm .= $resul["name"]."</div><div style='width:62%; padding-right:20px;'><div>";
                                // $comm .= $resul["comment"]."</div><br><div style='padding:10px;'>";
                                // $comm .= $resul["created_at"]."</div></div></div>";
                                // $commentHtml .= $comm;
                                // if (!empty($commentHtml)) { ?>
                                    // $('#commentpage').html("< ?=$commentHtml?>");
                                <?php
                                //  } 
                        //     }
                        // }
                    ?>
// ifでそれ以外の時は空を表示のコードを書く
                // })
            </script>
            <?php 
            $view = "";
            }
        }
            ?>
    </div>
    <div class="page" id="tag">
        <div id="res">
        </div>
        <div id="commenthtml" style="text-align:center;visibility: hidden;margin:0 1%;border-bottom:1px solid #79BD9A;">コメント</div>
        <div id="commentpage" style='height:60%;overflow: auto;'>
        </div>
        <div id="comment" style='height: 20%;'>
            <form id="form" style="visibility: hidden;" action="comment.php" method="post">
                <input id="ai" type="text" name="article_id" placeholder="自動で入力されます" style="visibility: hidden;">
                <textarea name="comment" placeholder="コメント" style='width:80%;height:100%;padding: 0 10px;margin:1%;'></textarea><br>
                <button class="btn btn-outline-success" type="submit">送信</button>
            </form>
        </div>
    </div>
</div>

<!-- /.content -->

      <div class="footer">
        <p>copyrights 2023 まるしぃ Tokyo All RIghts Reserved.</p>
      </div>
    <!-- /#footer -->

</body>

</html>