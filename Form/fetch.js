angular.module('FetchData', [])
    .controller('FetchDataCntrl', function ($scope, $http) {

        $scope.formatDate = function (date) {
            return moment(date).format('MM/DD/YYYY');
        };

        $scope.fetchData = function () {
            $http.get('fetch.php')
                .then(function (response) {
                    $scope.data = response.data;
                })
                .catch(function (error) {
                    console.error('Error fetching data:', error);
                });
        };

        $scope.dataDelete = function (Id) {
            if (confirm("Are you sure you want to delete this data?")) {
                $http.get('delete.php', {
                    params: { id: Id }
                })
                    .then(function (response) {
                        swal({
                            title: "Success",
                            text: "Data has been deleted Successfully!",
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        })
                        $scope.fetchData();
                    })
                    .catch(function (error) {
                        console.log('Error deleting data:', error);
                        swal('Error', 'An error occurred while deleting the data', 'error');
                    });
            }
        };
        $scope.fetchData();
    });
