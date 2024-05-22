angular.module('FetchData', [])
    .controller('FetchDataCntrl', function ($scope, $http) {

        // Fetch Data In Edit Form
        $scope.formData = {};
        $scope.dataEdit = function (id) {
            $http.get('fetchEdit.php?id=' + id)
                .then(function (response) {
                    console.log(id)
                    $scope.formData = response.data;
                    if ($scope.formData && $scope.formData.pri_zip !== null && !isNaN($scope.formData.pri_zip)) {
                        $scope.formData.pri_zip = parseInt($scope.formData.pri_zip); 
                    }
                    if ($scope.formData && $scope.formData.secondary_zip !== null && !isNaN($scope.formData.secondary_zip)) {
                        $scope.formData.secondary_zip = parseInt($scope.formData.secondary_zip);
                    }
                    if ($scope.formData && $scope.formData.billing_zip !== null && !isNaN($scope.formData.billing_zip)) {
                        $scope.formData.billing_zip = parseInt($scope.formData.billing_zip);
                    }

                    if ($scope.formData && $scope.formData.start_date) {
                        $scope.formData.start_date = new Date($scope.formData.start_date);
                    }
                    if ($scope.formData && $scope.formData.end_date) {
                        $scope.formData.end_date = new Date($scope.formData.end_date);
                    }
                    console.log("response", $scope.formData)
                    $('#editModal').modal('show');
                }, function (error) {
                    console.error('Error fetching data:', error);
                });
        };

        // Save Edited Data
        $scope.formData = {};
        $scope.saveEdit = function () {
            $scope.newValue = {
                ...$scope.formData,
                update: true,
            }
            $http.post('editForm.php', $scope.newValue)
                .then(function (response) {
                    console.log(response.data);
                    $scope.formData = response.data
                    $('#editModal').modal('hide');
                    showAlert();
                }, function (error) {
                    console.error('Error saving data:', error);
                });
                $scope.fetchData();
        };

        // Sweet Alert Pop-up
        function showAlert() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Updated successfully',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
                position: 'top-end',
                toast: true,
                customClass: {
                    popup: 'swal2-rectangle'
                }
            });
        }

        // Date Format
        $scope.$watch('formData.start_date', function(newVal) {
            if (newVal) {
                $scope.formattedStartDate = moment(newVal).format('MM/DD/YYYY');
            } else {
                $scope.formattedStartDate = '';
            }
        });

        $scope.$watch('formData.end_date', function(newVal) {
            if (newVal) {
                $scope.formattedEndDate = moment(newVal).format('MM/DD/YYYY');
            } else {
                $scope.formattedEndDate = '';
            }
        });

        // Hover on Country
        $scope.highlightCountry = function (event) {
            event.target.style.backgroundColor = 'lightblue';
        };

        $scope.removeHighlight = function (event) {
            event.target.style.backgroundColor = 'white';
        };

        // List of Countries
        $scope.countryList = [];
        $http.get('https://restcountries.com/v3.1/all')
            .then(function (response) {
                var countries = response.data;
                var countryNames = countries.map(function (country) {
                    return country.name.common;
                });

                $scope.countryList = countryNames;
                // console.log("country", $scope.countryList)
            })
            .catch(function (error) {
                console.error('Error fetching country data:', error);
            });


        $scope.filteredCountries = [];
        $scope.filteredSecCountries = [];
        $scope.filteredPriCountries = [];

        //Billing Country
        $scope.filterCountries = function () {
            console.log("Filtering countries...");
            $scope.filteredCountries = $scope.countryList.filter(function (country) {
                return country.toLowerCase().indexOf($scope.formData.billing_country.toLowerCase()) !== -1;
            });
            console.log("Filtered countries:", $scope.filteredCountries);
        };

        $scope.selectCountry = function (country) {
            console.log("Selected country:", country);
            $scope.formData.billing_country = country;
            $scope.filteredCountries = [];
            $scope.resetErrorMessageBill();
        };

        $scope.resetErrorMessageBill = function () {
            $scope.errorMessage3 = '';
        };

        $scope.BillCountryExists = function () {
            return $scope.countryList.includes($scope.formData.billing_country);
        };

        // Secondary Country
        $scope.filterSecCountries = function () {
            console.log("Filtering countries...");
            $scope.filteredSecCountries = $scope.countryList.filter(function (country) {
                return country.toLowerCase().indexOf($scope.formData.secondary_country.toLowerCase()) !== -1;
            });
            console.log("Filtered Secondary countries:", $scope.filteredSecCountries);
        };

        $scope.selectSecCountry = function (country) {
            console.log("Selected country:", country);
            $scope.formData.secondary_country = country;
            $scope.filteredSecCountries = [];
            $scope.resetErrorMessageSec();
        };

        $scope.resetErrorMessageSec = function () {
            $scope.errorMessage2 = '';
        };

        $scope.SecCountryExists = function () {
            return $scope.countryList.includes($scope.formData.secondary_country);
        };

        // Primary Country
        $scope.filterPriCountries = function () {
            console.log("Filtering countries...");
            $scope.filteredPriCountries = $scope.countryList.filter(function (country) {
                return country.toLowerCase().indexOf($scope.formData.pri_country.toLowerCase()) !== -1;
            });
            console.log("Filtered Primary countries:", $scope.filteredPriCountries);
        };

        $scope.selectPriCountry = function (country) {
            console.log("Selected country:", country);
            $scope.formData.pri_country = country;
            $scope.filteredPriCountries = [];
            $scope.resetErrorMessagePri();
        };

        $scope.resetErrorMessagePri = function () {
            $scope.errorMessage1 = '';
        };

        $scope.PriCountryExists = function () {
            return $scope.countryList.includes($scope.formData.pri_country);
        };

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

        $scope.rows = [];

        $scope.addRow = function () {
            var id = $scope.rows.length + 1;
            $scope.rows.push({ 'id': 'dynamic' + id });
        };

        // Remove dynamic address fields
        $scope.removeRow = function (row) {
            var index = $scope.rows.indexOf(row);
            $scope.rows.splice(index, 1);
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
