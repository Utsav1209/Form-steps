<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="fetch.js"></script>
</head>

<body>
    <div class="container-fluid" style="margin: 10px 10px;" ng-app="FetchData" ng-controller="FetchDataCntrl">
        <!-- {{data}} -->
        <!-- <div >
            {{item}}
        </div> -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Company Type</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in data track by item.id">
                    <td>{{item.name}}</td>
                    <td>{{item.cname}}</td>
                    <td>{{item.ctype}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>