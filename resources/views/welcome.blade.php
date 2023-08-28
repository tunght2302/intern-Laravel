<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 Phone Number OTP Auth Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 550px">
    <div class="alert alert-danger" id="error" style="display: none;"></div>
    <h3>Add Phone Number</h3>
    <div class="alert alert-success" id="successAuth" style="display: none;"></div>
    <form>
        <label>Phone Number:</label>
        <input type="text" id="number" class="form-control mb-3" placeholder="+91 ********">
        <div id="recaptcha-container"></div>
        <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
    </form>
    <div class="mb-5 mt-5">
        <h3>Add verification code</h3>
        <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
        <form>
            <input type="text" id="verification" class="form-control" placeholder="Verification code">
            <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script>
    // const firebaseConfig = {
    //     apiKey: "AIzaSyDp_MRBLAFxHlunIQH5vbgq4AFugKCAckg",
    //     authDomain: "tactile-hold-360211.firebaseapp.com",
    //     databaseURL: "https://tactile-hold-360211.firebaseio.com",
    //     projectId: "tactile-hold-360211",
    //     storageBucket: "tactile-hold-360211.appspot.com",
    //     messagingSenderId: "860322000129",
    //     appId: "1:860322000129:web:48d95c01d6279651a8ff00",
    //     measurementId: "G-5YPKRZQWDJ"
    // };
    const firebaseConfig = {
        apiKey: "AIzaSyACbvsKNJuVDR8lN_PKnqJqqMKYnTbptAU",
        authDomain: "firstbase-9bc3a.firebaseapp.com",
        databaseURL: "https://firstbase-9bc3a.firebaseio.com",
        projectId: "firstbase-9bc3a",
        storageBucket: "firstbase-9bc3a.appspot.com",
        messagingSenderId: "435167837141",
        appId: "1:435167837141:web:44f0f0270aac75d7df9b5c",
        measurementId: "G-4PYH0Y3SW4"
    };
    firebase.initializeApp(firebaseConfig);
    window.onload = function () {
        render();
    };
    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }
    function sendOTP() {
        const number = $("#number").val();
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            // console.log(confirmationResult);
            $("#successAuth").text("Message sent").show();
        }).catch(function (error) {
            $("#error").text(error.message).show();
        });
    }
    function verify() {
        const code = $("#verification").val();
        coderesult.confirm(code).then(function (result) {
            const user = result.user;
            // console.log(user);
            $("#successOtpAuth").text("Auth is successful").show();
        }).catch(function (error) {
            $("#error").text(error.message).show();
        });
    }
</script>
</body>
</html>
