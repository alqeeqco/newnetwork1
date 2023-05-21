<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- font inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;600;700&family=Raleway:wght@600&display=swap"
          rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Inter', sans-serif;
        }

        main {
            border: 1px solid #d7d6d6;
            width: 600px;
            min-height: 99.6vh;
        }

        header {
            height: 110px;
            display: flex;
            align-items: center;
            padding: 0 35px;
        }

        .container-img {
            width: 200px;
            height: 50px;
        }

        .container-img img {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .content {
            width: 600px;
        }

        .p-5 {
            padding: 0 50px;
        }

        .d-flex {
            display: flex;
            justify-content: center;
        }

        .content .image {
            height: 204px;
            width: 204px;
            margin: 30px 0 50px;
        }

        .icon {
            height: 100%;
            width: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        h1 {
            color: #232323;
            font-size: 36px;
        }

        p {
            line-height: 2;
            color: #0A033C;
            font-weight: 700;
        }

        .btn {
            height: 48px;
            width: 143px;
            border-radius: 3px;
            padding: 16px 24px;
            border: none;
            background: #9B3B5A;
            color: #fff;
            margin-top: 20px;
            margin-bottom: 35px;
            cursor: pointer;
            font-weight: 700;
            position: absolute;
            bottom: 0;
        }

        @media screen and (max-width:767.98px) {
            main {
                width: 90%;
            }

            .content {
                width: 100%;
            }

            .content .image {
                height: 180px;
                width: 180px;
                margin: 34px 0 30px;
            }

            h1 {
                font-size: 28px;
            }

            p {
                line-height: 1.7;
                font-size: 14px;
            }
        }

        @media screen and (max-width:575.98px) {
            .content .image {
                height: 130px;
                width: 130px;
                margin: 34px 0 30px;
            }

            h1 {
                font-size: 25px;
            }

            .p-5 {
                padding: 0 20px;
            }
        }

        @media screen and (max-width:400.98px) {
            h1 {
                font-size: 20px;
            }

            .btn {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
<main>
    <header>
        <div class="container-img">
            <img  src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="logo" />
        </div>
    </header>

    <section class="content">
        <div class="p-5">
            @if ($mail->image)
                <div class="d-flex">
                    <div class="image">
                        <img  src="{{ Request::root() . '/dashboard/images/' . $mail->image }}" alt="invitation" class="icon" />
                    </div>
                </div>
            @endif
            <h1>{{ $mail->title }}</h1>
            <p>
                {{ $mail->mag }}
            </p>
            {{--            <button class="btn"> Join us New</button>--}}
        </div>
    </section>
</main>
</body>

</html>
