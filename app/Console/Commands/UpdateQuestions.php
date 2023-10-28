<?php

namespace App\Console\Commands;

use App\Models\Question;
use Illuminate\Console\Command;

class UpdateQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        foreach ($this->questions() as $question) {
//            $findQuestion = Question::where('question_name_en',trim($question['Question_EN']))->first();
//            if (!$findQuestion) dd($question['Question_EN']);
//            $findQuestion->question_name_en = $question['Question_EN'] ?? null;
//            $findQuestion->description_en = $question['Description_EN'] ?? null;
//            $findQuestion->question_name_ar = $question['Question_AR'] ?? null;
//            $findQuestion->description_ar = $question['Description_AR'] ?? null;
//            $findQuestion->save();
//        }

        foreach (Question::where('type', 'question')->get() as $item) {
            $itemAnswers = $item->answers_array;

            if ($itemAnswers[0]['en'] == 'yes') $itemAnswers[0]['ar'] = 'نعم';
            if ($itemAnswers[0]['en'] == 'no') $itemAnswers[0]['ar'] = 'لا';
            if ($itemAnswers[1]['en'] == 'yes') $itemAnswers[1]['ar'] = 'نعم';
            if ($itemAnswers[1]['en'] == 'no') $itemAnswers[1]['ar'] = 'لا';
            $item->answers = $itemAnswers;
            $item->save();
        }
    }

    private function questions()
    {
        return [
            [
                "Question_EN" => "Car Parking",
                "Description_EN" => "",
                "Question_AR" => "",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is private car parking provided?",
                "Description_EN" => "Only select if you manage or own car parking within your private plot boundary",
                "Question_AR" => "هل يتم توفير مواقف خاصة للسيارات؟ ",
                "Description_AR" => "اختر فقط ما إذا كنت تدير او تمتلك موقف سيارات داخل منطقتك الخاصة"
            ],
            [
                "Question_EN" => "What is the total number of car parking spaces?",
                "Description_EN" => "This is the total number of spaces provided that you own and manage within your private plot boundary",
                "Question_AR" => "ما هو إجمالي عدد أماكن وقوف السيارت ؟",
                "Description_AR" => "هذا هو اجمالي عدد المساحات التي تمتلكها و تديرها ضمن حدود قطعة الأرض الخاصة بك "
            ],
            [
                "Question_EN" => "Within the 1-50 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات من 1-50 ، ماهو عدد الأماكن المخصصة لذوي الإحتياجات الخاصة؟",
                "Description_AR" => "المساحة المخصصة المستخدمة فقط من قبل الأشخاص ذوي الإحتياجات الخاصة ضمن الشهادة"
            ],
            [
                "Question_EN" => "Where are disabled car parking spaces located?",
                "Description_EN" => "State if disabled car parking spaces are located on ground floor outside the building or the basement or other level inside the building? Can select both",
                "Question_AR" => "اين توجد أماكن وقوف السيارات لذوي الإحتياجات الخاصة ؟",
                "Description_AR" => "الدولة اذا كانت مواقف السيارات المخصصة لذوي الإحتياجات الخاصة تقع في الطابق الأرضي، خارج المبنى او في الطابق السفلي أو أي مستوى اخر داخل المبنى؟ يمكن تحت كليهما"
            ],
            [
                "Question_EN" => "Are the disabled car parking spaces located close to a building entrance?",
                "Description_EN" => "State if disabled parking spaces are located closest to the main ground floor entrance (if outside building) or the main car park entrance (if inside the building)",
                "Question_AR" => "هل مواقف السيارات المخصصة لذوي الإحتياجات الخاصة تقع بالقرب من مدخل المبنى؟",
                "Description_AR" => "تقع السيارات المخصصة لذوي الإحتياجات الخاصة بالقرب من مدخل الطابق لرئيسي (إذا كان خارج المبنى) او مدخل موقف السيارات الرئيسي ( اذا كان داخل المبنى)"
            ],
            [
                "Question_EN" => "Are there any signs to show disabled parking space?",
                "Description_EN" => "The international symbol of disability may be displayed on a sign attached to wall or post. It may also be painted on the floor of parking space",
                "Question_AR" => "هل هناك أي علامات توضح أماكن وقوف السيارات المخصصة لذوي الإحتياجات الخاصة ؟",
                "Description_AR" => "الرمز الدولي المعروض على اللافتة المعلقة على الحائط او البريد ، يمكن ايضا طلاءها أو أرضية أماكن وقوف سيارات"
            ],
            [
                "Question_EN" => "Are there access zones to side of disabled parking spaces?",
                "Description_EN" => "An access zone is a protected area, that is either painted or has hatched lines, to one or both sides of the disabled parking bay. The zone stops other cars parking close and allows space for disabled people to enter and exit vehicle easily",
                "Question_AR" => "هل هناك مناطق وصول الى جانب أماكن وقوف السيارات المخصصة لذوي الإحتياجات الخاصة ؟",
                "Description_AR" => "منطقة الوصول هي منطقة محمية ، إما مرسومة أو بها خطوط مظللة ، على أحد جانبي موقف السيارات المخصص لذوي الاحتياجات الخاصة أو كليهما ، تسمح المنطقة بإيقاف مواقف السيارات الأخرى بشكل وثيق، مما يتيح لمساحة ذوي الاحتياجات للدخول و الخروج من السيارة بسهولة "
            ],
            [
                "Question_EN" => "Are disabled car parking spaces provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "هل يتم توفير أماكن لوقوف السيارات لذوي الحتياجات الخاصة؟ ",
                "Description_AR" => "مساحة مخصصة يستخدمها فقط ذوي الإحتياجات الحاصلون على شهادات ذات الصلة"
            ],
            [
                "Question_EN" => "Within the [] total spaces, how many disabled spaces are provided?",
                "Description_EN" => "",
                "Question_AR" => "ضمن {} إجمالي المساحات ، كم عدد المساحات المخصصة لذوي الاحتياجات الخاصة ؟",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Drop-off Space",
                "Description_EN" => "",
                "Question_AR" => "منطقة تنزيل الركاب",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is a drop-off space provided within private plot boundary?",
                "Description_EN" => "A drop-off space is a temporary parking space for private cars or taxis to drop people off close to building entrance",
                "Question_AR" => "هل يتم توفير مساحة للنزول داخل حدود قطعة الأرض الخاصة ؟",
                "Description_AR" => "مساحة النزول هي مساحة مؤقته لوقوف السيارات الخاصة او سيارات الأجرة لإنزال الاشخاص من مدخل المبنى"
            ],
            [
                "Question_EN" => "Is a drop-off space next to a building entrance?",
                "Description_EN" => "A drop-off space should be immediately adjacent to a building entrance or within a very short walk of no longer than 25m",
                "Question_AR" => "هل هناك مكان مخصص للتنزيل بجوار مدخل المبنى؟",
                "Description_AR" => "يجب ان تكون أماكن النزول مجاورة مباشرة او على مسافة قصيرة جدا لا تزيد عن 25 m"
            ],
            [
                "Question_EN" => "Is there a kerb beside drop-off space?",
                "Description_EN" => "A kerb is the edge of a road that separates the lower road from the raised sidewalk pedestrian area",
                "Question_AR" => "هل يوجد رصيف بجوار أماكن النزول ؟",
                "Description_AR" => "الرصيف هو حافة الطريق التي تفصل الطريق السفلي عن منطقة المشاة المرتفعة على الرصيف"
            ],
            [
                "Question_EN" => "Route Between Disabled Parking and Entrance",
                "Description_EN" => "",
                "Question_AR" => "الطريق بين مواقف ذوي الاحتياجات و المدخل ",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the width of the route between disabled spaces and entrance always over 850mm?",
                "Description_EN" => "On the entire route between disabled space and entrance, identify if there are any sections where the width of path reduces below 850mm",
                "Question_AR" => "هل عرض المسار بين الأماكن المخصصة لذوي الاحتياجات الخاصة و المدخل يزيد دائما عن 850 ملم ؟",
                "Description_AR" => "على المسار بأكملة بين المساحة المخصصة و المدخل ، حدد ما إذا كان هناك أي اقسام يقل فيها عرض المسار عن 850 ملم "
            ],
            [
                "Question_EN" => "Are there any obstructions on route between disabled spaces and entrance that reduce width of path below 850mm?",
                "Description_EN" => "On the entire route between disabled space and entrance, identify if there are temporary or permanent obstructions in the ground that reduce width of path below 850mm",
                "Question_AR" => "هل هناك أي عوائق على الطريق بين الأماكن المخصصة لذوي الإحتياجات الخاصة و المداخل مما يقلل من عرض المسار الى اقل من 850؟",
                "Description_AR" => "على المسار بأكملة بين المساحة المخصصة  للاحتياجات و المدخل ، حدد ما إذا كان هناك أي عوائق مؤقتة او دائمة في الارض  تقلل من عرض المسار عن 850 ملم "
            ],
            [
                "Question_EN" => "Are there any uneven surfaces on the route between disabled spaces and entrance?",
                "Description_EN" => "On the entire route between disabled parking and entrance, identify if there are any uneven surfaces that may cause trip hazard for people or be difficult to travel over in a wheelchair. Surfaces may include loose gravel, unfinished areas, sand, crazy paving or stones with large gaps",
                "Question_AR" => "هل هناك اي اسطح غير مستوية على الطريق بين أماكن ذوي الاحتياجات الخاصة و المدخل ؟",
                "Description_AR" => "على كامل الطريق بين موقف سيارات المعاقين و المدخل ، حدد ما اذا كانت هناك اي اسطح غير مستوية قد تسبب خطر تعثر الاشخاص او يصعب التنقل عليها على كرسي متحرك ، قد تشمل الاسطح الحصى السائب او المناطق غير المكتملة او الرصف الرملى او الحجارة ذات الفجوات الكبيرة "
            ],
            [
                "Question_EN" => "Is there any height obstruction below 2.1m on the route between disabled spaces and entrance?",
                "Description_EN" => "On the entire route between disabled parking and entrance, identify if there are any obstructions below 2.1m that can be hit with the head by people using path",
                "Question_AR" => "هل هناك اي عائق بارتفاع اقل من 2.1 متر على الطريق بين أماكن ذوي الاحتياجات الخاصة و المدخل؟",
                "Description_AR" => "على المسار بأكلمة بين مواقف سيارات الاحتياجات و المدخل ، حدد ما اذا كانت هناك اي عوائق اقل من 2.1 متر يمكن يصطدم بها الرأس من قبل الذين يستدمون المسار."
            ],
            [
                "Question_EN" => "Are any of the following present on the route between disabled parking and entrance?",
                "Description_EN" => "On the entire route between disabled parking and entrance identify if there are any of these change of levels that can cause problems for blind people, low mobility or people in wheelchairs. A drop to side of path should be selected if greater than 600mm in height",
                "Question_AR" => "هل يوجد اي مما يلي على الطريق بين موقف سيارات الاحتياجات و المدخل؟",
                "Description_AR" => "على كامل الطريق بين موقف سيارات لباحتياجات و المدخل ، حدد ما إذا كان هناك اي من هذه التغييرات في المستويات التي يمكن أن تسبب مشاكل للمكفوفين او ذوي القدرة المحدودة على الحركة او الاشخاص الذين يستخدمون الكراسي المتحركة ، يجب تحديد نقطة الهبوط الى جانب المسار اذا كان ارتفاعها اكبر من 600 ملم"
            ],
            [
                "Question_EN" => "Ramp Between Disabled Space and Entrance",
                "Description_EN" => "",
                "Question_AR" => "المنحدربين الفضاء الاحتياجات و مدخل",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the width of the ramp between disabled space and entrance over 850mm?",
                "Description_EN" => "Measure width of the ramp between handrails. If no handrails are provided, measure the floor space from each edge of the ramp",
                "Question_AR" => "هل عرض المنحدر بين المساحة المخصصة للاحتياجات و المدخل يزيد عن 850 ملم؟",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is length of the ramp in cm?",
                "Description_EN" => "قم بقياس الطول من أسفل المنحدر إلى أعلى المنحدر",
                "Question_AR" => "ما هو طول المنحدر بالسنتميتر ؟",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is height of the ramp in cm?",
                "Description_EN" => "Measure the height from bottom of ramp to top of ramp ",
                "Question_AR" => "ماهو ارتفاع المنحدر بالسنتميتر ؟",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Does the ramp have clear and level landing areas that are larger than 1.5m by 1.5m?",
                "Description_EN" => "A clear landing area allows wheelchair users to manoeuvre easily at top and bottom of ramp",
                "Question_AR" => "ماهو المنحدر هل يتحوي على مناطق هبوط واضحة و مستوية اكبر من 1.5 متر في 1.5 متر؟ ارتفاعات المنخدر في سم؟",
                "Description_AR" => "تسمح منطقة الهبوط الواضحة لمستخدمي الكراسي المتحركة بالمناورة بسهولة في أعلى و واسفل المنحدر "
            ],
            [
                "Question_EN" => "Is there a level landing rest area at least every 9m of the ramp?",
                "Description_EN" => "A landing area is a level area for people to stop and rest. It must be the width of ramp and at least 1.8m in length",
                "Question_AR" => "هل توجد منطقة استراحة مستوية للهبوط على الاقل كل 9 أمتار من المنحدر؟",
                "Description_AR" => "منطقة الهبوط هي منطقة مستوية يمكن للناس التوقف فيها و الراحة ، يجب ان يكون عرض المنحدر و الا يقل طوله عن 1.8 متر "
            ],
            [
                "Question_EN" => "Route Between Street and Entrance",
                "Description_EN" => "",
                "Question_AR" => "الطريق بين الشارع و المنحدر",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the main entrance directly on the street?",
                "Description_EN" => "State if main entrance is directly on the building line of the street or if it is set back from street with an external path between street and entrance",
                "Question_AR" => "هل المدخل الرئيسي على الشارع مباشرة؟",
                "Description_AR" => "الحالة اذا كان المدخل الرئيسي يقع مباشرة على خط بناء الشارع أو اذا كان بعيدا عن الشارع بمسار خارجي بين الشارع و مدخل "
            ],
            [
                "Question_EN" => "Is the width of the route between street and entrance always over 850mm?",
                "Description_EN" => "On the entire route between street and entrance, identify if there are any sections where the width of path reduces below 850mm",
                "Question_AR" => "هل عرض الطريق بين الشارع و المدخل دائماأكثر من 850 ملم؟",
                "Description_AR" => "على المسار بأكملة بين الشارع و المدخل ، حدد ما إذا كن هنالك اي اقسام يقل فيها عرض المسار عن 850 ملم "
            ],
            [
                "Question_EN" => "Are there any obstructions on route between street and entrance that reduce width of path below 850mm?",
                "Description_EN" => "On the entire route between street and entrance, identify if there are temporary or permanent obstructions in the ground that reduce width of path below 850mm",
                "Question_AR" => "هل هناك اي عوائق على الطريق بين الشارع و المدخل تقلل من عرض المسار إلى أقل من 850 ملم ؟",
                "Description_AR" => "على المسار بأكملة بين الشارع و المدخل ، حدد ما إذا كانت هناك عوائق مؤقتة او دائمة في الأرض تقلل عرض المسار الى اقل من 850 ملم"
            ],
            [
                "Question_EN" => "Are there any uneven surfaces on the route between street and entrance?",
                "Description_EN" => "On the entire route between street and entrance, identify if there are any uneven surfaces that may cause trip hazard for people or be difficult to travel over in a wheelchair. Surfaces may include loose gravel, unfinished areas, sand, crazy paving or stones with large gaps",
                "Question_AR" => "هل هناك اي اسطح غير مستوية على الطريق بين الشارع و المدخل ؟",
                "Description_AR" => "على الطريق بأكملة بين الشارع و المدخل ، حدد ما اذا كانت اي اسطح غير مستوية قد تسبب خطر تعثر الأشخاص او يصعب السفر عبرها في عربة مدولبة ، قد تشمل الأسطح الحصى السائب او المناطق الغير مكتملة او الرمل او الحجارة ذات الفجوات الكبيرة"
            ],
            [
                "Question_EN" => "Is there any height obstruction below 2.1m on the route between street and entrance?",
                "Description_EN" => "On the entire route between street and entrance, identify if there are any obstructions below 2.1m that can be hit with the head by people using path",
                "Question_AR" => "هل هناك اي عائق بارتفاع اقل من 2.1 متر على الطريق بين الشارع و المدخل؟",
                "Description_AR" => "على الطريق بأكمله بين الشارع والمدخل ، حدد ما إذا كانت هناك أي عوائق أقل من 2.1 متر يمكن أن تصطدم بالرأس من قبل الأشخاص الذين يستخدمون المسار"
            ],
            [
                "Question_EN" => "Are any of the following present on the route between street and entrance?",
                "Description_EN" => "On the entire route between street and entrance identify if there are any of these change of levels that can cause problems for blind people, low mobility or people in wheelchairs. A drop to side of path should be selected if greater than 600mm in height from floor",
                "Question_AR" => "هل يوجد أي مما يلي على الطريق بين الشارع والمدخل?",
                "Description_AR" => "على الطريق بأكمله بين الشارع والمدخل ، حدد ما إذا كان هناك أي من هذه التغييرات في المستويات التي يمكن أن تسبب مشاكل للمكفوفين أو ضعف الحركة أو الأشخاص في الكراسي المتحركة. يجب تحديد قطرة إلى جانب المسار إذا كان ارتفاعه أكبر من 600 مم من الأرض"
            ],
            [
                "Question_EN" => "Ramp Between Street and Entrance",
                "Description_EN" => "",
                "Question_AR" => "منحدر بين الشارع و المدخل ",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the width of the ramp over 850mm?",
                "Description_EN" => "Measure the width of ramp floor. If there are handrails, measure distance between each handrail",
                "Question_AR" => "هل عرض المنحدر يزيد عن 850 مم?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is length of the ramp in cm?",
                "Description_EN" => "قم بقياس الطول من أسفل المنحدر إلى أعلى المنحدر",
                "Question_AR" => "ما هو طول المنحدر بالسنتميتر ؟",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is height of the ramp in cm?",
                "Description_EN" => "Measure the height from bottom of ramp to top of ramp",
                "Question_AR" => "ما هو إرتفاع المنحدر بالسنتيميتر؟",
                "Description_AR" => "قم بقياس الارتفاع من اسفل المنحدر الى أعلى المنحدر "
            ],
            [
                "Question_EN" => "Does this ramp have clear and level landing areas that are larger than 1.5m by 1.5m?",
                "Description_EN" => "A clear landing area allows wheelchair users to manoeuvre easily at top and bottom of ramp",
                "Question_AR" => "هل يحتوي هذا المنحدر على مناطق هبوط واضحة ومستوية أكبر من 1.5 م في 1.5 م?",
                "Description_AR" => "تسمح منطقة الهبوط الواضحة لمستخدمي الكراسي المتحركة بالمناورة بسهولة في أعلى وأسفل المنحدر"
            ],
            [
                "Question_EN" => "Stairs Between Street and Entrance",
                "Description_EN" => "",
                "Question_AR" => "السلالم بين الشارع و المدخل",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Do stairs have handrails?",
                "Description_EN" => "A handrail is provided for balance and stability of all users. The upper handrail should be between 875mm - 925mm from floor",
                "Question_AR" => "هل السلالم بها درابزين؟",
                "Description_AR" => "يتم توفير الدرابزين لتحقيق التوازن والاستقرار لجميع المستخدمين. يجب أن يكون الدرابزين العلوي بين 875 مم - 925 مم من الأرض"
            ],
            [
                "Question_EN" => "Are handrails on stairs provided at two heights?",
                "Description_EN" => "An upper and lower handrail is provided for people at all heights or in wheelchairs. The lower handrail should be between 600mm - 750mm from floor",
                "Question_AR" => "هل يتم توفير الدرابزين على الدرج على إرتفاعين؟",
                "Description_AR" => "يتم توفير الدرابزين العلوي والسفلي للأشخاص في جميع المرتفعات أو في الكراسي المتحركة. يجب أن يكون الدرابزين السفلي بين 600 مم - 750 مم من الأرض"
            ],
            [
                "Question_EN" => "Are tactile warning surfaces provided on stairs?",
                "Description_EN" => "A tactile warning strip is a textured floor paving that alerts blind people about hazard.",
                "Question_AR" => "هل يتم توفير أسطح التحذير اللمسية على الدرج؟",
                "Description_AR" => "شريط التحذير اللمسي هو رصيف أرضي محكم ينبة المكفوفين حول الخطر"
            ],
            [
                "Question_EN" => "Single Step Between Street and Entrance",
                "Description_EN" => "",
                "Question_AR" => "خطوة واحدة بين الشارع و المدخل",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there an alternative route to entrance to avoid the step?",
                "Description_EN" => "A single step can cause trip hazard or difficulty for wheelchair users. State if an alternative step-free route to the entrance is available",
                "Question_AR" => "هل هناك طريق بديل للدخول لتجنب الخطوة؟",
                "Description_AR" => "يمكن أن تتسبب خطوة واحدة في خطر الرحلة أو صعوبة مستخدمي الكراسي المتحركة. حدد ما إذا كان هناك طريق بديل خالٍ من الخطوات إلى المدخل"
            ],
            [
                "Question_EN" => "Drop to side of path",
                "Description_EN" => "",
                "Question_AR" => "تسقط الى جانب المسار",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there a guardrail along side of path?",
                "Description_EN" => "A drop to side of path of greater than 600mm must be protected with a guardrail to national regulation standards",
                "Question_AR" => "هل هناك حاجز حماية على طول الطريق؟",
                "Description_AR" => "يجب حماية قطرة إلى جانب مسار أكبر من 600 مم باستخدام حاجز حماية لمعايير التنظيم الوطنية"
            ],
            [
                "Question_EN" => "Within the 51-100 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 51-100 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 101-200 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 101-200 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 201-300 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 201-300 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 301-500 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 301-500 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 501-600 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 501-600 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 601-700 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 601-700 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 701-800 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 701-800 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 801-900 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 801-900 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 901-1000 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 901-1000 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 1001-1100 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 1001-1100 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Within the 1101-1200 total spaces, how many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "ضمن إجمالي المساحات 1101-1200 ، كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "How many disabled spaces are provided?",
                "Description_EN" => "A designated space used only by disabled people with relevant certification",
                "Question_AR" => "كم عدد المساحات المعطلة المقدمة?",
                "Description_AR" => "مساحة مخصصة يستخدمها الاشخاص ذوي الاحتياجات فقط مع شهادات ذات صلة"
            ],
            [
                "Question_EN" => "Is there a kerb cut?",
                "Description_EN" => "A kerb-cut is a sloped area that connects the raised pedestrian area with road and avoids need to climb up the step",
                "Question_AR" => "هل هناك قطع الرصيف؟",
                "Description_AR" => "قطع الرصيف هو منطقة منحدرة تربط منطقة المشاة المرتفعة بالطريق وتتجنب الحاجة إلى تسلق الخطوة"
            ],
            [
                "Question_EN" => "xxxxx",
                "Description_EN" => "yyyyy",
                "Question_AR" => "",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Do the stairs have handrails?",
                "Description_EN" => "A handrail is provided for balance and stability of all users. The upper handrail should be between 875mm - 925mm from floor",
                "Question_AR" => "هل الدرج له درابزين؟",
                "Description_AR" => "يتم توفير الدرابزين لتحقيق التوازن والاستقرار لجميع المستخدمين. يجب أن يكون الدرابزين العلوي بين 875 مم - 925 مم من الأرض"
            ],
            [
                "Question_EN" => "Are the handrails on stairs provided at two heights?",
                "Description_EN" => "An upper and lower handrail is provided for people at all heights or in wheelchairs. The lower handrail should be between 600mm - 750mm from floor",
                "Question_AR" => "هل الدرابزين على السلالم متوفرة على إرتفاعين؟",
                "Description_AR" => "يتم توفير الدرابزين العلوي والسفلي للأشخاص في جميع المرتفعات أو في الكراسي المتحركة. يجب أن يكون الدرابزين السفلي بين 600 مم - 750 مم من الأرض"
            ],
            [
                "Question_EN" => "Are there tactile warning surfaces provided on stairs?",
                "Description_EN" => "A tactile warning strip is a textured floor paving that alerts blind people about hazard.",
                "Question_AR" => "هل هناك أسطح تحذيرية ملموسة على الدرج?",
                "Description_AR" => " شريط التحذير اللمسي هو رصف أرضي محكم ينبه المكفوفين حول الخطر"
            ],
            [
                "Question_EN" => "Single Step Between Disabled Space and Entrance",
                "Description_EN" => "",
                "Question_AR" => "خطوة واحدة بين مساحة الإحتياجات الخاصة و المدخل",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there an alternative route to the entrance to avoid the step?",
                "Description_EN" => "A single step can cause trip hazard or difficulty for wheelchair users. State if an alternative step-free route to the entrance is available",
                "Question_AR" => "هل هناك طريق بديل لتجنب الخطوة ؟",
                "Description_AR" => "يمكن أن تتسبب خطوة واحدة في خطر الرحلة أو صعوبة مستخدمي الكراسي المتحركة. حدد ما إذا كان هناك طريق بديل خالٍ من الخطوات إلى المدخل"
            ],
            [
                "Question_EN" => "Drop to side of path Between Disabled Space and Entrance",
                "Description_EN" => "",
                "Question_AR" => "أنزل الى جانب المسار بين مساحة الإحتياجات و المدخل",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there a guardrail along the side of path?",
                "Description_EN" => "A drop to side of path of greater than 600mm must be protected with a guardrail to national regulation standards",
                "Question_AR" => "هل هناك حاجز حماية على جانب اليسار ؟",
                "Description_AR" => "يجب حماية قطرة إلى جانب مسار أكبر من 600 مم باستخدام حاجز حماية لمعايير التنظيم الوطنية"
            ],
            [
                "Question_EN" => "Is there a level landing rest area at least every 9m of this ramp?",
                "Description_EN" => "A landing area is a level area for people to stop and rest. It must be the width of ramp and at least 1.8m in length",
                "Question_AR" => "هل هناك منطقة استراحة هبوط على الأقل كل 9 أمتار من هذا المنحدر?",
                "Description_AR" => "منطقة الهبوط هي منطقة مستوى للناس للتوقف والراحة. يجب أن يكون عرض المنحدر وطوله 1.8 متر على الأقل"
            ],
            [
                "Question_EN" => "Does this ramp have handrails?",
                "Description_EN" => "A handrail is provided for balance and stability of all users. The upper handrail should be between 875mm - 925mm from floor",
                "Question_AR" => "هل هذا المنحدر يحتوي على درابزين?",
                "Description_AR" => "يتم توفير الدرابزين لتحقيق التوازن والاستقرار لجميع المستخدمين. يجب أن يكون الدرابزين العلوي بين 875 مم - 925 مم من الأرض"
            ],
            [
                "Question_EN" => "Ground Floor Main Entrance",
                "Description_EN" => "NULL",
                "Question_AR" => "المدخل الرئيسي للطابق الأرضي",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are any of the following present at the ground floor building entrance?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يوجد أي مما يلي عند مدخل مبنى الطابق الأرضي?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "A sign easily visible at entrance, clearly showing the address and name of building",
                "Description_EN" => "NULL",
                "Question_AR" => "لافتة يمكن رؤيتها بسهولة عند المدخل ، توضح بوضوح عنوان المبنى واسمه",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the main ground floor entrance protected from the sun?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل مدخل الطابق الأرضي الرئيسي محمي من الشمس?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is the main door used at the ground floor main entrance?",
                "Description_EN" => "NULL",
                "Question_AR" => "ما هو الباب الرئيسي المستخدم في المدخل الرئيسي للطابق الأرضي?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there a clear and level space of at least 1.5m by 1.5m in front of main entrance when swing doors are opened?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل هناك مساحة واضحة ومستوية لا تقل عن 1.5 م × 1.5 م أمام المدخل الرئيسي عند فتح الأبواب المتأرجحة?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there a clear and level space of at least 1.5m by 1.5m in front of main entrance?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل هناك مساحة واضحة ومستوية لا تقل عن 1.5 م × 1.5 م أمام المدخل الرئيسي?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the front of building made mainly with glass?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل واجهة المبنى مصنوعة بشكل رئيسي من الزجاج?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Can the main entrance door be clearly seen?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يمكن رؤية باب المدخل الرئيسي بوضوح?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Does the glass have markings so can be clearly seen?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يحتوي الزجاج على علامات بحيث يمكن رؤيتها بوضوح?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are there two doors in row at main entrance?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يوجد بابان متتاليان عند المدخل الرئيسي?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the distance between opened doors more than 1.2m at main entrance?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل المسافة بين الأبواب المفتوحة أكثر من 1.2 متر عند المدخل الرئيسي?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Ramp at Main Entrance",
                "Description_EN" => "NULL",
                "Question_AR" => "المنحدر عند المدخل الرئيسي",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the width of the main entrance ramp over 850mm?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل عرض منحدر المدخل الرئيسي يزيد عن 850 مم?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is length of the entrance ramp in cm?",
                "Description_EN" => "NULL",
                "Question_AR" => "ما هو طول منحدر المدخل بالسنتيمتر?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "What is height of the entrance ramp in cm?",
                "Description_EN" => "NULL",
                "Question_AR" => "ما هو ارتفاع منحدر المدخل بالسنتيمتر?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Does the ramp have clear and level landing areas that are larger than 1.5m by 1.5m at top and bottom of entrance?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يحتوي المنحدر على مناطق هبوط واضحة ومستوية أكبر من 1.5 م × 1.5 م في أعلى وأسفل المدخل?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there a level landing rest area at least every 9m of the main entrance ramp?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل هناك منطقة استراحة هبوط مستوية على الأقل كل 9 أمتار من منحدر المدخل الرئيسي?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Does the main entrance ramp have handrails?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يوجد في منحدر المدخل الرئيسي درابزين?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there any alternative level entrance to building with no ramp or stairs?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل هناك مدخل بديل للمبنى بدون منحدر أو سلالم?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Stairs at Main Entrance",
                "Description_EN" => "NULL",
                "Question_AR" => "الدرج عند المدخل الرئيسي",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Do the stairs at main entrance have handrails?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل السلالم عند المدخل الرئيسي بها درابزين?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are these handrails provided at two heights?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يتم توفير هذه الدرابزين على ارتفاعين?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are tactile warning surfaces provided on main entrance stairs?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل يتم توفير أسطح التحذير اللمسية على سلالم المدخل الرئيسية?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Single Step at Main Entrance",
                "Description_EN" => "NULL",
                "Question_AR" => "خطوة واحدة عند المدخل الرئيسي",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there an alternative entrance to avoid the step?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل هناك مدخل بديل لتجنب الخطوة?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there a guardrail to protect people from falling?",
                "Description_EN" => "NULL",
                "Question_AR" => "هل هناك حاجز حماية لحماية الناس من السقوط?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Drop to Side of Main Entrance",
                "Description_EN" => "NULL",
                "Question_AR" => "نزول بجانب الباب الرئيسي",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Reception, Help or Payment Desks",
                "Description_EN" => "NULL",
                "Question_AR" => "مكاتب الاستقبال أو المساعدة أو الدفع",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is there an information or help desk?",
                "Description_EN" => "An information, reception or help desk is where a person can help visitors find their location within building",
                "Question_AR" => "هل هناك معلومات أو مكتب مساعدة?",
                "Description_AR" => "المعلومات أو مكتب الاستقبال أو مكتب المساعدة حيث يمكن للشخص مساعدة الزوار في العثور على موقعهم داخل المبنى"
            ],
            [
                "Question_EN" => "Is the information desk easily seen when enter main entrance?",
                "Description_EN" => "State if information desk is in logical and easily located position within entrance lobby so all visitors can clearly identify it",
                "Question_AR" => "هل يمكن رؤية مكتب المعلومات بسهولة عند دخول المدخل الرئيسي?",
                "Description_AR" => "اذكر ما إذا كان مكتب المعلومات في وضع منطقي وسهل الموقع داخل ردهة المدخل حتى يتمكن جميع الزوار من التعرف عليه بوضوح"
            ],
            [
                "Question_EN" => "Does the information desk have a lowered section?",
                "Description_EN" => "A lower section counter that is maximum 760mm high be at least 1800mm wide",
                "Question_AR" => "هل يحتوي مكتب المعلومات على قسم منخفض?",
                "Description_AR" => "يبلغ عرض عداد القسم السفلي الذي يبلغ ارتفاعه 760 مم على الأقل 1800 مم"
            ],
            [
                "Question_EN" => "Corridors",
                "Description_EN" => "NULL",
                "Question_AR" => "الممرات",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are all corridors in the building over 1.2m in width?",
                "Description_EN" => "Measure width of floor from one wall to the other side help",
                "Question_AR" => "هل جميع الممرات في المبنى يزيد عرضها عن 1.2 متر?",
                "Description_AR" => "قياس عرض الأرضية من جدار إلى آخر يساعد"
            ],
            [
                "Question_EN" => "Do any corridors have any floor objects that reduce the width below 1.2m?",
                "Description_EN" => "Measure width of floor from one wall to the edge of obstruction help",
                "Question_AR" => "هل تحتوي أي ممرات على أي أجسام أرضية تقلل العرض إلى أقل من 1.2 متر?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممر أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Are there any overhead obstructions below 2.1m in any corridors?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of corridor below 2.1m",
                "Question_AR" => "هل هناك أي عوائق علوية أقل من 2.1 متر في أي ممرات?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممر أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Elevators",
                "Description_EN" => "NULL",
                "Question_AR" => "المصاعد",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are there any elevators for use by public?",
                "Description_EN" => "An elevator is for public to use to move between different floors of building help",
                "Question_AR" => "هل هناك مصاعد للإستخدام من قبل العامة ؟",
                "Description_AR" => "المصعد للجمهور لاستخدامه للتنقل بين الطوابق المختلفة للمساعدة في البناء"
            ],
            [
                "Question_EN" => "Is there a clear space of 1.5m by 1.5m in front of elevator door?",
                "Description_EN" => "A clear space allows wheelchair users to safely enter or exit the elevator help",
                "Question_AR" => "هل هناك مساحة واضحة 1.5 م × 1.5 م أمام باب المصعد?",
                "Description_AR" => "تسمح المساحة الشفافة لمستخدمي الكراسي المتحركة بدخول المصعد أو الخروج منه بأمان"
            ],
            [
                "Question_EN" => "Does the elevator have a handrail?",
                "Description_EN" => "A handrail provides balance and stability for all users",
                "Question_AR" => "هل المصعد لديه درابزين?",
                "Description_AR" => "يوفر الدرابزين التوازن والاستقرار لجميع المستخدمين"
            ],
            [
                "Question_EN" => "Does the elevator have audible announcements?",
                "Description_EN" => "A spoken announcement that announces when a floor is reached to help people who can not see or read the numbers",
                "Question_AR" => "هل المصعد لديه إعلانات مسموعة?",
                "Description_AR" => "إعلان منطوق يعلن عند الوصول إلى أرضية لمساعدة الأشخاص الذين لا يستطيعون رؤية أو قراءة الأرقام"
            ],
            [
                "Question_EN" => "Staircases",
                "Description_EN" => "NULL",
                "Question_AR" => "السلالم",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are there any staircases for use by public?",
                "Description_EN" => "A staircase is a row of steps that can be used by public to travel up and down floors",
                "Question_AR" => "هل هناك سلالم للاستخدام من قبل العامة?",
                "Description_AR" => "الدرج عبارة عن صف من الخطوات التي يمكن للجمهور استخدامها للسفر صعودًا ونزولًا"
            ],
            [
                "Question_EN" => "Are any staircases spiral or curved?",
                "Description_EN" => "Curved or spiral staircases can cause movement problems for some people",
                "Question_AR" => "هل هناك سلالم حلزونية أو منحنية?",
                "Description_AR" => "يمكن أن تتسبب السلالم المنحنية أو الحلزونية في مشاكل في الحركة لبعض الأشخاص"
            ],
            [
                "Question_EN" => "Are any staircases have open riser steps?",
                "Description_EN" => "With open riser stairs, the riser – the vertical space between adjacent treads – is open, rather than enclosed",
                "Question_AR" => "هل يوجد في أي سلالم خطوات مفتوحة?",
                "Description_AR" => "مع السلالم المفتوحة ، يكون الناهض – المساحة العمودية بين المداس المجاور – مفتوحة ، بدلاً من إغلاقها"
            ],
            [
                "Question_EN" => "Do all staircases have handrails?",
                "Description_EN" => "A handrail is provided for balance and stability of all users. The upper handrail should be between 875mm - 925mm from floor",
                "Question_AR" => "هل تحتوي جميع السلالم على درابزين?",
                "Description_AR" => "يتم توفير الدرابزين لتحقيق التوازن والاستقرار لجميع المستخدمين. يجب أن يكون الدرابزين العلوي بين 875 مم - 925 مم من الأرض"
            ],
            [
                "Question_EN" => "Are the handrails at two heights?",
                "Description_EN" => "An upper and lower handrail is provided for people at all heights or in wheelchairs. The lower handrail should be between 600mm - 750mm from floor",
                "Question_AR" => "هل الدرابزين على ارتفاعين?",
                "Description_AR" => "يتم توفير الدرابزين العلوي والسفلي للأشخاص في جميع المرتفعات أو في الكراسي المتحركة. يجب أن يكون الدرابزين السفلي بين 600 مم - 750 مم من الأرض"
            ],
            [
                "Question_EN" => "Are the edge of steps a different colour so can be clearly seen?",
                "Description_EN" => "A step edge (or nosing) that is different in colour and texture to the rest of surface can help people with poor sight to identify the edge of step easier",
                "Question_AR" => "هل حافة الخطوات لون مختلف بحيث يمكن رؤيتها بوضوح?",
                "Description_AR" => "يمكن أن تساعد حافة الخطوة (أو الأنف) المختلفة في اللون والملمس على بقية السطح الأشخاص ذوي البصر الضعيف على تحديد حافة الخطوة بشكل أسهل"
            ],
            [
                "Question_EN" => "Do any stairs have more than 12 steps in a row?",
                "Description_EN" => "Stairs with more than 12 steps in a row can be difficult for slow walkers or people with mobility restrictions",
                "Question_AR" => "هل يحتوي أي درج على أكثر من 12 خطوة متتالية?",
                "Description_AR" => "يمكن أن يكون الدرج الذي يحتوي على أكثر من 12 خطوة متتالية صعبًا على المشاة البطيئين أو الأشخاص الذين يعانون من قيود التنقل"
            ],
            [
                "Question_EN" => "Is there a landing rest area every 12 steps?",
                "Description_EN" => "A level landing area is a place for walkers to rest when using stairs. The length should be at least 1.5m help",
                "Question_AR" => "هل هناك منطقة استراحة للهبوط كل 12 خطوة?",
                "Description_AR" => "منطقة الهبوط المستوية هي مكان للراحة عند استخدام السلالم. يجب أن يكون الطول 1.5 متر على الأقل من المساعدة"
            ],
            [
                "Question_EN" => "Sanitary Facilities",
                "Description_EN" => "NULL",
                "Question_AR" => "المرافق الصحية",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are toilets provided for public to use?",
                "Description_EN" => "State if there are any toilet facilities for public to use",
                "Question_AR" => "هل يتم توفير المراحيض للجمهور لاستخدامها?",
                "Description_AR" => "اذكر إذا كان هناك أي مرافق مرحاض للاستخدام العام"
            ],
            [
                "Question_EN" => "Are disabled toilets provided?",
                "Description_EN" => "A toilet only to be used by disabled people",
                "Question_AR" => "هل يتم توفير دورات مياة لذوي الإحتياجات الخاصة ؟",
                "Description_AR" => "دورات مياة فقط لإستخدامه من قبل ذوي الاحتياجات "
            ],
            [
                "Question_EN" => "What type of disabled toilets are provided?",
                "Description_EN" => "NULL",
                "Question_AR" => "ما نوع المراحيض المعطلة المقدمة?",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Disabled Washroom",
                "Description_EN" => "NULL",
                "Question_AR" => "دورة مياة معطلة",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the entrance door of washroom over 850mm in width?",
                "Description_EN" => "Measure opening width when door fully opened help",
                "Question_AR" => "هل باب مدخل الحمام يزيد عرضه عن 850 مم?",
                "Description_AR" => "قياس عرض الفتح عند فتح الباب بالكامل"
            ],
            [
                "Question_EN" => "Is there a clear floor space in washroom of 2.1m diameter when door open?",
                "Description_EN" => "A clear space is required for wheelchair users to turn around within room. Ensure a circle shape of 2.1m diameter is completely clear",
                "Question_AR" => "هل هناك مساحة أرضية واضحة في الحمام بقطر 2.1 م عندما يفتح الباب?",
                "Description_AR" => "مطلوب مساحة واضحة لمستخدمي الكراسي المتحركة للاستدارة داخل الغرفة. تأكد من أن شكل دائرة بقطر 2.1 م واضح تمامًا"
            ],
            [
                "Question_EN" => "Are grab rails provided beside toilet in the washroom?",
                "Description_EN" => "Grab rails allow people to transfer, rise and lower themselves at the toilet. Grab rails should be provided on both sides and rear of a toilet area",
                "Question_AR" => "هل يتم توفير سكك الإمساك بجانب المرحاض في الحمام?",
                "Description_AR" => "تسمح قضبان الإمساك للأشخاص بنقل أنفسهم ونهوضهم وخفضهم في المرحاض. يجب توفير سكك الإمساك على كلا الجانبين وخلف منطقة المرحاض"
            ],
            [
                "Question_EN" => "Is an emergency alarm provided in washroom?",
                "Description_EN" => "An emergency alarm may be a low level strip around bottom edge of room or provided as a pull cord. The alarm will alert people if anyone needs help help",
                "Question_AR" => "هل يتم توفير إنذار الطوارئ في الحمام?",
                "Description_AR" => "قد يكون إنذار الطوارئ عبارة عن شريط منخفض المستوى حول الحافة السفلية للغرفة أو يتم توفيره كسلك سحب. سوف ينبه المنبه الناس إذا احتاج أي شخص للمساعدة"
            ],
            [
                "Question_EN" => "Is a roll under sink provided in washroom?",
                "Description_EN" => "A roll under sink allows wheelchair users to position themselves underneath the sink and reach faucets easier help",
                "Question_AR" => "هل يتم توفير لفة تحت الحوض في الحمام?",
                "Description_AR" => "تسمح اللفة تحت الحوض لمستخدمي الكراسي المتحركة بوضع أنفسهم تحت الحوض والوصول إلى الحنفيات بسهولة"
            ],
            [
                "Question_EN" => "Can faucets be operated by elbow?",
                "Description_EN" => "A long handle faucet allows users to operate water by using elbow help",
                "Question_AR" => "هل يمكن تشغيل الحنفيات بواسطة الكوع?",
                "Description_AR" => "يسمح صنبور مقبض طويل للمستخدمين بتشغيل المياه باستخدام مساعدة الكوع"
            ],
            [
                "Question_EN" => "Disabled Stall within a Washroom",
                "Description_EN" => "NULL",
                "Question_AR" => "كشك معطل داخل الحمام",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Is the main washroom door width over 850mm?",
                "Description_EN" => "Measure opening width when door fully opened help",
                "Question_AR" => "هل عرض باب الحمام الرئيسي يزيد عن 850 مم?",
                "Description_AR" => "قياس عرض الفتح عند فتح الباب بالكامل"
            ],
            [
                "Question_EN" => "Is the stall door width over 850mm?",
                "Description_EN" => "Measure opening width when stall door fully opened help",
                "Question_AR" => "هل عرض باب المماطلة أكثر من 850 مم?",
                "Description_AR" => "قياس عرض الفتح عند فتح باب المماطلة بالكامل"
            ],
            [
                "Question_EN" => "Is the overall stall size over 1800mm by 1800mm?",
                "Description_EN" => "Measure the width and length of the stall help",
                "Question_AR" => "هل حجم المماطلة الكلي يزيد عن 1800 مم × 1800 مم?",
                "Description_AR" => "قياس عرض وطول المماطلة يساعد"
            ],
            [
                "Question_EN" => "Is there a clear transfer space of 900mm by 1400mm when door open?",
                "Description_EN" => "A clear space is required to allow for transfer from wheelchair help",
                "Question_AR" => "هل هناك مساحة نقل واضحة 900 مم × 1400 مم عند فتح الباب?",
                "Description_AR" => "مطلوب مساحة واضحة للسماح بالنقل من مساعدة الكراسي المتحركة"
            ],
            [
                "Question_EN" => "Are grab rails provided beside toilet in the stall?",
                "Description_EN" => "Grab rails allow people to transfer, rise and lower themselves at the toilet. Grab rails should be provided on both sides and rear of a toilet area",
                "Question_AR" => "هل يتم توفير سكك الإمساك بجانب المرحاض في المماطلة?",
                "Description_AR" => "تسمح قضبان الإمساك للأشخاص بنقل أنفسهم ونهوضهم وخفضهم في المرحاض. يجب توفير سكك الإمساك على كلا الجانبين وخلف منطقة المرحاض"
            ],
            [
                "Question_EN" => "Is an emergency alarm provided in the stall?",
                "Description_EN" => "An emergency alarm may be a low level strip around bottom edge of stall or provided as a pull cord. The alarm will alert people if anyone needs help help",
                "Question_AR" => "هل يتم توفير إنذار الطوارئ في المماطلة?",
                "Description_AR" => "قد يكون إنذار الطوارئ عبارة عن شريط منخفض المستوى حول الحافة السفلية للمماطلة أو يتم توفيره كسلك سحب. سوف ينبه المنبه الناس إذا احتاج أي شخص للمساعدة"
            ],
            [
                "Question_EN" => "Are all wash facilities provided at lower height for wheelchair users in stall?",
                "Description_EN" => "Are all wash facilities provided at lower height for wheelchair users in stall?",
                "Question_AR" => "هل يتم توفير جميع مرافق الغسيل على ارتفاع أقل لمستخدمي الكراسي المتحركة في المماطلة?",
                "Description_AR" => "هل يتم توفير جميع مرافق الغسيل على ارتفاع أقل لمستخدمي الكراسي المتحركة في المماطلة?"
            ],
            [
                "Question_EN" => "Is a roll under sink provided in stall?",
                "Description_EN" => "A roll under sink allows wheelchair users to position themselves underneath the sink and reach faucets easier help",
                "Question_AR" => "هل يتم توفير لفة تحت الحوض في المماطلة?",
                "Description_AR" => "تسمح اللفة تحت الحوض لمستخدمي الكراسي المتحركة بوضع أنفسهم تحت الحوض والوصول إلى الحنفيات بسهولة"
            ],
            [
                "Question_EN" => "Can faucets be operated by elbow in the stall?",
                "Description_EN" => "A long handle faucet allows users to operate water by using elbow help",
                "Question_AR" => "هل يمكن تشغيل الحنفيات بواسطة الكوع في المماطلة?",
                "Description_AR" => "يسمح صنبور مقبض طويل للمستخدمين بتشغيل المياه باستخدام مساعدة الكوع"
            ],
            [
                "Question_EN" => "Office Room Layout",
                "Description_EN" => "NULL",
                "Question_AR" => "تخطيط غرفة المكتب",
                "Description_AR" => ""
            ],
            [
                "Question_EN" => "Are there any open plan rooms within office?",
                "Description_EN" => "An open plan room is where multiple desks and workstations are located where a movement circulation route is determined by layout of desks",
                "Question_AR" => "هل هناك غرف مفتوحة داخل المكتب?",
                "Description_AR" => "توجد غرفة ذات مخطط مفتوح حيث توجد مكاتب ومحطات عمل متعددة حيث يتم تحديد مسار دوران الحركة من خلال تخطيط المكاتب"
            ],
            [
                "Question_EN" => "Are all circulation routes within open plan room over 1.2m in width?",
                "Description_EN" => "Measure width of floor from one wall to the other side",
                "Question_AR" => "هل جميع طرق التداول داخل غرفة مفتوحة يزيد عرضها عن 1.2 متر?",
                "Description_AR" => "قياس عرض الأرضية من جدار إلى آخر جانب"
            ],
            [
                "Question_EN" => "Do the circulation routes have any floor objects that reduce the width below 1.2m?",
                "Description_EN" => "Measure width of floor from one wall to the edge of obstruction",
                "Question_AR" => "هل تحتوي طرق الدوران على أي أجسام أرضية تقلل العرض إلى أقل من 1.2 متر?",
                "Description_AR" => "قياس عرض الأرضية من جدار واحد إلى حافة الانسداد"
            ],
            [
                "Question_EN" => "Are there any overhead obstructions below 2.1m in the circulation routes?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل هناك أي عوائق علوية أقل من 2.1 متر في طرق التداول?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Are there any meeting rooms within office?",
                "Description_EN" => "An open plan room is where multiple desks and workstations are located where a movement circulation route is determined by layout of desks",
                "Question_AR" => "هل هناك أي قاعات اجتماعات داخل المكتب?",
                "Description_AR" => "توجد غرفة ذات مخطط مفتوح حيث توجد مكاتب ومحطات عمل متعددة حيث يتم تحديد مسار دوران الحركة من خلال تخطيط المكاتب"
            ],
            [
                "Question_EN" => "Is there a circulation path of a minimum 900mm around perimeter of the meeting room?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل هناك مسار تداول لا يقل عن 900 مم حول محيط غرفة الاجتماعات?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Are there any individual office rooms?",
                "Description_EN" => "An open plan room is where multiple desks and workstations are located where a movement circulation route is determined by layout of desks",
                "Question_AR" => "هل هناك غرف مكتب فردية?",
                "Description_AR" => "توجد غرفة ذات مخطط مفتوح حيث توجد مكاتب ومحطات عمل متعددة حيث يتم تحديد مسار دوران الحركة من خلال تخطيط المكاتب"
            ],
            [
                "Question_EN" => "Is there a circulation path of a minimum 900mm to front and rear of the desk?",
                "Description_EN" => "An open plan room is where multiple desks and workstations are located where a movement circulation route is determined by layout of desks",
                "Question_AR" => "هل هناك مسار تداول لا يقل عن 900 مم إلى الأمام والخلف من المكتب?",
                "Description_AR" => "توجد غرفة ذات مخطط مفتوح حيث توجد مكاتب ومحطات عمل متعددة حيث يتم تحديد مسار دوران الحركة من خلال تخطيط المكاتب"
            ],
            [
                "Question_EN" => "Is there a refreshment room for staff to use?",
                "Description_EN" => "An open plan room is where multiple desks and workstations are located where a movement circulation route is determined by layout of desks",
                "Question_AR" => "هل هناك غرفة مرطبات ليستخدمها الموظفون?",
                "Description_AR" => "توجد غرفة ذات مخطط مفتوح حيث توجد مكاتب ومحطات عمل متعددة حيث يتم تحديد مسار دوران الحركة من خلال تخطيط المكاتب"
            ],
            [
                "Question_EN" => "Are roll under counters provided in refreshment room?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل يتم توفير لفة تحت العدادات في غرفة المرطبات?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Are the facilities within reach of wheelchair users in refreshment room?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل المرافق في متناول مستخدمي الكراسي المتحركة في غرفة المرطبات?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Is there a kitchen for staff to use?",
                "Description_EN" => "An open plan room is where multiple desks and workstations are located where a movement circulation route is determined by layout of desks",
                "Question_AR" => "هل يوجد مطبخ للموظفين لاستخدامه?",
                "Description_AR" => "توجد غرفة ذات مخطط مفتوح حيث توجد مكاتب ومحطات عمل متعددة حيث يتم تحديد مسار دوران الحركة من خلال تخطيط المكاتب"
            ],
            [
                "Question_EN" => "Are roll under counters provided in kitchen?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل يتم توفير لفة تحت العدادات في المطبخ?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Are the facilities within reach of wheelchair users in kitchen?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل المرافق في متناول مستخدمي الكراسي المتحركة في المطبخ?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ],
            [
                "Question_EN" => "Is there a clear turning circle of 2.1m diameter in the kitchen?",
                "Description_EN" => "An overhead object is an obstruction if it reduces headroom of aisles below 2.1m",
                "Question_AR" => "هل هناك دائرة دوران واضحة قطرها 2.1 م في المطبخ?",
                "Description_AR" => "الجسم العلوي هو عائق إذا قلل من مساحة الممرات أقل من 2.1 م"
            ]
        ];


    }
}
