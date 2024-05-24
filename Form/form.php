<!DOCTYPE html>
<html lang="en" ng-app="RegForm" ng-controller="RegCntrl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#phone').mask('(999) 999-9999');
            $('#contact_phone').mask('(999) 999-9999');
        });
    </script>
</head>

<body>
    <div class="progress-bar">
        <div class="filled"></div>
    </div>
    <h1><b>Registration Form</b></h1>
    <h6 class="form-section"><i class="fa-solid fa-bars-staggered"></i>&nbsp;&nbsp;Step 1: Basic Details</h6>
    <form class="container-fluid form" ng-submit="saveStep(1)" method="post" ng-disabled="currentStep < 1">
        <div class=" row justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Name</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="name" name="name" ng-model="formData.name" placeholder="Enter Full Name" required minlength="2" maxlength="20">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cname">Company Name</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="cname" name="cname" ng-model="formData.cname" placeholder="Enter Company Name" required minlength="2" maxlength="50">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ctype">Company Type</label><span style="color: red;">*</span>
                    <select class="form-control" id="ctype" name="ctype" ng-model="formData.ctype" required>
                        <option value="" disabled selected>Select Company Type</option>
                        <?php
                        $enum_values = array('Payroll', 'Public', 'Private');
                        foreach ($enum_values as $value) {
                            echo "<option value='$value'>$value</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <h6 class="section">Primary Address</h6>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="pri_address1">Address Line 1</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="pri_address1" name="pri_address1" ng-model="formData.pri_address1" placeholder="Enter Address" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-11">
                        <label for="pri_address2">Address Line 2</label><span style="color: red;">*</span>
                        <input type="text" class="form-control" id="pri_address2" name="pri_address2" ng-model="formData.pri_address2" placeholder="Enter Address" required>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" name="add_more" class="btn btn-success add-more-btn" ng-click="addRow()">
                            <span class="glyphicon glyphicon-plus"></span> <b>+</b>
                        </button>
                    </div>
                </div>
                <fieldset ng-repeat="row in rows">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-11">
                                <label for="pri_address2{{$index}}">Address Line 2</label><span style="color: red;">*</span>
                                <input type="text" class="form-control" id="pri_address2{{$index}}" name="pri_address2{{$index}}" ng-model="formData['pri_address2' + ($index + 1)]" placeholder="Enter Address" required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" name="remove" ng-model="row.remove" class="btn btn-danger btn-sm" ng-click="removeRow(row)">
                                    <span class="glyphicon glyphicon-minus"></span> <b>&minus;</b>
                                </button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pri_zip">Zip</label><span style="color: red;">*</span>
                    <input type="number" class="form-control" id="pri_zip" name="pri_zip" ng-model="formData.pri_zip" placeholder="Enter Zip" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pri_city">City</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="pri_city" name="pri_city" ng-model="formData.pri_city" placeholder="Enter City" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pri_state">State</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="pri_state" name="pri_state" ng-model="formData.pri_state" placeholder="Enter State" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pri_country">Country</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="pri_country" name="pri_country" ng-model="formData.pri_country" placeholder="Enter Country" ng-change="filterPriCountries()" required autocomplete="off">
                    <div style="max-height: 200px; overflow-y: auto; cursor: pointer;" ng-show="formData.pri_country && filteredPriCountries.length > 0">
                        <div class="country-list" ng-repeat="country in filteredPriCountries" ng-click="selectPriCountry(country)" ng-mouseover="highlightCountry($event)" ng-mouseout="removeHighlight($event)">{{ country }}</div>
                    </div>
                    <div ng-show="errorMessage1" style="color: red;">{{ errorMessage1 }}</div>
                </div>
            </div>

        </div>
        <h6 class="section">Secondary Address</h6>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="secondary_address1">Address Line 1</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="secondary_address1" name="secondary_address1" ng-model="formData.secondary_address1" placeholder="Enter Address" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="secondary_address2">Address Line 2</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="secondary_address2" name="secondary_address2" ng-model="formData.secondary_address2" placeholder="Enter Address" required>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="secondary_zip">Zip</label><span style="color: red;">*</span>
                    <input type="number" class="form-control" id="secondary_zip" name="secondary_zip" ng-model="formData.secondary_zip" placeholder="Enter Zip" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="secondary_city">City</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="secondary_city" name="secondary_city" ng-model="formData.secondary_city" placeholder="Enter City" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="secondary_state">State</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="secondary_state" name="secondary_state" ng-model="formData.secondary_state" placeholder="Enter State" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="secondary_country">Country</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="secondary_country" name="secondary_country" ng-model="formData.secondary_country" placeholder="Enter Country" ng-change="filterSecCountries()" required autocomplete="off">
                    <div style="max-height: 200px; overflow-y: auto; cursor:pointer" ng-show="formData.secondary_country && filteredSecCountries.length > 0">
                        <div class="country-list" ng-repeat="country in filteredSecCountries" ng-click="selectSecCountry(country)" ng-mouseover="highlightCountry($event)" ng-mouseout="removeHighlight($event)">{{ country }}</div>
                    </div>
                    <div ng-show="errorMessage2" style="color: red;">{{ errorMessage2 }}</div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="phone" name="phone" ng-model="formData.phone" placeholder="Enter Phone" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="website">Website</label><span style="color: red;">*</span>
                    <input type="url" class="form-control" id="website" name="website" ng-model="formData.website" placeholder="Enter Website" pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" required>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <h6 class="form-section"><i class="fa-solid fa-bars-staggered"></i>&nbsp;&nbsp;Step 2: Company Contact</h6>
    <form class="container-fluid form" ng-submit="saveStep(2)" method="post">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_type">Contact Type</label><span style="color: red;">*</span>
                    <select class="form-control" id="contact_type" name="contact_type" ng-disabled="currentStep < 2" ng-model="formData.contact_type" required>
                        <option value="" disabled selected>Select Contact Type</option>
                        <?php
                        $enum_values = array('Primary', 'Secondary', 'Tertiary');
                        foreach ($enum_values as $value) {
                            echo "<option value='$value'>$value</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_title">Contact Title</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="contact_title" name="contact_title" ng-disabled="currentStep < 2" ng-model="formData.contact_title" placeholder="Enter Title" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_name">Contact Name</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" ng-disabled="currentStep < 2" ng-model="formData.contact_name" placeholder="Enter Name" required>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_email">Contact Email</label><span style="color: red;">*</span>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" ng-disabled="currentStep < 2" ng-model="formData.contact_email" placeholder="Enter Email" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_phone">Contact Phone</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" ng-disabled="currentStep < 2" ng-model="formData.contact_phone" placeholder="Enter Phone" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="emp_count">Employee Count</label><span style="color: red;">*</span>
                    <input type="number" class="form-control" id="emp_count" name="emp_count" ng-disabled="currentStep < 2" ng-model="formData.emp_count" placeholder="Enter Employee Count" min="5" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contract">Contract?</label><span style="color: red;">*</span><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="contract_yes" name="contract" ng-disabled="currentStep < 2" ng-model="formData.contact" value="Yes">
                        <label class="form-check-label" for="contract_yes">Yes</label>&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="radio" id="contract_no" name="contract" ng-disabled="currentStep < 2" ng-model="formData.contact" value="No">
                        <label class="form-check-label" for="contract_no">No</label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="comment">Comment Box</label><span style="color: red;">*</span>
                    <textarea type="text" class="form-control" id="comment" name="comment" ng-disabled="currentStep < 2" ng-model="formData.comment" placeholder="Comments" required></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" ng-disabled="currentStep < 2">Submit</button>
        </div>
    </form>
    <h6 class="form-section"><i class="fa-solid fa-bars-staggered"></i>&nbsp;&nbsp;Step 3: Plan Details</h6>
    <form class="container-fluid form" ng-submit="saveStep(3)" method="post">
        <h6 class="section">Plan Classes</h6>
        <hr>
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="fam" ng-disabled="currentStep < 3" name="fam" ng-model="formData.fam">
                    <label class="form-check-label" for="fam">
                        FAM - Familv Defender
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="com" ng-disabled="currentStep < 3" name="com" ng-model="formData.com">
                    <label class="form-check-label" for="com">
                        COM - Combo
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="fbc" ng-disabled="currentStep < 3" name="fbc" ng-model="formData.fbc">
                    <label class="form-check-label" for="fbc">
                        FBC - Family/Business Combo
                    </label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cc">Credit Card ($2.00 Service Fee)</label><span style="color: red;">*</span><br>
                    <div class="form-check form-check-inline" required>
                        <input class="form-check-input" type="radio" id="cc_yes" name="cc" ng-disabled="currentStep < 3" ng-model="formData.cc" value="Yes">
                        <label class="form-check-label" for="cc_yes">Yes</label>&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="radio" id="cc_no" name="cc" ng-disabled="currentStep < 3" ng-model="formData.cc" value="No">
                        <label class="form-check-label" for="cc_no">No</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date">Group Start Date</label><span style="color: red;">*</span>
                    <input type="date" class="form-control" id="start_date" name="start_date" ng-disabled="currentStep < 3" ng-model="formData.start_date" placeholder="Enter Date" required>
                    <div id="formatted_start_date" class="formatted-date"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">Group End Date</label><span style="color: red;">*</span>
                    <input type="date" class="form-control" id="end_date" name="end_date" ng-disabled="currentStep < 3" ng-model="formData.end_date" placeholder="Enter Date" required min="{{ formData.start_date | date: 'yyyy-MM-dd' }}">
                    <div id="formatted_end_date" class="formatted-date"></div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" ng-disabled="currentStep < 3">Submit</button>
        </div>
    </form>
    <h6 class="form-section"><i class="fa-solid fa-bars-staggered"></i>&nbsp;&nbsp;Step 4: Account & Billing Details</h6>
    <form class="container-fluid form" ng-submit="saveStep(4)" method="post">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="associate">Associate</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="associate" name="associate" ng-disabled="currentStep < 4" ng-model="formData.associate" placeholder="Enter Associate" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="acc_responsibility">Accounting Responsibility</label><span style="color: red;">*</span>
                    <select class="form-control" id="acc_responsibility" name="acc_responsibility" ng-disabled="currentStep < 4" ng-model="formData.acc_responsibility" required>
                        <option value="" disabled selected>Select Accounting Responsibility</option>
                        <?php
                        $enum_values = array('Accounting_Clerk', 'CTO', 'CMO', 'CEO', 'PA');
                        foreach ($enum_values as $value) {
                            echo "<option value='$value'>$value</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <h6 class="section">Billing Address</h6>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="billing_address1">Address Line 1</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="billing_address1" ng-disabled="currentStep < 4" name="billing_address1" ng-model="formData.billing_address1" placeholder="Enter Address" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="billing_address2">Address Line 2</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="billing_address2" ng-disabled="currentStep < 4" name="billing_address2" ng-model="formData.billing_address2" placeholder="Enter Address" required>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="billing_zip">Zip</label><span style="color: red;">*</span>
                    <input type="number" class="form-control" id="billing_zip" ng-disabled="currentStep < 4" name="billing_zip" ng-model="formData.billing_zip" placeholder="Enter Zip" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="billing_city">City</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="billing_city" ng-disabled="currentStep < 4" name="billing_city" ng-model="formData.billing_city" placeholder="Enter City" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="billing_state">State</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="billing_state" ng-disabled="currentStep < 4" name="billing_state" ng-model="formData.billing_state" placeholder="Enter State" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="billing_country">Country</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="billing_country" ng-disabled="currentStep < 4" name="billing_country" ng-model="formData.billing_country" placeholder="Enter Country" ng-change="filterCountries()" required autocomplete="off">
                    <div style="max-height: 200px; overflow-y: auto; cursor: pointer;" ng-show="formData.billing_country && filteredCountries.length > 0">
                        <div class="country-list" ng-repeat="country in filteredCountries" ng-click="selectCountry(country)" ng-mouseover="highlightCountry($event)" ng-mouseout="removeHighlight($event)">{{ country }}</div>
                    </div>
                    <div ng-show="errorMessage3" style="color: red;">{{ errorMessage3 }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="billing_method">Billing Method</label><span style="color: red;">*</span>
                    <select class="form-control" id="billing_method" ng-disabled="currentStep < 4" name="billing_method" ng-model="formData.billing_method" required>
                        <option value="" disabled selected>Select Billing Method</option>
                        <?php
                        $enum_values = array('Credit_Card', 'UPI', 'NetBanking', 'Cash', 'Debit_Card');
                        foreach ($enum_values as $value) {
                            echo "<option value='$value'>$value</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" ng-disabled="currentStep < 4">Submit</button>
        </div>
    </form>
    <h6 class="form-section"><i class="fa-solid fa-bars-staggered"></i>&nbsp;&nbsp;Step 5: Social Media</h6>
    <form class="container-fluid form" ng-submit="saveStep(5)" method="post">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fb_page">Facebook Page</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="fb_page" name="fb_page" ng-disabled="currentStep < 5" ng-model="formData.fb_page" placeholder="Facebook" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="twitter">Twitter</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="twitter" ng-disabled="currentStep < 5" name="twitter" ng-model="formData.twitter" placeholder="Twitter" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="linkedin">LinkedIn</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="linkedin" ng-disabled="currentStep < 5" name="linkedin" ng-model="formData.linkedin" placeholder="LinkedIn" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary" ng-disabled="currentStep < 5">Submit</button>
            </div>
        </div>
    </form>
    <h6 class="form-section"><i class="fa-solid fa-bars-staggered"></i>&nbsp;&nbsp;Step 6: Final Submission</h6>
    <form class="container-fluid form" ng-submit="saveStep(6)" method="post">
        <div class="col-md-12" style="text-align:center">
            <button type="button" class="btn btn-success" ng-click="submitForm()" name="final_submit" ng-disabled="currentStep < 6">Final Submit</button>
        </div>
    </form>
    <script>
        const filled = document.querySelector('.filled');

        function update() {
            filled.style.width = `${((window.scrollY) / (document.body.scrollHeight - window.innerHeight) * 100)}%`;
            requestAnimationFrame(update);
        }
        update();

        document.addEventListener('DOMContentLoaded', (event) => {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const formattedStartDateDisplay = document.getElementById('formatted_start_date');
            const formattedEndDateDisplay = document.getElementById('formatted_end_date');

            function updateFormattedDate(input, display) {
                const dateValue = input.value;
                if (dateValue) {
                    const formattedDate = moment(dateValue).format('MM/DD/YYYY');
                    display.textContent = `Selected Date: ${formattedDate}`;
                } else {
                    display.textContent = '';
                }
            }

            startDateInput.addEventListener('change', () => {
                updateFormattedDate(startDateInput, formattedStartDateDisplay);
            });

            endDateInput.addEventListener('change', () => {
                updateFormattedDate(endDateInput, formattedEndDateDisplay);
            });
            updateFormattedDate(startDateInput, formattedStartDateDisplay);
            updateFormattedDate(endDateInput, formattedEndDateDisplay);
        });
    </script>
    <script src="script.js"></script>
</body>

</html>