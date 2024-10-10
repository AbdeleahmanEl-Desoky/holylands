<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Level;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\UserLesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = ['مبتدئ', 'متوسط', 'متقدم', 'خبير'];
        $lessons = [1, 2, 3, 4, 5];

        foreach ($levels as $key => $level) {
            Level::create([
                'name' => $level,
                'order' => $key + 1,
            ]);
        }

        foreach ($lessons as $key => $lesson) {
            Post::create([
                'title' => 'خبر رقم ( ' . $lesson . ' ) تعلم فنون ركوب الخيل',
                'description' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص',
                'image' => '../dashboard/images/H/' . $lesson . '.jpg',
                'status' => 1,
            ]);
        }

        foreach ($lessons as $key => $lesson) {
            $item_lesson = Lesson::create([
                'name' => 'درس رقم ( ' . $lesson . ' ) تعلم فنون ركوب الخيل',
                'description' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص',
                'image' => '../dashboard/images/H/' . $lesson . '.jpg',
                'date' => date("Y-m-d\TH:s"),
                'level_id' => rand(1, 4),
                'coach_id' => rand(9, 11),
                'number_hours' => rand(1, 5),
                'number_students' => rand(1, 20),
                'status' => 1,
            ]);
            if ($lesson > 3) {
                UserLesson::create([
                    'lesson_id' => $item_lesson->id,
                    'level_id' => $item_lesson->level_id,
                    'user_id' => 2,
                    'coach_id' => $item_lesson->coach_id,
                    'number_hours' => $item_lesson->number_hours,
                    'time_end' => Carbon::now()->addMinutes(180)->toDateTimeString(),
                ]);
            }

        }

        Page::create([
            'title' => 'حول التطبيق',
            'slug' => 'about-application',
            'description' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.',
        ]);

        Setting::create([
            'name' => 'logo',
            'value' => '../front/img/logo.png',
        ]);
        Setting::create([
            'name' => 'description',
            'value' => 'الاراضي المقدسة للفروسية - holy land riding center',
        ]);
        Setting::create([
            'name' => 'site_name',
            'value' => 'الاراضي المقدسة للفروسية',
        ]);
        Setting::create([
            'name' => 'address',
            'value' => 'فلسطين - أريحا',
        ]);
        Setting::create([
            'name' => 'mobile',
            'value' => '0598538687',
        ]);
        Setting::create([
            'name' => 'url_facebook',
            'value' => 'https://www.facebook.com/Holy.Land.Riding.Center',
        ]);
        Setting::create([
            'name' => 'url_twitter',
            'value' => 'https://twitter.com',
        ]);
        Setting::create([
            'name' => 'url_instagram',
            'value' => 'https://www.instagram.com',
        ]);
        Setting::create([
            'name' => 'url_whatsapp',
            'value' => 'https://wa.me/972597288192',
        ]);

    }
}
