angular.module('RegForm', [])
    .controller('RegCntrl', function ($scope, $http) {
        $scope.currentStep = 1;
        $scope.formData = {};
        $scope.newValue = {};

        $scope.saveStep = function (step) {
            $http.post('steps.php', $scope.formData)
                .then(function (response) {
                    console.log("Response", response);
                    console.log('Step ' + step + ' data saved successfully');
                    $scope.currentStep = step + 1;
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Step ' + step + ' data saved successfully'
                    });
                }, function (error) {
                    console.error('Error saving step ' + step + ' data:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to save step ' + step + ' data'
                    });
                });
        };

        $scope.submitForm = function () {
            $scope.newValue = {
                ...$scope.formData,
                final_submit: true
            }
            console.log("newValue", $scope.newValue);
            $http.post('formSubmit.php', $scope.newValue)
                .then(function (response) {
                    console.log("Form Response", response);
                    console.log('Form submitted successfully');
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

    });


// angular.module('RegForm').filter('formatDate', function () {
//     return function (date) {
//         return moment(date).format('MM/DD/YYYY');
//     };
// });