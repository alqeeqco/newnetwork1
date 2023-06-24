<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('form/styleForm.css') }}">
</head>

<body>
  <main class="container mb-5">
    <section class="col-12 col-lg-8">
      <div class="image">
        <img src="{{ Request::root() . '/dashboard/images/' . App\Models\Ads::where('type' , 'order')->where('status' , 1)
        ->orderBy('id' , 'DESC')->first()->image }}" alt="not found">
      </div>
      <div class="accordion my-3">
        <button class="btn collapsed btn-details w-auto py-2 m-auto d-flex" data-bs-toggle="collapse"
          data-bs-target="#show" aria-expanded="false">
          للإطلاع على المزايا والشروط والمستندات المطلوبة اضغط هنا
        </button>
        <div id="show" class="accordion-collapse collapse py-4 pt-md-5 row flex-wrap">
          <div class="col-12 col-md-6 col-lg-4">
            <p class="mb-2">المزايا</p>
            <ul class="list-unstyled">
              <li>تقسيط أحدث الجوالات والتابليتات والساعات ابتداء من 99 ريال فقط</li>
              <li>فترة سداد حتى سنتين</li>
              <li>بدون دفعة أولى أو أخيرة</li>
              <li>بدون كفيل</li>
              <li>تسليم فوري</li>
            </ul>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p class="mb-2">الشروط</p>
            <ul class="list-unstyled">
              <li>يبدأ العمر من 20 سنة</li>
              <li>يبدأ الراتب الشهري من 2000 للسعودي و5000 للمقيم</li>
              <li>انتظام وظيفي 3 اشهر للسعودي و12 شهر للمقيم</li>
              <li>يجب أن تكون الوظيفة اما قطاع حكومي او قطاع خاص.</li>
              <li>يجب أال يكون مجموع االلتزامات الشهرية أكبر من %40 من الراتب الشهري. </li>
              <li>تطبق الشروط والأحكام</li>
            </ul>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p class="mb-2">المستندات المطلوبة</p>
            <ul class="list-unstyled">
              <li>الهوية الوطنية/هوية مقيم </li>
              <li>كشف حساب بنكي لأخر 3 أشهر</li>
              <li>تعريف بالراتب</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="row d-flex flex-wrap">
      <section class="col-12 col-lg-8 right-box px-0 mb-4 mb-lg-0">
        <div class="d-flex align-items-center px-3 py-2 border-bottom bg-box">
          <div class="logo">
            <img src="{{ Request::root() . '/dashboard/images/' . \App\Models\Settings::where('key_id' , 'logo')->first()->value }}" alt="not found">
          </div>
          <p class="mb-0 me-3"> أهلا بك في شركة الشبكة الجديدة سجل طلبك وسنقوم بدراسته فوراً والتواصل معك </p>
        </div>
        <div class="p-3">
          <div class="alert alert-warning" role="alert">
            إذا لديك ايقاف خدمات او تعثرات فلن نستطيع اكمال طلبك
          </div>
          <form action="{{ route('proposal.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="mb-2 mb-md-3">الاسم الرباعي </label>
                <input type="text" name="fill_name" class="form-control" value="{{ old('fill_name') }}">
                @error('fill_name')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-2 mb-md-3"> المدينة </label>
                <select class="form-select" name="city">
                  <option></option>
                  <option value="الرياض" @selected(old('city') == 'الرياض')> الرياض </option>
                  <option value="جدة" @selected(old('city') == 'جدة')> جدة </option>
                  <option value="تبوك" @selected(old('city') == 'تبوك')> تبوك </option>
                </select>
                {{-- <input type="text" name="city" class="form-control" value="{{ old('city') }}"> --}}
                @error('city')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-2 mb-md-3"> الوظيفة </label>
                <select class="form-select" name="employer">
                    <option selected> </option>
                    <option value="قطاع حكومي">قطاع حكومي</option>
                    <option value="قطاع خاص">قطاع خاص</option>
                    <option value="متقاعد">متقاعد</option>
                    <option value="غير موظف">غير موظف</option>
                </select>
                @error('employer')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-2 mb-md-3">الراتب الشهري</label>
                <input type="number" name="salary" class="form-control"  value="{{ old('salary') }}">
                @error('salary')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-2 mb-md-3">االلتزامات الشهرية</label>
                <input type="number" name="total_liabilities" class="form-control"  value="{{ old('total_liabilities') }}">
                @error('total_liabilities')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-2 mb-md-3">  رقم الجوال</label>
                <input type="number" name="phone" class="form-control" value="{{ old('phone') }}">
                @error('phone')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="mb-2 mb-md-3">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label class="mb-2 mb-md-3">مدة الخدمة للوظيفة الحالية بالأشهر؟ ( اقل مدة 3 اشهر للسعودي و12 شهر للمقيم )</label>
                <input type="text" name="job_duration" class="form-control" value="{{ old('job_duration') }}">
                @error('job_duration')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="form-check mb-3 d-flex align-items-center">
                <input class="form-check-input mt-0" name="agree_terms" type="checkbox" id="checkReq" required>
                <label class="form-check-label" for="checkReq">ارسالك للطب يعني
                <a href="http://newnetwork.sa/ar/Privacy-Policy" target="_blank" class="red-text text-decoration-none">
                قبولك للاحكام والشروط</a>
                </label>
            </div>
            <hr style="height: 2px;" />
            <div>
              <button class="btn btn-details px-3 py-2">إرسال الطلب الآن</button>
            </div>
          </form>
        </div>
      </section>
      <section class="col-12 col-lg-4 pe-0 pe-lg-4 ps-0">
        <div class="left-box">
          <p class="title py-2 px-3 mb-0 bg-box">حجز موعد اتصال </p>
          <form class="p-3" action="{{ route('appointment.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="mb-2"> الفرع التابع له : </label>
              <select class="form-select" name="branch">
                <option></option>
                <option value="الرياض"> الرياض </option>
                <option value="جدة"> جدة </option>
                <option value="تبوك"> تبوك </option>
              </select>
                @error('branch')
                <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="mb-2"> موعد الاتصال : </label>
              <select class="form-select" name="call_date">
                <option></option>
                <option value="من 12م الى 4م">من 12م الى 4م</option>
                <option value="من 4م الى 8م">من 4م الى 8م</option>
                <option value="من 8م الى 12ص">من 8م الى 12ص</option>
                {{-- <option value="٩ صباحًا">٩ صباحًا</option>
                <option value="١٠ صباحًا">١٠ صباحًا</option>
                <option value="١١ صباحًا">١١ صباحًا</option>
                <option value="١٢ ظهرًا">١٢ ظهرًا</option>
                <option value="١ مساءً">١ مساءً</option>
                <option value="٢ مساءً">٢ مساءً</option>
                <option value="٣ مساءً">٣ مساءً</option>
                <option value="٤ مساءً">٤ مساءً</option>
                <option value="٥ مساءً">٥ مساءً</option>
                <option value="٦ مساءً">٦ مساءً</option>
                <option value="٧ مساءً">٧ مساءً</option>
                <option value="٨ مساءً">٨ مساءً</option>
                <option value="٩ مساءً">٩ مساءً</option>
                <option value="١٠ مساءً">١٠ مساءً</option>
                <option value="١١ مساءً">١١ مساءً</option> --}}
              </select>
              @error('call_date')
              <div class="alert text-danger p-0">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
                <label class="mb-2">ادخل رقم الهاتف للاتصال </label>
                <input type="number" name="phone_nmuber" class="form-control">
                @error('phone_nmuber')
                    <div class="alert text-danger p-0">{{ $message }}</div>
                @enderror
            </div>
            <hr style="height: 2px;" />
            <div>
              <button class="btn btn-details px-3 py-2">حجز الموعد </button>
            </div>
          </form>
        </div>
      </section>
    </section>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
