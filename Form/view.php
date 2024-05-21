<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>

<body>
    <div class="container-fluid" style="margin: 10px 10px;" ng-app="FetchData" ng-controller="FetchDataCntrl">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Company Type</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Contract Type</th>
                    <th>Contract Email</th>
                    <th>Contract</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Billing Method</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="text-align:center;">
                <tr ng-repeat="item in data">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.cname }}</td>
                    <td>{{ item.ctype }}</td>
                    <td>{{ item.phone }}</td>
                    <td>{{ item.pri_country }}</td>
                    <td>{{ item.contact_type }}</td>
                    <td>{{ item.contact_email }}</td>
                    <td>{{ item.contract }}</td>
                    <td>{{ formatDate(item.start_date) }}</td>
                    <td>{{ formatDate(item.end_date) }}</td>
                    <td>{{ item.billing_method }}</td>
                    <td>
                        <button class="btn btn-danger" ng-click="dataDelete(item.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="fetch.js"></script>
</body>

</html>