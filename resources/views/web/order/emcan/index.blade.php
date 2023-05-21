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
            margin-top: 12px;
            width: 75%;
            height: 46px;
        }

        .input-main input {
            height: 26px;
            width: 100%;
            background: none;
            border: none;
            outline: none;
            color: #a2a2a2;
            font-size: 1rem;
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
            border-radius: 100px;
            margin-bottom: 10px;
            width: 75%;
            height: 46px;
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
            height: 486px;
            border-radius: 12px;
            margin: 0 12px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
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

            .submit,
            .input-main {
                width: 90%;
            }
        }

        @media screen and (max-width:575.98px) {
            .container {
                width: 90%;
                height: 430px;
            }

            .submit,
            .input-main {
                height: 40px;
            }

            .input-main input {
                font-size: 12px;
            }

            .submit {
                font-size: 14px;
            }

            .logo {
                height: 70px;
                width: 70px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img class="img-head" src="{{ asset('logo.png') }}" alt="Emkan">
        </div>
        <form action="{{ route('emcan.store' , request()->route()->parameters['id']) }}" method="post">
            @csrf
            <div class="form-box">
                <div class="input-main">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <input type="text" name="voucherCode" placeholder="Voucher Code">
                </div>

                <div class="input-main">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="text" name="customerId" placeholder="ID Number">
                </div>
                <div class="input-main">
                    <i class="fa-solid fa-fingerprint"></i>
                    <input type="text" name="applicationId" placeholder="Appliction Id">
                </div>
                <button class="submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
