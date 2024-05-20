angular.module('RegForm', [])
    .controller('RegCntrl', function ($scope, $http) {
        $scope.currentStep = 1;
        $scope.formData = {};
        $scope.newValue = {};
        $scope.saveStep = function (step) {

            $scope.currentStep = step + 1;

        };

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