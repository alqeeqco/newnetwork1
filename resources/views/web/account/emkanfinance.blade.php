<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emkan Payment</title>
    <style>
        @import url(https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Roboto", sans-serif;
            background-color: #F8F3EF;
        }

        .form {
            display: flex;
            flex-direction: column;
            min-width: 600px;
            /* height: 100vh; */
            margin: 0 auto;
            gap: 20px;
            justify-content: center;
        }

        .form-item {
            display: flex;
            flex-direction: column;
        }

        .form-item.has-error .form-label {
            color: #000;
        }

        .form-item.has-error .form-input {
            box-shadow: 0 1px 1px #cb0c0c;
        }

        .form-label {
            font-size: 16px;
            color: #161616;
            margin-bottom: 6px;
            text-transform: capitalize;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-input {
            border: none;
            border-radius: 0;
            background: #f9f9f9;
            height: 40px;
            padding: 0 16px;
            outline: none;
            box-shadow: 0 1px 1px #ddd;
        }

        .form-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-content {
            display: none;
            flex-direction: column;
            gap: 20px;
        }

        .form-content.active {
            display: flex;
        }

        .btn {
            border-radius: 4px;
            border: 2px solid transparent;
            font-size: 14px;
            background-color: #fff;
            cursor: pointer;
            outline: none;
            height: 40px;
            width: 120px;
            padding: 8px;
            margin-top: 2rem;
        }

        .btn.bordered {
            border-color: #3377E9;
            color: #3377E9;
        }

        .btn.primary {
            background-color: #3377E9;
            color: #fff;
        }

        .btn[disabled] {
            cursor: not-allowed;
        }

        .wizard {
            position: relative;
            display: flex;
            width: 100%;
        }

        .wizard:before {
            content: "";
            position: absolute;
            background-color: #fff;
            height: 2px;
            width: 100%;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .wizard-bar {
            position: absolute;
            background-color: #3377E9;
            height: 2px;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            transition: 0.3s ease;
        }

        .wizard-list {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .wizard-item {
            z-index: 2;
            transition: 0.4s ease;
            min-width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #3377E9;
            color: #3377E9;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            background-color: #f4f4f4;
        }

        .wizard-item.active {
            background-color: #3377E9;
            color: #fff;
        }

        .wizard-item.active.with-image:after {
            background-image: url(./white.svg);
        }

        .wizard-item.with-image:after {
            content: "";
            width: 24px;
            height: 24px;
            background-image: url(./blue.svg);
            background-repeat: no-repeat;
        }

        .container-form {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 4rem;
        }

        @media screen and (max-width: 767px) {
            .form {
                min-width: 100%;
            }

            .wizard-item {
                min-width: 25px;
                height: 25px;
                font-size: 12px;
            }

            .wizard-item.with-image:after {
                width: 17px;
                height: 17px;
                background-size: contain;
            }

            .container-form {
                padding: 3rem;
            }

            .container-form h2 {
                font-size: 22px;
            }

            .form-label {
                margin-bottom: 6px;
            }

            .btn {
                padding: 8px 1.5rem;
                width: fit-content;
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-form">
        <form class="form">
            <div class="wizard">
                <div class="wizard-bar" style="width: 0;" data-wizard-bar></div>
                <ul class="wizard-list">
                    <li class="wizard-item" data-wizard-item>1</li>
                    <li class="wizard-item" data-wizard-item>2</li>
                    <li class="wizard-item" data-wizard-item>3</li>
                    <li class="wizard-item" data-wizard-item>4</li>
                    <li class="wizard-item" data-wizard-item>5</li>
                </ul>
            </div>
            <div class="form-content" data-form-tab>
                <h2>{{ __('lang.first_stage') }}</h2>
            <div class="form-item" data-form-item>
                    <label for="input4" class="form-label">{{ __('lang.voucher_code') }}</label>
                    <input class="form-input" data-form-input id="input4" type="text" placeholder="Enter text">
                </div>
                <div class="form-item" data-form-item>
                    <label for="input1" class="form-label">{{ __('lang.customer_Id') }}</label>
                    <input class="form-input" data-form-input id="input1" type="text" placeholder="Enter text">
                </div>
                <div class="form-item" data-form-item>
                    <label for="input1" class="form-label">{{ __('lang.application_Id') }}</label>
                    <input class="form-input" data-form-input id="input1" type="text" placeholder="Enter text">
                </div>
            </div>
            <div class="form-content" data-form-tab>
                <h2>Second stage</h2>
                <div class="form-item" data-form-item>
                    <label for="input2" class="form-label">Label second</label>
                    <input class="form-input" data-form-input id="input2" type="text" placeholder="Enter text">
                </div>
            </div>
            <div class="form-content" data-form-tab>
                <h2>Third stage</h2>
                <div class="form-item" data-form-item>
                    <label for="input3" class="form-label">Label third</label>
                    <input class="form-input" data-form-input id="input3" type="text" placeholder="Enter text">
                </div>
            </div>
            <div class="form-content" data-form-tab>
                <h2>Third stage</h2>
                <div class="form-item" data-form-item>
                    <label for="input3" class="form-label">Label third</label>
                    <input class="form-input" data-form-input id="input3" type="text" placeholder="Enter text">
                </div>
            </div>
            <div class="form-content" data-form-tab>
                <h2>Third stage</h2>
                <div class="form-item" data-form-item>
                    <label for="input3" class="form-label">Label third</label>
                    <input class="form-input" data-form-input id="input3" type="text" placeholder="Enter text">
                </div>
            </div>
            <div class="form-buttons">
                <button class="btn bordered" type="button" data-btn-previous="true">Return</button>
                <button class="btn primary btn-next" type="button" data-btn-next="true">Next</button>
                <button class="btn primary btn-confirm" type="button">Confirm</button>
            </div>
        </form>
    </div>

    <script>
        let lastItem = document.querySelector('.wizard-item:last-child').classList.add('with-image')
        document.querySelector('.with-image').innerHTML = ''
        let wizardBar = document.querySelector('[data-wizard-bar]')
        let btnPrevious = document.querySelector('[data-btn-previous]')
        let btnConfirm = document.querySelector('.btn-confirm')
        let btnNext = document.querySelector('.btn-next')
        let currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            let formTabs = document.querySelectorAll('[data-form-tab]');
            let wizardItem = document.querySelectorAll('[data-wizard-item]')
            formTabs[n].classList.add('active')
            wizardItem[n].classList.add('active')

            if (n == 0) {
                btnPrevious.style.display = "none";
            } else {
                btnPrevious.style.display = "block";
            }
            if (n == formTabs.length - 1) {
                btnConfirm.style.display = "block";
                btnNext.style.display = "none";
            } else {
                btnConfirm.style.display = "none";
                btnNext.style.display = "block";
            }
        }

        function nextPrev(n) {
            let formTabs = document.querySelectorAll('[data-form-tab]');

            if (n == 1 && !validateForm()) return false;

            formTabs[currentTab].classList.remove('active')
            currentTab = currentTab + n;
            showTab(currentTab);
        }

        function validateForm() {
            let formTabs, formInputs, i, valid = true;
            formTabs = document.querySelectorAll('[data-form-tab]');
            formInputs = formTabs[currentTab].querySelectorAll('[data-form-input]');
            let formItem = formTabs[currentTab].querySelectorAll('[data-form-item]');

            for (i = 0; i < formInputs.length; i++) {
                if (formInputs[i].value == "") {
                    formItem[i].className += " has-error";
                    valid = false;
                } else {
                    formItem[i].classList.remove("has-error");
                }
            }
            return valid;
        }

        function updateWizardBarWidth() {
            const activeWizards = document.querySelectorAll(".wizard-item.active");
            let wizardItem = document.querySelectorAll('[data-wizard-item]')
            const currentWidth = ((activeWizards.length - 1) / (wizardItem.length - 1)) * 100;

            wizardBar.style.width = currentWidth + "%";
        }

        document.querySelector('*').addEventListener('click', function(event) {
            if (event.target.dataset.btnPrevious) {
                let wizardItem = document.querySelectorAll('[data-wizard-item]')
                wizardItem[currentTab].classList.remove('active')
                nextPrev(-1)
                updateWizardBarWidth()
            }
            if (event.target.dataset.btnNext) {
                nextPrev(1)
                updateWizardBarWidth()
            }
        })
    </script>
</body>

</html>
