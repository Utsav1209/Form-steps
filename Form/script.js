angular.module('RegForm', [])
    .controller('RegCntrl', function ($scope, $http) {


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

        // Save form step by step
        $scope.saveStep = function (step) {
            var primaryExists = $scope.PriCountryExists();
            var secondaryExists = $scope.SecCountryExists();
            var billingExists = $scope.BillCountryExists();

            if (!primaryExists) {
                $scope.errorMessage1 = 'Entered Primary country not found in the list.';
                return;
            } else if (!secondaryExists) {
                $scope.errorMessage2 = 'Entered Secondary country not found in the list.';
                return;
            } else if (step == 4) {
                if (!billingExists) {
                    $scope.errorMessage3 = 'Entered Billing country not found in the list.';
                    return;
                }
                $scope.currentStep = step + 1;
            }
            $scope.currentStep = step + 1;
        };

        // Final Submit Form
        $scope.currentStep = 1;
        $scope.formData = {};
        $scope.newValue = {};

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

        // Add dynamic address fields
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

    });


// $scope.formatDate = function (date) {
//     return moment(date).format('MM/dd/yyyy');
// };


// angular.module('RegForm').filter('formatDate', function () {
//     return function (date) {
//         return moment(date).format('MM/DD/YYYY');
//     };
// });