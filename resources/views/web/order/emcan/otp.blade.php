<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url(https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        .submit {
            background: linear-gradient(45deg, #7777AE, #32BCBB) no-repeat;
            border: none;
            outline: none;
            cursor: pointer;
            color: white;
            padding: 11px 35px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 50px;
            margin-top: 32px;
            width: 45%;
            height: 46px;
        }

        .container-timer {
            display: flex;
            justify-content: space-between;
        }

        #timer {
            display: flex;
            font-weight: bold;
        }

        #timer .card-time {
            background: #32BCBB;
            display: flex;
            height: 25px;
            width: 40px;
            border-radius: 4px;
            justify-content: center;
            align-items: center;
            margin: 0 2px;
            padding: 4px;
            color: #fff;
            box-shadow: 0 1px 6px #e6d4d4;
        }

        .input-main input {
            height: 26px;
            width: 100%;
            background: none;
            border: none;
            outline: none;
            color: #a2a2a2;
            font-size: 1rem;
            text-align: center;
        }

        .input-main input::placeholder {
            color: #a2a2a2;
        }

        .input-main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 15px;
            background-color: #ebebeb;
            border-radius: 4px;
            margin-bottom: 10px;
            width: 50px;
            height: 50px;
        }

        .input-main .fa-solid {
            width: 30px;
            height: auto;
            color: #a2a2a2;
            margin-right: 10px;
        }

        body {
            background: linear-gradient(45deg, #7777AE, #32BCBB) no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 27px 0;
        }

        .form-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 14px;
            margin-top: 42px;
        }

        .description {
            font-size: 1.1rem;
            color: #636363;
            margin-top: 10px;
        }

        .title {
            text-transform: uppercase;
            font-weight: 900;
            color: #4a4a4a;
        }

        .img-head {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo {
            height: 90px;
            width: 90px;
            margin: 0 auto;
        }

        .container {
            background-color: white;
            text-align: center;
            width: 50%;
            min-height: 400px;
            border-radius: 12px;
            margin: 0 12px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .inner {
            width: 45%;
            display: flex;
            justify-content: space-between;
        }

        .paragraph {
            text-transform: capitalize;
            font-size: 20px;
            text-align: left;
            /* padding-bottom: 16px; */
            background: -webkit-linear-gradient(45deg, #7777AE, #32BCBB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .pb-16 {
            padding-bottom: 16px;
        }

        .text {
            font-size: 12px;
        }

        @media screen and (max-width:1399.98px) {
            .container {
                width: 60%;
            }
        }

        @media screen and (max-width:1199.98px) {
            .container {
                width: 65%;
            }
        }

        @media screen and (max-width:991.98px) {
            .container {
                width: 75%;
            }
        }

        @media screen and (max-width:768.98px) {

            .paragraph,
            .submit,
            .inner {
                width: 55%;
            }

        }

        @media screen and (max-width:575.98px) {
            .container {
                width: 80%;
                min-height: 385px;
            }

            .submit,
            .input-main {
                height: 40px;
            }

            .input-main {
                width: 40px;
                /* margin: 0 10px; */
            }

            .input-main input {
                font-size: 12px;
            }

            .submit {
                font-size: 14px;
                margin-top: 22px;
            }

            .logo {
                height: 70px;
                width: 70px;
            }

            .paragraph {
                font-size: 18px;
            }

            .form-box {
                margin-top: 32px;
            }

            .paragraph,
            .submit,
            .inner {
                width: 90%;
            }
        }

        @media screen and (max-width:575.98px) {
            .container {
                min-height: 320px;
            }

            .paragraph {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img class="img-head" src="{{ asset('logo.png') }}" alt="Emkan">
        </div>
        <form class="form-box" action="{{ route('emcan.otp' , request()->route()->parameters['id']) }}" method="post">
            @csrf
            <div class="inner pb-16">
                <p class="paragraph">verification code</p>
                <div class="container-timer">
                    <div class="box">
                        <div id="timer">
                            <div class="card-time">
                                <span style="font-size: 12px;" id="min"></span>
                                <span style="margin: 0 2px;">:</span>
                                <span style="font-size: 12px;" id="sec"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner">
                <div class="input-main">
                    <input type="text" name="F1" placeholder="0">
                </div>
                <div class="input-main">
                    <input type="text" name="F2" placeholder="0">
                </div>
                <div class="input-main">
                    <input type="text" name="F3" placeholder="0">
                </div>
                <div class="input-main">
                    <input type="text" name="F4" placeholder="0">
                </div>
            </div>
            <button class="submit" type="submit">Confirm</button>
        </form>
    </div>
    <script>
        let countDownDate = new Date().getTime() + (5 * 60 * 1000);

        let x = setInterval(function() {
            let now = new Date().getTime();
            let distance = countDownDate - now;
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("min").innerHTML = minutes;
            document.getElementById("sec").innerHTML = seconds;

            console.log(minutes, "+++", seconds);

            if (distance < 0) {
                clearInterval(x);
                console.log("Time's up!");
            }
        }, 1000);
    </script>
</body>

</html>
