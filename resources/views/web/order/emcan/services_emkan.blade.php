@extends('layouts.front_layout')

@section('title', 'Installment')

@section('css')
  <!-- table -->
  <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">
  <!-- end -->
  <link rel="stylesheet" href="{{ asset('web/style.css') }}">
@endsection

@section('content')

    <div class="box-image">
      <img src="{{ asset('web/img.jpg') }}" alt="not found">
    </div>
    <!--<div class="box-image">-->
    <!--  <img src="./images/img2.jpg" alt="not found">-->
    <!--</div>-->
    <div class="inner-page">
      <div class="margin">
        <a href="https://web.emkanfinance.com.sa/?vid=Shabaka&&type=web" class="btn-link">تقدم بطلبك الآن</a>
      </div>
      <div class="advantages padding">
        <h3>المزايا؟</h3>
        <ul>
          <li> تقديم الطلب والشراء الكترونيا دون الحاجة لزيارة الفرع </li>
          <li> موافقة فورية </li>
          <li> تمويل يصل حتى 20,000 ريال </li>
          <li> فترة سداد تصل حتى 24 شهر </li>
          <li> بدون دفعة أولى </li>
          <li> متوافق مع أحكام الشريعة الإسلامية </li>
        </ul>
      </div>
      <div class="calculate">
        <h2>حاسبة الأقساط</h2>
        <div class="container-calc">
          <form class="inputs">
            <div class="box-input">
              <label>أدخل سعر المنتج</label>
              <input type="number" placeholder="أدخل سعر المنتج" max="30000" required>
              <p class="error" id="error-msg-mount">الرجاء إدخال المبلغ (أقل من 30000)</p>
            </div>
            <div class="box-input">
              <label>فترة السداد</label>
              <select required>
                <option class="defualt" value="0">اختر</option>
                <option value="6">6 أشهر</option>
                <option value="12">12 أشهر</option>
                <option value="18">18 أشهر</option>
                <option value="24">24 أشهر</option>
              </select>
              <p class="error" id="error-msg-duration">الرجاء اختيار فترة السداد</p>
            </div>
            <div class="button">
              <button class="calculate_button" type="button" id="btn-calc"> حساب القسط </button>
            </div>
          </form>
          <div class="results">
            <h3>القسط الشهري</h3>
            <h4> <span id="total-price">0</span> ر.س. </h4>
          </div>
        </div>
      </div>
      <div class="box-table">
        <h3>الأهلية:</h3>
        <div class="col-sm-12 overflow-y">
          <table class="table table-bordered table-hover dt-responsive width-100" id="table_page">
            <thead>
              <tr>
                <th>
                  الجهة الوظيفية
                </th>
                <th>
                  العمر
                </th>
                <th>
                  مدة الخدمة
                </th>
                <th>
                  صافي الراتب(الحد الأدنى)
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  حكومي/ شبه حكومي
                </td>
                <td>
                  20 سنة
                </td>
                <td>
                  3 أشهر
                </td>
                <td>
                  2,000
                </td>
              </tr>

              <tr>
                <td>
                  العسكريين (حسب الرتبة)
                </td>
                <td>
                  20 سنة
                </td>
                <td>
                  3 أشهر
                </td>
                <td>
                  2,000
                </td>
              </tr>
              <tr>
                <td>
                  القطاع الخاص
                </td>
                <td>
                  20 سنة
                </td>
                <td>
                  3 أشهر
                </td>
                <td>
                  2,000
                </td>
              </tr>
              <tr>
                <td>
                  المتقاعدين
                </td>
                <td>
                  70 سنة
                </td>
                <td>
                  NA
                </td>
                <td>
                  1,900
                </td>
              </tr>
              <tr>
                <td>
                  المقيمين – (القطاع الحكومي والخاص)
                </td>
                <td>
                  25 سنة
                </td>
                <td>
                  12 أشهر
                </td>
                <td>
                  5,000
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
      <div class="termsConditionBox padding">
        <h3>الشروط والأحكام:</h3>
        <ol>
          <li> خدمة تقسيط المشتريات هي خدمة مقدمة بالتعاون مع امكان للتمويل، ولهم كامل الحق في قبول أو رفض طلب التمويل
            المقدم من قبل العميل بناء على أهلية العميل والشروط والأحكام الخاصة بمزود الخدمة.</li>
          <li> يمكن للعميل الإستفادة من خدمة تقسيط المشتريات من شركة الشبكة الجديدة على ألا تقل قيمة الفاتورة عن 1,500
            ريال و بحد
            أقصى 20,000 ريال </li>
          <li> الخيارات المتاحة للتمويل: ( 6 أشهر – 12 شهر – 18 شهر – 24 شهر). و يحق للعميل اختيار المناسب بالنسبة إليه
            بشرط ألا تتعارض مع الشروط والأحكام الخاصة بشركة التمويل.</li>
          <li> يمكن للعميل استخدام قسيمة امكان للتسوق من متجر الشبكة الجديدة الإلكتروني و ذلك من خلال استخدام امكان في صفحة الدفع
            واستخدام رقم القسيمة. </li>
          <li> قسيمة إمكان تستخدم للشراء فقط لمرة واحدة وبعد الإستخدام لا يمكن إرجاع المبلغ نقداً.</li>
          <li> قسيمة امكان الشرائية صالحة لمدة 10 أيام من تاريخ التفعيل </li>

          <li> في حال إلغاء الطلب سيتم إرجاع المبلغ إلى رصيد حساب العميل في موقع الشبكة الجديدة </li>
          <li> لايمكن للعميل شراء المنتجات عن طريق الدمج ما بين طريقة الدفع عن طريق خدمة تقسيط المشتريات و أي طريقة دفع
            أخرى.</li>
          <li> خدمة تقسيط المشتريات تشمل حصول مزود الخدمة على هامش ربح 2% /شهر </li>

        </ol>
      </div>
    </div>


  <!-- table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src='https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js'></script>
  <script src='https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js'></script>
  <script src='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js'>
  </script>
  <!-- end -->

  <script>
    $(document).ready(function () {
      $(".error").hide();

      $("input[type='number'], select").on("change", function () {
        $(this).siblings(".error").hide();
      });
      $("#btn-calc").on("click", function () {
        var price = $("input[type='number']").val();
        var duration = $("select").val();
        if (price == "" || duration == "0") {
          if (price == "") {
            $("#error-msg-mount").show();
          } else {
            $("#error-msg-mount").hide();
          }

          if (duration == "0") {
            $("#error-msg-duration").show();
          } else {
            $("#error-msg-duration").hide();
          }
        } else {
          $("#error-msg-mount").hide();
          $("#error-msg-duration").hide();
          var priceDuration = parseInt(price) / parseInt(duration)
          var total = (priceDuration * .02) * parseInt(duration);
          var total_price = total + priceDuration
          $("#total-price").html(total_price.toFixed(0));
        }
      });
      $("table").DataTable({
        responsive: true,
        ordering: false,
      });

    });
  </script>
@endsection
