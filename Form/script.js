angular.module('RegForm', [])
    .controller('RegCntrl', function ($scope, $http, $filter) {

        $scope.countryList = [
            "United States",
            "Canada",
            "United Kingdom",
            "Australia",
            "Germany",
            "France",
            "Italy",
            "Spain",
            "Japan",
            "China",
            "India",
            "Brazil",
            "Mexico",
            "Russia",
            "South Africa",
            "Argentina",
            "Saudi Arabia",
            "South Korea",
            "Indonesia",
            "Turkey"
        ];

        $scope.filteredCountries = [];
        $scope.filteredSecCountries = [];
        $scope.filteredPriCountries = [];


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
        };

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
        };

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
        };


        $scope.currentStep = 1;
        $scope.formData = {};
        $scope.newValue = {};
        $scope.saveStep = function (step) {
            $scope.currentStep = step + 1;
        };

        // $scope.formatDate = function (date) {
        //     return moment(date).format('MM/dd/yyyy');
        // };

        $scope.submitForm = function () {

            $scope.newValue = {
                ...$scope.formData,
                final_submit: true,

            }
            console.log("newValue", $scope.newValue);
            $http.post('formSubmit.php', $scope.newValue)
                .then(function (response) {
                    console.log("Form Response", response);
                    console.log('Form submitted successfully');
                    $scope.formData = {};
                    $scope.currentStep = 1;
                    $scope.formDisabled = false;
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Form submitted successfully'
                    });
                }, function (error) {
                    console.error('Error submitting form:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to submit form'
                    });
                });
        };

        $scope.rows = [];

        $scope.addRow = function () {
            var id = $scope.rows.length + 1;
            $scope.rows.push({ 'id': 'dynamic' + id });
        };

        $scope.removeRow = function (row) {
            var index = $scope.rows.indexOf(row);
            $scope.rows.splice(index, 1);
        };

    });


// angular.module('RegForm').filter('formatDate', function () {
//     return function (date) {
//         return moment(date).format('MM/DD/YYYY');
//     };
// });