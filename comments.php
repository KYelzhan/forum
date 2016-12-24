<?php include_once("bd.php"); ?>
<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>
        <script src="template.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#send").click(function(){
                    var author = $("#author").val();
                    var message = $("#message").val();
                    $.ajax({
                        type: "POST",
                        url: "sendMessage.php",
                        data: {"author": author, "message": message},
                        cache: false,                       
                        success: function(response){
                            var messageResp = new Array('Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения');
                            var resultStat = messageResp[Number(response)];
                            if(response == 0){
                                $("#author").val("");
                                $("#message").val("");
                                $("#commentBlock").append("<div class='well'><div class='media'><div class='media-body'><h4 class='media-heading'>"+author+"</h4><br>"+message+"</div></div></div>");
                            }
                            $("#resp").text(resultStat).show().delay(1500).fadeOut(800);
                            
                        }
                    });
                    return false;
                            
                });
            });
        </script>
    </head><body ng-app="myApp">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span>САЙТ</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.php">Публикации</a>
                        </li>
                        <li class="active">
                            <a href="#">Комментарии</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="section">
            <div class="container">
                <div class="row">
                    <!--Пост-->
                    <div class="col-md-8">
                        <div class="col-md-12">
                            <h2 class="text-muted"><a href="#">Heading</a></h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-primary">
                                        <a href="#"><i class="fa fa-comment fa-fw"></i>152</a>
                                        <a href="#"><i class="fa fa-fw fa-user"></i>kyelzhan</a>
                                        <span>1 час назад</span>
                                    </p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="text-info"></p>
                                </div>
                            </div>
                            <div class="well">
                                <img src="images/1.png?w=1024&amp;q=50&amp;fm=jpg&amp;s=5e57c661d0f772ce269188a6f5325708" class="img-responsive">
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus
                                    ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                                    sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed
                                    odio dui.</p>
                            </div>
                        </div>
                    </div>
                    <!--Регистрация и Авторизация-->
                    <div class="col-md-4">

<?php
if(empty($login) and empty($password)){
print <<<HERE
    <div class="well">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Авторизация</a>
            </li>
            <li role="presentation">
                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Регистрация</a>
            </li>
        </ul>
        <br>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="Логин" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                    </div>
                    <input type="submit" value="Войти" name="submit" class="btn btn-default">
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <form action="verification.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Логин</label>
                        <input type="text" size="20" name="login" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" size="20" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" size="20" maxlength="20" name="password"" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Подтверждения пароля</label>
                        <input type="password" size="20" maxlength="20" name="password2" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Имя</label>
                        <input type="text" size="20" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Фамилия</label>
                        <input type="text" size="20" name="lastname" class="form-control" required>
                    </div>
                    <input type="submit" value="Зарегистроваться" name="submit" class="btn btn-block btn-primary">
                </form>
            </div>
        </div>
    </div>
HERE;
}
else{
print <<<HERE
    <div class="well">
        <p>Привет, <strong>$login</strong> | <a href='exit.php'>Выход</a><br>Контент для зарегистрированных пользователей</p>
    </div>
    <a class="btn btn-block btn-lg btn-primary"><i class="fa fa-fw fa-plus"></i>Добавить пост</a>
HERE;
}
?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
          <div class="container">
            <div class="row">
               <!--Форма Комментарий--> 
              <div class="col-md-8">
                <div class="well">
                    <form action="sendMessage.php" method="post" name="form">
                        <div class="form-group">
                            <input name="author" type="text" id="author" class="form-control" placeholder="Автор" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" cols="50" id="message" placeholder="Текст сообщения" required></textarea>
                        </div>
                        <input name="button" type="submit" value="Отправить" id="send" class="btn btn-block btn-primary">
                        <span id="resp"></span>
                    </form>
                </div>
                <!--Комментарии-->
                <div id="commentBlock">
                <?php
                    $result = mysql_query("SELECT * FROM messages",$con);
                    $comment = mysql_fetch_array($result);
                    do{
                    echo "<div class='well'>
                            <div class='media'>
                                <div class='media-body' ng-app='timeApp' ng-controller='mainController as main'>
                                    <h4 class='media-heading'>".$comment['author']."</h4>
                                    <br><pre>".$comment['message']."</pre>
                                </div>
                            </div>
                        </div>";
                    }while($comment = mysql_fetch_array($result));
                ?>
                </div>
              </div>
              <div class="col-md-4"></div>
            </div>
          </div>
        </div>

</body></html>