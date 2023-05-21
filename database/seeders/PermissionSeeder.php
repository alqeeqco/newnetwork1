<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        DB::table('permissions')->truncate();
        // Update Permission Table Settings
        $permissions = [
            [
                'en' => 'Address-List',
                'ar' => 'قائمة الأماكن',
            ],
            [
                'en' => 'Address-Create',
                'ar' => 'إنشاء مكان',
            ],
            [
                'en' => 'Address-Edit',
                'ar' => 'تعديل مكان',
            ],
            [
                'en' => 'Address-Delete',
                'ar' => 'حذف مكان',
            ],

            [
                'en' => 'Admins-List',
                'ar' => 'قائمة المسؤولين',
            ],
            [
                'en' => 'Admins-Create',
                'ar' => 'إنشاء مسؤول',
            ],
            [
                'en' => 'Admins-Edit',
                'ar' => 'تعديل مسؤول',
            ],
            [
                'en' => 'Admins-Delete',
                'ar' => 'حذف مسؤول',
            ],

            [
                'en' => 'Roles-List',
                'ar' => 'قائمة الصلاحيات',
            ],
            [
                'en' => 'Roles-Create',
                'ar' => 'إنشاء صلاحية',
            ],
            [
                'en' => 'Roles-Edit',
                'ar' => 'تعديل صلاحية',
            ],
            [
                'en' => 'Roles-Delete',
                'ar' => 'حذف صلاحية',
            ],


            [
                'en' => 'Ads-List',
                'ar' => 'قائمة الإعلانات',
            ],
            [
                'en' => 'Ads-Create',
                'ar' => 'إنشاء الإعلانات',
            ],
            [
                'en' => 'Ads-Edit',
                'ar' => 'تعديل الإعلانات',
            ],
            [
                'en' => 'Ads-Delete',
                'ar' => 'حذف الإعلانات',
            ],


            [
                'en' => 'Category-List',
                'ar' => 'قائمة التصنيفات',
            ],
            [
                'en' => 'Category-Create',
                'ar' => 'إنشاء تصنيف',
            ],
            [
                'en' => 'Category-Edit',
                'ar' => 'تعديل تصنيف',
            ],
            [
                'en' => 'Category-Delete',
                'ar' => 'حذف تصنيف',
            ],


            [
                'en' => 'City-List',
                'ar' => 'قائمة المدن',
            ],
            [
                'en' => 'City-Create',
                'ar' => 'إنشاء مدينة',
            ],
            [
                'en' => 'City-Edit',
                'ar' => 'تعديل مدينة',
            ],
            [
                'en' => 'City-Delete',
                'ar' => 'حذف مدينة',
            ],

            [
                'en' => 'Contact-List',
                'ar' => 'قائمة تواصل معنا',
            ],

            [
                'en' => 'Contact-Delete',
                'ar' => 'حذف تواصل معنا',
            ],

            [
                'en' => 'Country-List',
                'ar' => 'قائمة الدول',
            ],
            [
                'en' => 'Country-Create',
                'ar' => 'إنشاء دولة',
            ],
            [
                'en' => 'Country-Edit',
                'ar' => 'تعديل دولة',
            ],
            [
                'en' => 'Country-Delete',
                'ar' => 'حذف دولة',
            ],

            [
                'en' => 'Coupons-List',
                'ar' => 'قائمة الخصومات',
            ],
            [
                'en' => 'Coupons-Create',
                'ar' => 'إنشاء خصم',
            ],
            [
                'en' => 'Coupons-Edit',
                'ar' => 'تعديل خصم',
            ],
            [
                'en' => 'Coupons-Delete',
                'ar' => 'حذف خصم',
            ],

            [
                'en' => 'Product-List',
                'ar' => 'قائمة المنتجات',
            ],
            [
                'en' => 'Product-Create',
                'ar' => 'إنشاء منتج',
            ],
            [
                'en' => 'Product-Edit',
                'ar' => 'تعديل منتج',
            ],
            [
                'en' => 'Product-Delete',
                'ar' => 'حذف منتج',
            ],

            [
                'en' => 'Settings-List',
                'ar' => 'قائمة الإعدادات',
            ],

            [
                'en' => 'Settings-Edit',
                'ar' => 'تعديل الإعدادات',
            ],

            [
                'en' => 'Subscribe-List',
                'ar' => 'قائمة الاشتراكات',
            ],

            [
                'en' => 'Subscribe-Delete',
                'ar' => 'حذف الاشتراكات',
            ],
            [
                'en' => 'User-List',
                'ar' => 'قائمة المستخدمين',
            ],
            [
                'en' => 'User-Create',
                'ar' => 'إنشاء مستخدم',
            ],
            [
                'en' => 'User-Edit',
                'ar' => 'تعديل مستخدم',
            ],
            [
                'en' => 'User-Delete',
                'ar' => 'حذف مستخدم',
            ],

            [
                'en' => 'Why-Choose-us-List',
                'ar' => 'قائمة لماذا تم اختيارنا',
            ],
            [
                'en' => 'Why-Choose-us-Create',
                'ar' => 'إنشاء لماذا تم اختيارنا',
            ],
            [
                'en' => 'Why-Choose-us-Edit',
                'ar' => 'تعديل لماذا تم اختيارنا',
            ],
            [
                'en' => 'Why-Choose-us-Delete',
                'ar' => 'حذف لماذا تم اختيارنا',
            ],

            [
                'en' => 'Order-List',
                'ar' => 'قائمة الطلبات',
            ],
            [
                'en' => 'Order-Delete',
                'ar' => 'حذف طلبية',
            ],

        ];

        foreach ($permissions as $key => $value) {

            // Permission::create(['name' => $permission]);
            Permission::updateOrCreate([
                'name' => $value['en'],
                'name_ar' => $value['ar'],
            ],
                ['guard_name' => 'admin']
            );
        }
    }

}
