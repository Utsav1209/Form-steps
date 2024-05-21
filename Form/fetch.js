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
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: ["Cancel", "Delete"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
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
                    } else {
                        swal("Your data is safe!");
                    }
                });
        };

        $scope.fetchData();
    });
