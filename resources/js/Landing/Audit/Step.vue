<template>
    <div class="steps-label my-5">
        <div class="container-lg">
            <label class="mb-1">{{ __('audit.Step') }} {{ Number($route.params.step) + 2 }} {{ __('audit.of') }} 7</label>
            <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" :style="'width: '+(14.2 * Number($route.params.step) + 28.57)+'%'"></div>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle "></i></li>
                    <li><i :class="['fa-solid','fa-circle',$route.params.step == 1 ? 'active' : '']"></i></li>
                    <li><i :class="['fa-solid','fa-circle',$route.params.step == 2 ? 'active' : '']"></i></li>
                    <li><i :class="['fa-solid','fa-circle',$route.params.step == 3 ? 'active' : '']"></i></li>
                    <li><i :class="['fa-solid','fa-circle',$route.params.step == 4 ? 'active' : '']"></i></li>
                    <li><i :class="['fa-solid','fa-circle',$route.params.step == 5 ? 'active' : '']"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="steps step-1 py-5 loader-container">
        <div class="loader-in-above-div" v-if="loading">
            <div class="loader"></div>
        </div>
        <div class="container">
            <form class="buildings">
                <template v-for="(question,index) in questions">
                    <Title v-if="question.web_id == '1001'" :title="question"></Title>
                    <Title
                        v-if="question.web_id == '1014' && (answers.question1002 && answers.question1002.includes('Ramp'))"
                        :title="question"></Title>
                    <Title
                        v-if="question.web_id == '1022' && (answers.question1002 && answers.question1002.includes('Stairs'))"
                        :title="question"></Title>
                    <Title
                        v-if="question.web_id == '1026' && (answers.question1002 && answers.question1002.includes('Single step'))"
                        :title="question"></Title>
                    <Title
                        v-if="question.web_id == '1028' && (answers.question1002 && answers.question1002.includes('Drop to side'))"
                        :title="question"></Title>
                    <Title v-if="question.web_id == '1'" :title="question"></Title>
                    <Title v-if="question.web_id == '2'" :title="question"></Title>
                    <Title
                        v-if="question.web_id == '3' && (answers.question18 == 'yes' || answers.question13 == '1 or more')"
                        :title="question"></Title>
                    <Title v-if="question.web_id == '4'" :title="question"></Title>
                    <Title
                        v-if="question.web_id == '36' && (answers.question35 && answers.question35.includes('Ramp in route'))"
                        :title="question"></Title>
                    <Title
                        v-if="question.web_id == '313' && (answers.question35 && answers.question35.includes('Stairs in route'))"
                        :title="question"></Title>
                    <Title
                        v-if="question.web_id == '317' && (answers.question35 && answers.question35.includes('Single step in route'))"
                        :title="question"></Title>
                    <Title
                        v-if="question.web_id == '319' && (answers.question35 && answers.question35.includes('Drop to side of route'))"
                        :title="question"></Title>

                    <QuestionYesNo v-if="question.web_id == '11'" :question="question"></QuestionYesNo>
                    <QuestionSelectBox v-if="question.web_id == '12' && answers.question11 == 'yes'"
                                       :question="question"></QuestionSelectBox>

                    <QuestionInput v-if="question.web_id == '13' && answers.question12 == '1-50'"
                                   :question="question"></QuestionInput>
                    <QuestionYesNo
                        v-if="question.web_id == '18' && answers.question12 != '1-50' && answers.question12 != '' && answers.question12 != null"
                        :question="question"></QuestionYesNo>
                    <QuestionInput
                        v-if="question.web_id == '120' && answers.question12 == '51-100' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '121' && answers.question12 == '101-200' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '122' && answers.question12 == '201-300' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '123' && answers.question12 == '301-500' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '124' && answers.question12 == '501-600' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '125' && answers.question12 == '601-700' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '126' && answers.question12 == '701-800' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '127' && answers.question12 == '801-900' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '128' && answers.question12 == '901-1000' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '129' && answers.question12 == '1001-1100' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionInput
                        v-if="question.web_id == '130' && answers.question12 == '1101-1200' && answers.question18 == 'yes'"
                        :question="question"></QuestionInput>
                    <QuestionYesNo
                        v-if="question.web_id == '131' && answers.question12 == 'over 1200' && answers.question18 == 'yes'"
                        :question="question"></QuestionYesNo>
                    <QuestionMultipleChoice
                        v-if="question.web_id == '14' && (answers.question18 == 'yes' || answers.question13 == '1 or more')"
                        :question="question"></QuestionMultipleChoice>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '15' && (answers.question18 == 'yes' || answers.question13 == '1 or more')"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '16' && (answers.question18 == 'yes' || answers.question13 == '1 or more')"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '17' && (answers.question18 == 'yes' || answers.question13 == '1 or more')"
                        :question="question"></QuestionYesNoWithImage>


                    <QuestionYesNoWithImage v-if="question.web_id == '21'" :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage v-if="question.web_id == '22' && answers.question21 == 'yes'"
                                            :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage v-if="question.web_id == '23' && answers.question21 == 'yes'"
                                            :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage v-if="question.web_id == '24' && answers.question23 == 'yes'"
                                            :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNo
                        v-if="question.web_id == '31' && (answers.question18 == 'yes' || answers.question13 == '1 or more') "
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '32' && (answers.question18 == 'yes' || answers.question13 == '1 or more') "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '33' && (answers.question18 == 'yes' || answers.question13 == '1 or more') "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '34' && (answers.question18 == 'yes' || answers.question13 == '1 or more') "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionMultipleChoice
                        v-if="question.web_id == '35' && (answers.question18 == 'yes' || answers.question13 == '1 or more') "
                        :question="question"></QuestionMultipleChoice>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '37' && (answers.question35 && answers.question35.includes('Ramp in route')) "
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionInput style="float: left;width: 49%"
                                   v-if="question.web_id == '38' && (answers.question35 && answers.question35.includes('Ramp in route')) "
                                   :question="question"></QuestionInput>
                    <QuestionInput style="float: right;width: 49%" classes="clearfix"
                                   v-if="question.web_id == '39' && (answers.question35 && answers.question35.includes('Ramp in route')) "
                                   :question="question"></QuestionInput>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '311' && (answers.question35 && answers.question35.includes('Ramp in route')) "
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNo
                        v-if="question.web_id == '312' && (Number(answers.question38) >= 1000 ) && answers.question35 && answers.question35.includes('Ramp in route') "
                        :question="question"></QuestionYesNo>

                    <QuestionYesNoWithImage
                        v-if="question.web_id == '314' && (answers.question35 && answers.question35.includes('Stairs in route')) "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '315' && (answers.question35 && answers.question35.includes('Stairs in route')) "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '316' && (answers.question35 && answers.question35.includes('Stairs in route')) "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '318' && (answers.question35 && answers.question35.includes('Single step in route')) "
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '320' && (answers.question35 && answers.question35.includes('Drop to side of route')) "
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '41'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '42' && answers.question41 == 'no'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '43' && answers.question41 == 'no'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '44' && answers.question41 == 'no'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '45' && answers.question41 == 'no'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionMultipleChoice
                        v-if="question.web_id == '46' && answers.question41 == 'no'"
                        :question="question"></QuestionMultipleChoice>
                    <Title
                        v-if="question.web_id == '5' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></Title>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '51' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionInput style="float: left;width: 49%"
                                   v-if="question.web_id == '52' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                                   :question="question"></QuestionInput>
                    <QuestionInput style="float: right;width: 49%" classes="clearfix"
                                   v-if="question.web_id == '53' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                                   :question="question"></QuestionInput>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '54' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '55' && Number(answers.question52) >= 1000 && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '58' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '59' && Number(answers.question52) >= 1  && Number(answers.question52) >= 41 && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '56' && Number(answers.question52) >= 1  && Number(answers.question52) >= 41 && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '57' && Number(answers.question52) >= 1  && Number(answers.question52) >= 41 && (answers.question56) == 'yes' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Ramp in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <Title
                        v-if="question.web_id == '6' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Stairs in path'))"
                        :title="question"></Title>

                    <QuestionYesNoWithImage
                        v-if="question.web_id == '61' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Stairs in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '62' && answers.question61 == 'yes' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Stairs in path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '63' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Stairs in path'))"
                        :title="question"></QuestionYesNoWithImage>

                    <Title
                        v-if="question.web_id == '7' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Single step in path'))"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '71' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('StairsSingle step in path in path'))"
                        :title="question"></QuestionYesNo>

                    <Title
                        v-if="question.web_id == '8' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Drop to side of path'))"
                        :title="question"></Title>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '81' && answers.question41 == 'no' && (answers.question46 && answers.question46.includes('Drop to side of path'))"
                        :title="question"></QuestionYesNoWithImage>
                    <QuestionMultipleChoice
                        v-if="question.web_id == '1002'"
                        :question="question"></QuestionMultipleChoice>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1003'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1004'"
                        :question="question"></QuestionYesNo>
                    <QuestionMoreThanTwoOption
                        v-if="question.web_id == '1005'"
                        :question="question"></QuestionMoreThanTwoOption>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1006' && (answers.question1005 == 'Manual swing door' || answers.question1005 == 'Automatic swing door' || answers.question1005 == 'Button operated swing door')"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1007' && (answers.question1005 == 'Manual sliding door' || answers.question1005 == 'Automatic sliding door' || answers.question1005 == 'Button operated sliding door' || answers.question1005 == 'Manual revolving door' || answers.question1005 == 'Automatic revolving door')"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1009'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1010'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1011' && answers.question1009 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1012'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1013' && answers.question1012 == 'yes'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1015' &&  (answers.question1002 && answers.question1002.includes('Ramp'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionInput style="float: left;width: 49%"
                                   v-if="question.web_id == '1016' &&  (answers.question1002 && answers.question1002.includes('Ramp'))"
                                   :question="question"></QuestionInput>
                    <QuestionInput style="float: right;width: 49%" classes="clearfix"
                                   v-if="question.web_id == '1017' &&  (answers.question1002 && answers.question1002.includes('Ramp'))"
                                   :question="question"></QuestionInput>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1018' &&  (answers.question1002 && answers.question1002.includes('Ramp'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1019' && Number(answers.question1016) >= 1000 && (answers.question1002 && answers.question1002.includes('Ramp'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1020' && Number(answers.question1017) >= 41 && (answers.question1002 && answers.question1002.includes('Ramp'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1021' && Number(answers.question1017) >= 81 && (answers.question1002 && answers.question1002.includes('Ramp'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1023' && (answers.question1002 && answers.question1002.includes('Stairs'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1024' && answers.question1023 == 'yes' && (answers.question1002 && answers.question1002.includes('Stairs'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1025' && (answers.question1002 && answers.question1002.includes('Stairs'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1027' && (answers.question1002 && answers.question1002.includes('Single step'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNo
                        v-if="question.web_id == '1029' && (answers.question1002 && answers.question1002.includes('Drop to side'))"
                        :question="question"></QuestionYesNo>

                    <Title
                        v-if="question.web_id == '1030'"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1031'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNo
                        v-if="question.web_id == '1032'  && answers.question1031 == 'yes'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNo
                        v-if="question.web_id == '1033'  && answers.question1031 == 'yes'"
                        :question="question"></QuestionYesNo>

                    <Title
                        v-if="question.web_id == '1034'"
                        :title="question"></Title>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1035'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1036'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1037'"
                        :question="question"></QuestionYesNoWithImage>

                    <Title
                        v-if="question.web_id == '1038'"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1039'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1040' && answers.question1039 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1041' && answers.question1039 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1042' && answers.question1039 == 'yes'"
                        :question="question"></QuestionYesNo>


                    <Title
                        v-if="question.web_id == '1043'"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1044'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1045'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1046'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1047'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1048' && answers.question1047 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1049'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1050'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1051' && answers.question1050 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>

                    <Title
                        v-if="question.web_id == '1052'"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1053'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNo
                        v-if="question.web_id == '1054' && answers.question1053 == 'yes'"
                        :question="question"></QuestionYesNo>

                    <QuestionMultipleChoice
                        v-if="question.web_id == '1055' && answers.question1053 == 'yes'"
                        :question="question"></QuestionMultipleChoice>
                    <Title
                        v-if="question.web_id == '1056' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1057' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1058' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1059' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1060' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1061' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1062' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Disabled washroom'))"
                        :question="question"></QuestionYesNo>

                    <Title
                        v-if="question.web_id == '1063' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1064' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNo
                        v-if="question.web_id == '1065' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNo
                        v-if="question.web_id == '1066' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1067' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1068' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1069' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1070' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1071' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNo
                        v-if="question.web_id == '1072' && answers.question1053 == 'yes' &&  (answers.question1055 && answers.question1055.includes('Stall within washroom'))"
                        :question="question"></QuestionYesNo>

                    <Title
                        v-if="question.web_id == '1073'"
                        :title="question"></Title>
                    <QuestionYesNo
                        v-if="question.web_id == '1074'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1075' && answers.question1074 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1076' && answers.question1074 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1077' && answers.question1074 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNo
                        v-if="question.web_id == '1078'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1079' && answers.question1078 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNo
                        v-if="question.web_id == '1080'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1081' && answers.question1080 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNo
                        v-if="question.web_id == '1082'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1083' && answers.question1082 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1084' && answers.question1082 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>

                    <QuestionYesNo
                        v-if="question.web_id == '1085'"
                        :question="question"></QuestionYesNo>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1086' && answers.question1085 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1087' && answers.question1085 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                    <QuestionYesNoWithImage
                        v-if="question.web_id == '1088' && answers.question1085 == 'yes'"
                        :question="question"></QuestionYesNoWithImage>
                </template>
            </form>
            <div class="d-grid gap-2 col-md-6 mx-auto mt-4 d-flex btns-form">
                <router-link :to="prev_link"
                             class="btn btn-secondary w-100 d-flex align-content-center justify-content-center rounded-0"
                             style="align-items: center;" type="button">
                    <i class="fa-solid fa-circle-chevron-left me-1"></i> {{ __('audit.Previous') }}
                </router-link>
                <button @click="register" v-if="$route.params.step < 5" class="btn btn-success w-100 rounded-0" type="button">{{ next_link_text }} <i
                    class="fa-solid fa-circle-chevron-right"></i></button>
                <button @click="finish" v-if="$route.params.step == 5" class="btn btn-success w-100 rounded-0" type="button">{{ next_link_text }} <i
                    class="fa-solid fa-circle-chevron-right"></i></button>
            </div>
            <a class="btn btn-outline-dark btn-sm mt-4" @click="register($event,true)" href="#"><i
                class="fa-solid fa-cloud-arrow-up"></i> {{ __('audit.Save and Continue Later') }}
                </a>

        </div>
    </section>


</template>

<script>
import Title from "./Questions/Title.vue";
import QuestionYesNo from "./Questions/QuestionYesNo.vue";
import QuestionYesNoWithImage from "./Questions/QuestionYesNoWithImage.vue";
import QuestionMultipleChoice from "./Questions/QuestionMultipleChoice.vue";
import QuestionSelectBox from "./Questions/QuestionSelectBox.vue";
import QuestionInput from "./Questions/QuestionInput.vue";
import QuestionMoreThanTwoOption from "./Questions/QuestionMoreThanTwoOption.vue";

import emitter from "../../emitter";

export default {
    components: {
        Title,
        QuestionYesNo,
        QuestionYesNoWithImage,
        QuestionMultipleChoice,
        QuestionSelectBox,
        QuestionInput,
        QuestionMoreThanTwoOption
    },
    data() {
        return {
            questions: [],
            answers: {
                update_request_id: '',
                building_type_id: this.$route.params.type,
                step_id: this.$route.params.step,
            },

            request_id: '',
            prev_link: '',
            next_link: '',
            selected_type: '',
            next_link_text: this.$route.params.step == 5 ? this.$root.__('audit.Finishing Audit') : this.$root.__('audit.Next') ,
            loading: false,
        }
    },
    watch: {
        '$route'(to, from) {
            window.scrollTo(0, 0);

            console.log(to, from)
            if (window.localStorage.getItem('request_id')) {
                this.request_id = window.localStorage.getItem('request_id');
            }
            this.get_items();
            this.generate_prev_link();
            this.generate_next_link();
            this.next_link_text = this.$route.params.step == 5 ? this.$root.__('audit.Finishing Audit') : this.$root.__('audit.Next')
            this.render_tooltip()

        },
    },
    async mounted() {
        window.scrollTo(0, 0);

        if (window.localStorage.getItem('request_id')) {
            this.request_id = window.localStorage.getItem('request_id');
        }

        await this.get_items();
        this.generate_prev_link();
        this.generate_next_link();

    },
    methods: {
        get_items() {
            this.loading = true;
            axios.get('/landing/audit/questions?building_type_id=' + this.$route.params.type + '&step_id=' + this.$route.params.step + '&request_id=' + this.request_id).then((response) => {
                this.loading = false;
                this.questions = response.data.questions;
                console.log(this.questions);
                this.define_answer_events();
                this.render_tooltip()
            })
        },
        register($event,save_continue_later = false) {
            // this.loading = true;
            this.answers.update_request_id = window.localStorage.getItem('request_id');
            axios.post('/landing/audit/answer?save_continue_later=' + (save_continue_later), this.answers).then((response) => {
                this.loading = false;

                if (!save_continue_later)
                    this.$router.push({
                        path: this.next_link, replace: true
                    })
            }).catch((error) => {
                this.answers.errors = error.response.data.errors
            })
        },
        finish() {

            this.answers.update_request_id = window.localStorage.getItem('request_id');
            axios.post('/landing/audit/finish', this.answers).then((response) => {
                this.loading = false;
                window.localStorage.removeItem('request_id')
                    this.$router.push({
                        path: '/audit/completed', replace: true
                    })
            }).catch((error) => {
                this.answers.errors = error.response.data.errors
            })
        },
        define_answer_events() {
            for (let i = 0; i < this.questions.length; i++) {
                if (this.questions[i].type === 'question') {
                    emitter.$on('question' + (this.questions[i].web_id) + '-answer', (answer) => {
                        // console.log(answer)
                        setTimeout(function () {
                            this.render_tooltip()
                        }.bind(this), 100)
                        this.answers['question' + (this.questions[i].web_id)] = answer;
                        this.answers['questionId' + (this.questions[i].question_id)] = answer;
                        // for (let j = 0; j < this.answers.questions.length; j++) {
                        //     if (this.answers.questions[j].question_id == this.questions[i].question_id)
                        // }
                        // this.answers.questions.push({id:this.questions[i].question_id,'answer':answer}) ;
                        //
                        // console.log(this.answers)
                    });
                }
            }
        },
        generate_prev_link() {
            if (this.$route.params.step == '1') {
                this.prev_link = '/audit/building-types/' + this.$route.params.type + '/register-info'
            } else {
                this.prev_link = '/audit/building-types/' + this.$route.params.type + '/step/' + (Number(this.$route.params.step) - 1)
            }
        },
        generate_next_link() {
            if (this.$route.params.step == 5) {
                this.next_link = '/audit/building-types/' + this.$route.params.type + '/finish'
            } else {
                this.next_link = '/audit/building-types/' + this.$route.params.type + '/step/' + (Number(this.$route.params.step) + 1)
            }
        },
        render_tooltip() {
           setTimeout(function () {
               const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
               const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
           },50)
        },
        showError(error) {
            let message_title = error.response.data.message + '\n';
            let message = message_title;
            let errors = error.response.data.errors;
            $.each(errors, function (key, val) {
                $.each(val, function (key2, val2) {
                    message += val2 + '\n'
                });
            });
            this.notify("error", message, 'fas fa-times p-1', 'danger')
        },

    }
}
</script>
