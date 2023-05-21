<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('settings')->insert([
//        ]);
        DB::insert("INSERT INTO `settings` (`sort_order`, `key_id`, `title_en`, `title_ar`, `value`, `set_group`, `created_at`, `updated_at`) VALUES
(1, 'about_ar', 'About the application in Arabic', 'عن التطبيق', 'value', 'general', '2016-10-19 02:04:48', '2023-01-29 05:21:38'),
(2, 'about_en', 'About the application in English', 'عن التطبيق الانجليزي', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(3, 'conditions_ar', 'Terms of use in Arabic', 'شروط الإستخدام', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(4, 'conditions_en', 'Terms of use in English', 'شروط الاستخدام الانجليزي', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(5, 'copy_right_ar', 'copyright in Arabic', 'حقوق النشر', '.', 'general', '2016-10-19 02:04:48', '2023-01-29 05:21:38'),
(6, 'copy_right_en', 'copyright in English', 'حقوق النشر الإنجليزي', '.', 'general', NULL, '2023-01-29 05:21:38'),
(17, 'email', 'Email', 'البريد الإلكتروني', '.', 'social', NULL, '2023-01-28 05:10:55'),
(19, 'facebook', 'Facebook', 'فيسبوك', '.', 'social', NULL, '2023-01-28 05:10:55'),
(16, 'faq_ar', 'FAQ in Arabic', 'التعليمات', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(16, 'faq_en', 'FAQ in English', 'التعليمات بالإنجليزي', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(7, 'Instagram', 'Instagram', 'انستجرام', '.', 'social', NULL, '2023-01-28 05:10:55'),
(14, 'location_ar', 'location in Arabic', 'الموقع', '.', 'general', NULL, '2023-01-29 05:21:38'),
(15, 'location_en', 'location in English', 'الموقع بالإنجليزي', '.', 'general', NULL, '2023-01-29 05:21:38'),
(20, 'logo', 'Website logo', 'لوجو الموقع', 'ksjMNSxVD0ex1674976898.png', 'general', NULL, '2023-01-29 05:21:38'),
(21, 'opening_hours_ar', 'Opening hours in Arabic ', 'ساعات العمل بالعربي', '.', 'general', NULL, '2023-01-29 05:21:38'),
(22, 'opening_hours_en', 'Opening hours in English ', 'ساعات العمل بالإنجليزي', '.', 'general', NULL, '2023-01-29 05:21:38'),
(18, 'phone', 'Phone', 'رقم الجوال', '.', 'social', NULL, '2023-01-28 05:10:55'),
(8, 'privacy_ar', 'Privacy Policy in Arabic ', 'سياسة الخصوصية', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(9, 'privacy_en', 'Privacy Policy in English', 'سياسة الخصوصية بالانجليزي', 'value', 'general', NULL, '2023-01-29 05:21:38'),
(10, 'Snapchat', 'Snapchat', 'سناب شات', '.', 'social', NULL, '2023-01-28 05:10:55'),
(11, 'TikTok', 'TikTok', 'تيك توك', '.', 'social', NULL, '2023-01-28 05:10:55'),
(12, 'twitter', 'Twitter', 'تويتر', '.', 'social', NULL, '2023-01-28 05:10:55'),
(13, 'whats', 'What`s Up', 'واتس اب', '.', 'social', NULL, '2023-01-28 05:10:55'),
(13, 'tax', 'Tax', 'الضريبة ع الطلب', '0', 'general', NULL, '2023-01-28 05:10:55'),
('23', 'contact-us', 'Photo Contact us', 'الصوره تواصل معنا', '132', 'general', '2023-03-14 13:00:37', '2023-03-14 13:00:37')");}
}
