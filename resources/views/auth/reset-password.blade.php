{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}

{{--                <x-application-logo class="fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('password.update') }}">--}}
{{--            @csrf--}}

{{--            <!-- Password Reset Token -->--}}
{{--            <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />--}}
{{--            </div>--}}

{{--            <!-- Confirm Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--                <x-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                    type="password"--}}
{{--                                    name="password_confirmation" required />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-button>--}}
{{--                    {{ __('Reset Password') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            /* outline: 1PX solid black; */
            font-family: 'Cairo', sans-serif;
            font-weight: bold;
        }

        .reset-content {
            width: 450px;
            margin: auto;
        }

        .logo {
            width: auto;
            height: 50px;
            margin: auto;
            margin: 4rem auto 2rem auto;
        ;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .box {
            background-color: #ebecea;
            border-radius: 5px;
            box-shadow: 0px 2px 6px #a7aaa1;
            padding: 1.5rem;
        }

        input.code,
        .btn-send {
            height: 45px;
            width: 100%;
            border-radius: 6px;
            outline: none;
            border: none;
            padding: 0.5rem 1rem;
            margin: 2rem 0 1rem 0;
        }

        input.code {
            margin: 0;
            margin-bottom: 1rem;
        }

        .btn-send,
        .btn-send:hover {
            background: #494995;
            font-weight: bold;
            color: #fff;
            width: fit-content;
            text-transform: uppercase;
            cursor: pointer;
        }

        .j-c-end {
            justify-content: end;
        }

        .d-flex {
            display: flex;
        }

        p {
            margin-bottom: 2rem;
            font-weight: 500;
        }

        label {
            display: block;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        @media screen and (max-width: 500px) {
            .reset-content {
                width: 90%;
            }

            .logo {
                margin: 2rem auto 1rem auto;
            }

            input.code,
            .btn-send {
                height: 40px;
                font-size: 12px;
                margin-bottom: 10px;
            }

            .btn-send {
                margin-top: 10px;
            }

            p {
                margin-bottom: 1rem;
                font-weight: 500;
                line-height: 1.4;
                font-size: 14px;
            }

            label {
                margin-bottom: 4px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
<section class="reset-content">
    <div class="logo">
        <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="logo" />
    </div>
    <div class="box">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="input-g">
                <label for="email">{{ __('lang.email') }}</label>
                <input class="code" type="email" name="email" placeholder="Enter Email .." value="{{ old('email', $request->email) }}" required autofocus>
            </div>
            <div class="input-g">
                <label for="pass">{{ __('lang.new_password') }}</label>
                <input class="code" type="password" name="password" placeholder="Enter password .." required>
            </div>
            <div class="input-g">
                <label for="confirm">{{ __('lang.confirm_password') }}</label>
                <input class="code" type="password" name="password_confirmation" placeholder="Confirm password .." required>
            </div>
            <div class="d-flex j-c-end">
                <button class="btn btn-send">{{ __('lang.reset_password') }} </button>
            </div>
        </form>
    </div>
</section>
</body>

</html>