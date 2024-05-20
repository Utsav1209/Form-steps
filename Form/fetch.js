angular.module('FetchData', [])
    .controller('FetchDataCntrl', function ($scope, $http) {

        $scope.fetchData = function () {
            $http.get('fetch.php')
                .then(function (response) {
                    $scope.data = response.data;
                    console.log("Response Data:", response.data);
                })
                .catch(function (error) {
                    console.error('Error fetching data:', error);
                });
        };
        $scope.fetchData();
    });
