<?php include_once("bd.php"); ?>
<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>
        <script type="text/javascript" src="template.js"></script>
        <script type="text/javascript">
            var app = angular.module('myApp', []);
                app.controller('customersCtrl', function($scope, $http) {
                    //posti vivodit
                    $http.get("customers.php").then(function(response) {
                        $scope.myData = response.data.records;   
                    });
                    
                    /*$scope.showData = function( ){
                        var pagesShown = 1;
                        var pageSize = 3;
                        
                        $scope.paginationLimit = function(data) {
                            return pageSize * pagesShown;
                        };
                        $scope.hasMoreItemsToShow = function() {
                            return pagesShown < ($scope.myData.length / pageSize);
                        };
                        $scope.showMoreItems = function() {
                            pagesShown = pagesShown + 1;       
                        };
                    }*/

                    //PopUP
                    console.log("angular rabotaet!");
                    $scope.create=function(){
                        $scope.overlay={'display':'block', 'position':'fixed'};
                        $scope.autform={'top':'200px','left':'500px','transition':'1s','display':'block', 'position':'fixed'};
                    }
                    $scope.hideIt=function(){
                        $scope.overlay={'display':'none'};
                        $scope.autform={'top':'-1000','display':'none'};
                    }

                    //dobavit post
                    $scope.todoList = [{todoTitle:'Зимний лес', todoParagraph:'снег, природа, скала, дерево', done:false}];
                    $scope.todoAdd = function() {
                        $scope.todoList.push({todoTitle:$scope.todoInput, todoParagraph:$scope.todoTextarea, done:false});
                        $scope.todoInput = "";
                        $scope.todoTextarea = "";
                    };

                    $scope.remove = function() {
                        var oldList = $scope.todoList;
                        $scope.todoList = [];
                        angular.forEach(oldList, function(x) {
                            if (!x.done) $scope.todoList.push(x);
                        });
                    };
                });

                //poisk
                    function search(key) {
    
                        var request = new XMLHttpRequest();
                        var url = "http://localhost/final16122016/find.php";
                        
                        request.onreadystatechange = function() {   
                            if (request.readyState == 4 && request.status == 200) {
                                
                                document.getElementById("result").innerHTML = request.responseText;
                            
                            }
                        }
                        
                        request.open("GET", url + "?key=" + key, true)
                        request.send();

                    }
        </script>
        <style type="text/css">
            .overlay{
                width:100%;
                height:100%;
                background-color: black;
                opacity:0.5;
                position: fixed;
                top:0;
                z-index:6;
                display: none;
            }
            .autorizationform{
                z-index:10;
                position: fixed;
                display: none;
            }

            #result {
                list-style: none;
                margin: 0;
                padding: 0;
                width: 320px;
            }
            #result li {
                border: 1px solid #ccc;
                border-top: none;
                padding: 3px 5px;
            }

        </style>
    </head><body ng-app="myApp" ng-controller="customersCtrl">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>САЙТ</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="#">Публикации</a>
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
                    <div class="col-md-8">

                        <div ng-repeat="x in todoList">    
                            <div class="col-md-12" ng-init="showData()">
                                <ul>
                                    <li  style="list-style: none;">
                                        <h2 class="text-muted"><a href="comments.php"><span ng-bind="x.todoTitle"></span></a></h2>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-primary">
                                                    <a href="comments.php"><i class="fa fa-comment fa-fw"></i>152</a>
                                                    <a href="#"><i class="fa fa-fw fa-user"></i>kyelzhan</a>
                                                    <span>1 час назад</span>
                                                    <input type="checkbox" ng-model="x.done">
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                
                                            </div>
                                        </div>
                                        <div class="well">
                                            <img src="images/5.png?w=1024&amp;q=50&amp;fm=jpg&amp;s=5e57c661d0f772ce269188a6f5325708" class="img-responsive">
                                            <p><span ng-bind="x.todoParagraph"></span></p>
                                        </div>
                                        <p><button class="btn btn-danger" ng-click="remove()">Удалить</button></p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        
                        <div class="col-md-12" ng-init="showData()">
                            <ul>
                                <li ng-repeat="x in myData | limitTo: paginationLimit()" style="list-style: none;">
                                    <h2 class="text-muted"><a href="comments.php">{{ x.Title }}</a></h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-primary">
                                                <a href="comments.php"><i class="fa fa-comment fa-fw"></i>152</a>
                                                <a href="#"><i class="fa fa-fw fa-user"></i>{{ x.User }}</a>
                                                <span>1 час назад</span>
                                            </p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <p class="text-info"></p>
                                        </div>
                                    </div>
                                    <div class="well">
                                        <img src="images/{{ x.Image }}.png?w=1024&amp;q=50&amp;fm=jpg&amp;s=5e57c661d0f772ce269188a6f5325708" class="img-responsive">
                                        <p>{{ x.Content }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
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
    <div>
        <div class="well">
            <p>Привет, <strong>$login</strong> | <a href='exit.php'>Выход</a><br></p>
        </div>
        <a class="btn btn-block btn-lg btn-primary" ng-click="create()"><i class="fa fa-fw fa-plus"></i>Добавить пост</a>
    </div><br>
HERE;
}
?>
                        
                        <div class="well">
                            <form>
                                <div class="form-group">
                                    <label>Поиск</label>
                                    <input type="text" size="20" name="name" class="form-control" onkeyup="search(this.value)">
                                    <ul id="result">
                                </ul>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" ng-style="overlay" ng-click="hideIt()"></div>
        <div class="well autorizationform" ng-style="autform">
            
                <h2>Добавить пост</h2>
                <form ng-submit="todoAdd()">
                    <div class="form-group">
                        <label>Заголовок:</label>
                        <input type="text" ng-model="todoInput" class="form-control" required>
                        <label>Контент:</label>
                        <textarea ng-model="todoTextarea" class="form-control" rows="5" cols="50" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-default" value="Опубликовать">
              </form>
            
        </div>
                
        <div class="section">
            <div class="container">
                <div class="col-md-12">
                    <a class="btn btn-block btn-lg btn-primary" ng-click="showMoreItems()"><i class="fa fa-fw fa-plus"></i>Load More!</a>
                </div>
            </div>
        </div>
    

</body></html>