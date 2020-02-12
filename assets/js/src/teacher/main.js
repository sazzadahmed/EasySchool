

$('#create_exam').click(() => {

let exam_class = $('#exam_class').val();
let exam_session = $('#exam_session').val();
let exam_program = $('#exam_program').val();
let subject = $('#select_course_id').val();
let activeSemester = null;
if( exam_class && exam_session && exam_program && subject)
{
    $.ajax({
        url: "view_active_semester.php",
        method:"POST",
        data:{
          session: exam_session,
          cls: exam_class,
          grp: exam_program,
          course_code: subject,
        },
        datatype:"text",
        success:function(data){      
            activeSemester = data;

            switch(data){
                case '1':
                    $('#exam_semester').text('1st Year 1st Semester');
                    break;
                case '2':
                    $('#exam_semester').text('1st Year 2nd Semester');
                    break;
                case '3':
                    $('#exam_semester').text('1st Year Final');
                    break;
                case '4':
                    $('#exam_semester').text('2nd Year 1st Semester');
                    break;
                case '5':
                    $('#exam_semester').text('2nd Year 2nd Semester');
                    break;
                case '6':
                    $('#exam_semester').text('2nd Year Final');
                    break;
                default:
                    alert('This semester is no longer active');
                    return;
                                  

            }
            $('#exam_create_container').show();
        }
    
      });
}



   
});



$('.teacher_active').click((e) => {

    $('#practical_mark_label').hide();
    $('#practical_mark').hide();

    if(dataPopulatedOrNot()) {
        return;
    } 
        hideALlExamSection()
        let activeExam = e.target.id;
        if(activeExam == 'exam_type_quiz')
        {
            $('#quiz_section').show(); 
        }
        else if(activeExam == 'exam_type_ct') {
            $('#ct_section').show(); 
        }
        else if(activeExam == 'exam_type_mid_tern') {
            $('#mid_section').show(); 
        }
        else if(activeExam == 'exam_type_attendance') {
            $('#attendance_section').show(); 
        }
        else
        {
            let examFinalOrNot =  $('#exam_semester').text();
            if(examFinalOrNot == '1st Year Final' || examFinalOrNot == '2nd Year Final')
            {
                $('#practical_mark_label').show();
                $('#practical_mark').show();
            }
            $('#final_section').show(); 
        }

        $('#'+activeExam).addClass('teacher_selected_exam');
        
});


function hideALlExamSection()
{
    $('#quiz_section ,#ct_section, #mid_section, #final_section, #attendance_section').hide();

    if($('.teacher_active').hasClass('teacher_selected_exam')) {
        $('.teacher_active').removeClass('teacher_selected_exam');
    }


}


function dataPopulatedOrNot() {
    let dataArr = $("input");
    for(let i = 0; i< dataArr.length; i++)
    {
         if($('#'+dataArr[i].id).val().length)
         {
            alert('Save or Cancel the Existing Exam');
            $('#'+dataArr[i].id).focus();
            return true;
         }  
    }
    return false;
}


function dismissALlField()
{
    $("input").val('');
}

$('.cansel_create_exam').click(() => {
    dismissALlField()
});

$('#exam_create_container').hide();
hideALlExamSection();


function saveExam() {

let session = $('#exam_session').val();
let cls = $('#exam_class').val();
let grp = $('#exam_program').val();
let course_code = $('#select_course_id').val();
let examId = $('.teacher_selected_exam')[0].id;
let mark ='';
let written_mark = '';
let mcq_mark = '';
let practical_mark = null;
let typeOfExam;


if(examId == 'exam_type_quiz')
{
    typeOfExam = 1;
    mark = $('#quiz_mark').val();
}
else if(examId == 'exam_type_ct'){
    typeOfExam = 2;
    mark = $('#ct_mark').val();
}
else if(examId == 'exam_type_mid_tern') {
    typeOfExam = 3;
    written_mark = $('#mark_mid_term_written').val();
    mcq_mark = $('#mark_mid_term_mcq').val();
}
else if(examId == 'exam_type_attendance') {
    typeOfExam = 5;
    mark = $('#attendance_mark').val();
    
}
else{
    typeOfExam = 4;
    written_mark = $('#mark_final_term_written').val();
    mcq_mark = $('#mark_final_term_mcq').val();
    practical_mark = $('#mark_final_term_practical').val();

    
}

if(!(mark || (written_mark && mcq_mark))) {
alert('Insert data please');
return;
}



$.ajax({
    url: "set_exam.php",
    method:"POST",
    data:{
      session: session,
      cls: cls,
      grp: grp,
      course_code: course_code,
      typeOfExam: typeOfExam,
      mark: mark,
      written_mark: written_mark,
      mcq_mark: mcq_mark,
      practical_mark:practical_mark
    },
    datatype:"text",
    success:function(data){
        console.log(data);
      if(data == 'success')
      {
          alert('Exam is created successfully');
          dismissALlField();
          hideALlExamSection();

      }
    }

  });
}

$('.ok_create_exam').click(() => {
    saveExam();
});



$('#view_exam_list').click(() => {
    let session = $('#exam_session').val();
    let cls = $('#exam_class').val();
    let grp = $('#exam_program').val();
    let course_code = $('#select_course_id').val();
    let typeOfExam = $("#select_exam_type").val();
    
    $.ajax({
        url: "view_examp.php",
        method:"POST",
        data:{
          session: session,
          cls: cls,
          grp: grp,
          course_code: course_code,
          typeOfExam: typeOfExam,
        },
        datatype:"text",
        success:function(data){      
            let jsonResporse = phpPrinterObjectToJson(data);
            let htmlContent = '';


            let cnt = 0;
            jsonResporse.forEach((dt) => {
                cnt = cnt + 1;

                let examType = '';
                if(dt.type == 1) {
                     examType = 'Quiz';
                }
                if(dt.type == 2) {
                     examType = 'CT';
                }
                if(dt.type == 3) {
                     examType = 'Mid';
                }
                if(dt.type == 4) {
                     examType = 'Final';
                }
               let adminOrNot = window.location.href.indexOf('admin');
           if(adminOrNot == -1) {
            htmlContent = htmlContent + '<tr><td>'+ examType+' '+ cnt + '</td><td><a class ="btn btn-success" href ="exam_mark_entry.php?id='+ dt.id+'">Mark Entry</a></td></tr>';
          
           }
           else
           {
            htmlContent = htmlContent + '<tr><td>'+ examType+' '+ cnt + '</td></tr>';
          
           }
           
           
            });
            $('#exam_list_body').html(htmlContent);
        }
    
      });
    
});


function findingSingleArrayDataResponse(responseData) {

let arrResponse = [];
let stFlag = -1;
let endFlag = -1;

for(let i = 0 ;i<responseData.length; i++)
{
    if(responseData[i] == '(') {
        stFlag = i;
    }
    if(responseData[i]== ')')
    {
        endFlag = i;
        let sbStr = responseData.substr(stFlag+1,endFlag-stFlag-1).trim();
        arrResponse.push(sbStr);;

    }
}
return arrResponse;

}



function ProcessSingleArrayResponse(responseData)
{
    let singleObjectResponse = new Object();
    let data = responseData.split('\n');
    data.forEach((dt) => {
        let ass_str = dt.trim();
        let ass_key_value = ass_str.split('=>');
        let stratIndex = ass_key_value[0].indexOf('[');
        let lastIndex = ass_key_value[0].indexOf(']');
        let key = ass_key_value[0].substr(stratIndex+1, lastIndex-stratIndex -1).trim();
        let value = ass_key_value[1].trim();
        singleObjectResponse[key] = value;


    });
  //  console.log(singleObjectResponse);
    return singleObjectResponse;

}

function phpPrinterObjectToJson(responseData)
{

    let objectResponse = [];

    let arrysResponse = findingSingleArrayDataResponse(responseData);
   // console.log(arrysResponse);

    arrysResponse.forEach((dt)=> {

        objectResponse.push( ProcessSingleArrayResponse(dt));
    });

    return objectResponse;

}



function mark_entry_intial_call()
{
    let exam_id = $('#exam_id_mark_entry').text().trim();
    let exam_type = null;
    let semester = null;
    let mcqOutOfMark = null;
    let writtenOutOfMark = null;
    let PracticalOutOfMark = null;
    let markOutOf = null;

    $.ajax({
        url: "mark_entry_ajax.php",
        method:"POST",
        datatype:"text",
        data:{
           id: exam_id,
           flag: 1
          },
        success:function(data){
            let jsonResponse = phpPrinterObjectToJson(data);
            console.log(data);
            let htmlContent = '';
            jsonResponse.forEach((dt) => {
                exam_type = dt.type;
                semester = dt.semester;
                mcqOutOfMark = dt.mcq;
                writtenOutOfMark = dt.written;
                PracticalOutOfMark = dt.practical;
                markOutOf = dt.mark


               
            });

         

        }
    
      });



    $.ajax({
        url: "mark_entry_ajax.php",
        method:"POST",
        datatype:"text",
        data:{
           id: exam_id,
          },
        success:function(data){
            let jsonResponse = phpPrinterObjectToJson(data);
           

            let htmlContent = '';
            let htmlHeaderContent = '';
            $('#typesOfExam').text(exam_type);
            $('#exam_semester').text(semester);

            if(exam_type == 1 || exam_type == 2 || exam_type == 5 ) {

                    if(exam_type == 5)
                    {
                        htmlHeaderContent = htmlHeaderContent +'<tr id =><th>S_ID</th><th>Number of Attendance</th><th>Total Class</th><th id="attendance_mar_out_of">Mark';
                        if($('#max_exam_mark').text())  htmlHeaderContent = htmlHeaderContent +'('+ $('#max_exam_mark').text() +')';
                        htmlHeaderContent = htmlHeaderContent+'</th><th>Action</th></tr>';
                    }
                    else
                    {
                        htmlHeaderContent = htmlHeaderContent +'<tr id =><th>S_ID</th><th>Mark'+(markOutOf)+'</th> <th>Absent</th><th>Action</th></tr>';
         
                    }

               }
            else
            {
                if(exam_type != 4)
                {
                    htmlHeaderContent = htmlHeaderContent +'<tr><th>S_ID</th> <th>MCQ Mark('+mcqOutOfMark+')</th> <th>Written Mark('+writtenOutOfMark+')</th> <th>Absent</th><th>Action</th></tr>';

                }
                else
                {
                    htmlHeaderContent = htmlHeaderContent +'<tr><th>S_ID</th> <th>MCQ Mark('+mcqOutOfMark+')</th> <th>Written Mark('+writtenOutOfMark+')</th><th>Practical Mark('+Number(PracticalOutOfMark)+')</th> <th>Absent</th><th>Action</th></tr>';

                }
                
            }

            $('#mark_entry_table').html(htmlHeaderContent);
            jsonResponse.forEach((dt) => {
                if(exam_type == 1 || exam_type == 2 || exam_type == 5) {
                  
                    if(exam_type == 5)
                    {
                        htmlContent = htmlContent + '<tr id = "row'+dt.s_id+'"><td id = "s_id'+dt.s_id+'">'+ dt.s_id +'</td><td><input onchange ="calculateAttedance(this)" type="number" id= "attendance_count_'+dt.s_id+'" /></td><td><input type="input" id= "total_class_count_'+dt.s_id+'" onchange = "changeTolalAttendance(this)"></td><td><input type = "number" id ="attendance_mark_'+dt.s_id+'"></td><td><button class="btn btn-success" id = "btn_btn'+dt.s_id+'" onclick="saveExamButton('+dt.s_id+')">Save</button><td></tr>';
            
                    }
                    else {
                        htmlContent = htmlContent + '<tr id = "row'+dt.s_id+'"><td id = "s_id'+dt.s_id+'">'+ dt.s_id +'</td><td><input type="number" id= "mark'+dt.s_id+'"/></td><td><input type="checkbox" id= "ch'+dt.s_id+'" onchange = changeAbsentCB('+dt.s_id+')></td><td><button class="btn btn-success" id = "btn_btn'+dt.s_id+'" onclick="saveExamButton('+dt.s_id+')">Save</button><td></tr>';
            
                    }
                       }
                else
                {
                    if(exam_type != 4)
                    {
                        htmlContent = htmlContent + '<tr id = "row'+dt.s_id+'"><td id = "s_id'+dt.s_id+'">'+ dt.s_id +'</td><td><input type="number" id= "mcq'+dt.s_id+'"/></td><td><input type="text" id= "written'+dt.s_id+'"/></td><td><input type="checkbox" id= "ch'+dt.s_id+'"  onchange = changeAbsentCB('+dt.s_id+')></td><td><button class="btn btn-success" id = "btn_save'+dt.s_id+'" onclick="saveExamButton('+dt.s_id+')">Save</button><td></tr>';
               
                    }
                    else
                    {
                        htmlContent = htmlContent + '<tr id = "row'+dt.s_id+'"><td id = "s_id'+dt.s_id+'">'+ dt.s_id +'</td><td><input type="number" id= "mcq'+dt.s_id+'"/></td><td><input type="text" id= "written'+dt.s_id+'"/></td><td><input type="number" id="practical'+dt.s_id+'"></td><td><input type="checkbox" id= "ch'+dt.s_id+'"  onchange = changeAbsentCB('+dt.s_id+')></td><td><button class="btn btn-success" id = "btn_save'+dt.s_id+'" onclick="saveExamButton('+dt.s_id+')">Save</button><td></tr>';
               
                    }
                    }
               
               
            });

            $('#mark_entry_table_body').html(htmlContent);

        }
    
      });



}

if(Number($('#exam_id_mark_entry').text().trim())){
    mark_entry_intial_call();
}


function saveExamButton(id) {
    let s_id = id;
    let typeOfExam = Number($('#typesOfExam').text().trim());
    let examId = Number($('#exam_id_mark_entry').text().trim());
    let mcq = 0;
    let written = 0;
    let practicalMark = 0;
    let mark = 0;
    let isAbsent = false;

    if(typeOfExam == 1 || typeOfExam  == 2 || typeOfExam  == 5) {
        if(typeOfExam == 5)
        {
            mark = Number($('#attendance_mark_'+s_id).val());
        }
        else
        {
            mark = Number($('#mark'+s_id).val());
        }
        

    }
    else{
        mcq = Number($('#mcq'+ s_id).val());
        written = Number($('#written'+ s_id).val());
        if(typeOfExam == 4)
        {
            practicalMark = Number($('#practical'+ s_id).val());
        }

    }

    isAbsent = $('#ch'+s_id).is(':checked');



    $.ajax({
        url: "save_exam_mark.php",
        method:"POST",
        datatype:"text",
        data:{
            s_id: s_id,
            typeOfExam: typeOfExam,
            examId: examId,
            mcq: mcq,
            written: written,
            mark: mark,
            isabsent:isAbsent,
            practical:practicalMark
          },
        success:function(data){
            alert(data);
        }
    
      });
  

}


function changeAbsentCB(s_id) {
    if($('#ch'+s_id).is(':checked')) {
        $('#mcq'+ s_id).val(null);
        $('#written'+ s_id).val(null);
        $('#mark'+ s_id).val(null);
        $('#mcq'+ s_id).prop('readonly',true);
        $('#written'+ s_id).prop('readonly',true);
        $('#mark'+ s_id).prop('readonly',true);
        $('#row'+s_id).css('background-color','#dddddd');
    }
    else {
        $('#mcq'+ s_id).prop('readonly',false);
        $('#written'+ s_id).prop('readonly',false);
        $('#mark'+ s_id).prop('readonly',false);
        $('#row'+s_id).css('background-color','#f5f5f5');
    }
   
}



function findAllMarkoOfSpecficExam()
{

    let examId = Number($('#exam_id_mark_entry').text().trim());

    $.ajax({
        url: "getall_exam_mark.php",
        method:"POST",
        datatype:"text",
        data:{
            examId: examId,
          },
        success:function(data){
            phpPrinterObjectToJson(data).forEach((dt) => {

                    if(dt.type == 1 ||dt.type == 2) {
                        $('#mark'+dt.s_id).val(dt.mark);

                    }else {
                        $('#written'+dt.s_id).val(dt.written);
                        $('#mcq'+dt.s_id).val(dt.mcq);
                    }
                  

                    if(dt.isabsent && dt.isabsent == "1") {
                        $('#ch'+dt.s_id).prop('checked',true);
                    }
                    else {
                        $('#ch'+dt.s_id).prop('checked',false);
                    }
                });

        }
    
      });

}
findAllMarkoOfSpecficExam();



// prepare exam section start

function prepareResult(){
    let session = $('#exam_session').val();
    let cls = $('#exam_class').val();
    let grp = $('#exam_program').val();
    let course_code = $('#select_course_id').val();
// for admin paenl the teacher id should come from form 
// this should be handle by js

$.ajax({
    url: "prepare_result_data_ajax.php",
    method:"POST",
    data:{
      session: session,
      cls: cls,
      grp: grp,
      course_code: course_code,
    },
    datatype:"text",
    success:function(data){      
        let jsonResporse = phpPrinterObjectToJson(data);
       
        
        let studentsList = [];
        let findExamType = [];
        let quizList = [];
        let ctList = [];
        let midList = [];
        let finalList = [];
        let attList = [];
        jsonResporse.forEach((dt) =>{

            if(findExamType.indexOf(dt['exam_type']) == -1){
                findExamType.push(dt['exam_type']);
            }

            if(studentsList.indexOf(dt['s_id']) == -1){
                studentsList.push(dt['s_id']);
            }

            if(dt['exam_type'] == "1")
            {
                quizList.push(dt);
            }
            if(dt['exam_type'] == "2")
            {
                ctList.push(dt);
            }
            if(dt['exam_type'] == "3")
            {
                midList.push(dt);
            }
            if(dt['exam_type'] == "4")
            {
                finalList.push(dt);
            }
            if(dt['exam_type'] == "5")
            {
                attList.push(dt);
            }
           
        });


        // console.log(quizList);
        // console.log(ctList);
        // console.log(midList);
        // console.log(finalList);



        let tableHeaderCell = [];

        let htmlContentheader = ''; 
        let subheaderHtmlContent = '';

        let exam_arr = [];
        let quiz_arr = [];
        let ct_arr = [];
        let mid_arr = [];
        let fin_arr = [];
        let att_arr = [];
        let quiz_max,ct_max,mid_max,fin_max,att_max_mark;


        findExamType.forEach((dt)=> {
            let definateTypearr = jsonResporse.filter( (dd)=> { return dd.exam_type == dt;} );
        
            if(dt == '1' || dt == '2'|| dt == '5') {
                if(dt == '1')
                {
                  
                    
                    definateTypearr.forEach(dd => {
                        if(quiz_arr.indexOf(dd.exam_id) == -1){
                            quiz_arr.push(dd.exam_id);
                            quiz_max = Number(dd.exam_max_mark);
                        }
                    });
                }
                else if(dt == '2')
                {
                  
                    definateTypearr.forEach(dd => {
                        if(ct_arr.indexOf(dd.exam_id) == -1){
                            ct_arr.push(dd.exam_id);
                            ct_max = Number(dd.exam_max_mark);
                        }
                    });
                }
                else
                {
                    definateTypearr.forEach(dd => {
                    if(att_arr.indexOf(dd.exam_id) == -1){
                        att_arr.push(dd.exam_id);
                        att_max_mark = Number(dd.exam_max_mark);
                    }
                    });
                }
               
            }
            else
            {

                if(dt == '3')
                {
                  

                    definateTypearr.forEach(dd => {
                        if(mid_arr.indexOf(dd.exam_id) == -1){
                            mid_arr.push(dd.exam_id);
                            mid_max = Number( quiz_max = Number(dd.exam_max_mcq)) + Number(dd.exam_written_mark);
                        }
                    });
                  
                }
                else
                {
                  
                    definateTypearr.forEach(dd => {
                        if(fin_arr.indexOf(dd.exam_id) == -1){
                            fin_arr.push(dd.exam_id);
                            fin_max = Number( quiz_max = Number(dd.exam_max_mcq)) + Number(dd.exam_written_mark);
                        
                        }
                    });
                  
                }
            }
        });

        if(quiz_arr.length>0)
        {
            htmlContentheader = htmlContentheader + '<th>Student Id</th><th><span  id = "quiz_header">QUIZ</span><input type="text" id="quiz_percent"  style="width: 66px;position: absolute;"></th><th></th>';
            subheaderHtmlContent = subheaderHtmlContent + '<th></th>';
            for(let i = 0; i< quiz_arr.length-1; i++){
                htmlContentheader = htmlContentheader + '<th></th>';
                subheaderHtmlContent = subheaderHtmlContent + '<th>Q-'+(i+1)+'</th>';
            }
            subheaderHtmlContent = subheaderHtmlContent + '<th>Q-'+(quiz_arr.length)+'</th><th>A/T</th><th>Q/F</th><td></td>';
            htmlContentheader = htmlContentheader + '<th></th><th></th>';
        }

        if(ct_arr.length>0)
        {
            htmlContentheader = htmlContentheader + '<th ><span  id = "ct_header">Class Test</span><input type="text" id="ct_percent"  style="width: 66px;position: absolute;"></th><th></th>';
            for(let i = 0; i< ct_arr.length-1; i++){
                htmlContentheader = htmlContentheader + '<th></th>';
                subheaderHtmlContent = subheaderHtmlContent + '<th>CT-'+(i+1)+'</th>';
            }
            subheaderHtmlContent = subheaderHtmlContent + '<th>CT-'+(ct_arr.length)+'</th><th>A/T</th><th>CT/F</th><td></td>';
            htmlContentheader = htmlContentheader + '<th></th><th></th>';
        }



        if(mid_arr.length>0)
        {
            htmlContentheader = htmlContentheader + '<th><span  id = "mid_header">Mid</span><input type="text" id="mid_percent"  style="width: 66px;position: absolute;"></th><th></th>';
            subheaderHtmlContent = subheaderHtmlContent + '<th>MCQ</th><th>Written</th><th>Total</th><th>M/F</th><td></td>';
            for(let i = 0; i< mid_arr.length; i++){
                htmlContentheader = htmlContentheader + '<th></th><th></th>';
              
            }
            htmlContentheader = htmlContentheader + '<th></th>';
        }
        if(fin_arr.length>0)
        {
            htmlContentheader = htmlContentheader + '<th><span  id = "fin_header">Fin</span><input type="text" id ="fin_percent" style="width: 66px;position: absolute;" onchnge="percentageFieldChange()"></th><th></th><th></th>';
            subheaderHtmlContent = subheaderHtmlContent + '<th>MCQ</th><th>Written</th><th>Practicle</th><th>Total</th><th>F/F</th><td></td>';
            for(let i = 0; i< fin_arr.length; i++){
                htmlContentheader = htmlContentheader + '<th></th><th></th>';
            }
           
        }

        htmlContentheader = htmlContentheader + '<th>Attendance</th><th>Total</th></tr>';
        let body_text = '';



        let oneStudentData = [];

    
       
        studentsList.forEach(dt => {
            oneStudentData = dt;
            body_text = body_text + '<tr id="row_s_id_'+dt+'"><td>'+dt+'</td>';
            let isMarkExist = false;
            let quiz_avg_mark = 0;
            let student_data;
            let cnt = 1;
            quiz_arr.forEach(dd => {               
                let s_data = quizList.filter( dj => {
                    return dj.s_id == dt && dj.exam_id == dd;
                });

                if(s_data[0]){
                body_text = body_text + '<td id="q'+cnt+'_'+dt+'">'+s_data[0].getting_mark+'</td>';
                cnt = cnt + 1;
                quiz_avg_mark =  quiz_avg_mark + Number(s_data[0].getting_mark);
                isMarkExist = true;
                student_data = s_data[0];
                }

            });
            
           

            if(isMarkExist)
            {
                body_text = body_text + '<td id = "dataqt_'+student_data.s_id+'">'+(quiz_avg_mark/(quiz_arr.length))+'</td><td id = "qf_'+student_data.s_id+'"></td><td></td>';
            }
            isMarkExist = false;
            let ct_avg_mark = 0;
            cnt = 1;
            ct_arr.forEach(dd => {

               isMarkExist = true;

                let s_data = ctList.filter( dj => {
                    return dj.s_id == dt && dj.exam_id == dd;
                });
                if(s_data[0]){
                body_text = body_text + '<td id= ct'+cnt+'_'+s_data[0].s_id+'>'+s_data[0].getting_mark+'</td>';
                ct_avg_mark = ct_avg_mark +Number(s_data[0].getting_mark);
                student_data = s_data[0];
                cnt++;
                }
            });

         
            if(isMarkExist)
            {
                body_text = body_text + '<td id = "datact_'+student_data.s_id+'">'+(ct_avg_mark/ct_arr.length)+'</td><td id ="ctf_'+student_data.s_id+'"></td><td></td>';
            }
            isMarkExist = false;

            mid_arr.forEach(dd => {
               

                let s_data = midList.filter( dj => {
                    return dj.s_id == dt && dj.exam_id == dd;
                });
                student_data = s_data[0];
                if(s_data[0]){
                    body_text = body_text + '<td id="mid_mcq_'+dt+'">' + s_data[0].getting_mcq_mark +'</td>'+ '<td id ="mid_written_'+dt+'">'+ s_data[0].getting_written_mark + '</td><td id="datamt_'+student_data.s_id+'">'+ (Number(s_data[0].getting_mcq_mark) + Number(s_data[0].getting_written_mark) )+'</td><td id = "mf_'+s_data[0].s_id+'"></td><td></td>';
                
                }
               

            });
          
            isMarkExist = false;
            
            fin_arr.forEach(dd => {
               

                let s_data = finalList.filter( dj => {
                    return dj.s_id == dt && dj.exam_id == dd;
                });

                if(s_data[0]){
                   
                   if(student_data) body_text = body_text + '<td id ="fin_mcq_'+dt+'">' + s_data[0].getting_mcq_mark +'</td>'+ '<td id="_fin_written_'+dt+'">'+ s_data[0].getting_written_mark + '</td><td id="_fin_practical_'+dt+'">'+ s_data[0].prac + '</td><td id ="dataft_'+student_data.s_id+'">'+ (Number(s_data[0].getting_mcq_mark) + Number(s_data[0].getting_written_mark) + Number(s_data[0].prac) )+'</td><td  id = "ff_'+s_data[0].s_id+'"></td>';             

                }
               
            });

            att_arr.forEach(dd => {
               

                let s_data = attList.filter( dj => {
                    return dj.s_id == dt && dj.exam_id == dd;
                });


                if(s_data[0]){
                    body_text = body_text + '<td id ="atten_'+s_data[0].s_id+'">' + s_data[0].getting_mark +'</td>';             

                }
              
            });
if(student_data){
    body_text = body_text + '<td id="finalall_'+student_data.s_id+'">--</td></tr>';
}

          

        });

        $('#exam_list_header').html(htmlContentheader);
        $('#exam_result_subheader').html(subheaderHtmlContent);
        $('#exam_list_body').html(body_text);

        if(quiz_arr.length > 0)
        {
            let text = $('#quiz_header').text();
            text = text + '('+quiz_max+')';
            $('#quiz_header').text(text);
        }

        if(ct_arr.length > 0)
        {
            let text = $('#ct_header').text();
            text = text + '('+ct_max+')';
            $('#ct_header').text(text);
        }

        if(mid_arr.length > 0)
        {
            let text = $('#mid_header').text();
            text = text + '(' + mid_max + ')';
            $('#mid_header').text(text);
        }

        if(fin_arr.length > 0)
        {
            let text = $('#fin_header').text();
            text = text + ' ('+ fin_max +')';
            $('#fin_header').text(text);
        }
      

        $('#fin_percent,#mid_percent,#quiz_percent,#ct_percent').on('change',()=>{
            CalculatFinalResult();
        })

        $('#save_exam_result').show();
    }

  });
}


$('#prepare_result, #seatPlan').click( (e) => {
    let session = $('#exam_session').val();
    let cls = $('#exam_class').val();
    let grp = $('#exam_program').val();
    let course_code = $('#select_course_id').val();


    if(session && cls && grp && course_code)
    {
        if(e.target.id == 'prepare_result'){
            prepareResult();
        }
        else
        {
            prepareSeatPlan();
        }
      
    }
    else
    {
        alert('Select the Field Currectly');
    }
  
});



function CalculatFinalResult()
{
let quiz_percent = Number($('#quiz_percent').val());
let ct_percent = Number($('#ct_percent').val());
let mid_percent = Number($('#mid_percent').val());
let fin_percent = Number($('#fin_percent').val());



// calculating quiz section

let quizArr = $("[id ^='dataqt_']");
let size = quizArr.length;
let quiz_max = filterMax($('#quiz_header').text());


for(let i = 0;i<size; i++){
    let id = quizArr[i].id;
    let st_id = id.substr('dataqt_'.length);
    let totalValue = Number($('#'+id).html());
    let quiz_per = Number($('#quiz_percent').val());
    let qF = ((totalValue / quiz_max)*quiz_per).toFixed(2);
    $('#qf_'+st_id).html(qF);
    
}
// end calculation quiz section



// calculating quiz section

let ctArr = $("[id ^='datact_']");
 size = ctArr.length;
 let ct_max = filterMax($('#ct_header').text());
for(let i = 0;i<size; i++){
    let id = ctArr[i].id;
    st_id = id.substr('datact_'.length);
    let totalValue = Number($('#'+id).html());

    let ct_per = Number($('#ct_percent').val());
    let qF = ((totalValue / ct_max)*ct_per).toFixed(2);
    $('#ctf_'+st_id).html(qF);
  
}
// end calculation ct section

// calculating mid section

let midArr = $("[id ^='datamt_']");
 size = midArr.length;
 let mid_max = filterMax($('#mid_header').text());

for(let i = 0;i<size; i++){
    let id = midArr[i].id;
    st_id = id.substr('datamt_'.length);
    let totalValue = Number($('#'+id).html());

    let mid_per = Number($('#mid_percent').val());
    let mF = ((totalValue / mid_max)*mid_per).toFixed(2);
    $('#mf_'+st_id).html(mF);
 
}
// end calculation mid section


// calculating mid section

let finArr = $("[id ^='dataft_']");
let fin_max = filterMax($('#mid_header').text());
 size = finArr.length;

for(let i = 0;i<size; i++){
    let id = finArr[i].id;
    st_id = id.substr('dataft_'.length);
    let totalValue = Number($('#'+id).html());

    let fin_per = Number($('#fin_percent').val());
    let fF = ((totalValue / fin_max) * fin_per).toFixed(2);
    $('#ff_'+st_id).html(fF);
    
}
// end calculation mid section


calculatingFinal()



}



function filterMax(str) {
    let data = '';
    flag = false;
    flag1 = false;
    for(let i = 0; i<str.length; i++){
        if(str[i] == '(')
        {
            flag = true;
            continue;
        }

        if(str[i] == ')')
        {
            return Number(data);

        }

        if(flag)
        {
            data = data + str[i];
        }
    }
    return 0;
}



function calculatingFinal()
{
    let allData = $('[ id ^= "finalall_"]');

    for(let i = 0; i<allData.length; i++)
    {
        let s_id = allData[i].id.substr('finalall_'.length);


        let qf = Number($('#qf_'+s_id).text());
        let ctf = Number($('#ctf_'+s_id).text());
        let mf = Number($('#mf_'+s_id).text());
        let ff = Number($('#ff_'+s_id).text());
        let att_mark = Number($('#atten_'+s_id).text());
        $('#finalall_'+s_id).html((qf+ctf+mf+ff + att_mark).toFixed(2));
    }
}


function calculateAttedance(data) {
    let dataVal = $('#'+data.id).val();
    let s_id = data.id.substr('attendance_count_'.length);
    let p = "";
    if(dataVal != "")
    {
        p = (Number(dataVal)/Number($('#total_class_count_'+s_id).val()))*(Number($('#max_exam_mark').text()));
    }
    else
    {
        p = "";
    }
    $('#attendance_mark_'+s_id).val(p);
}


function changeTolalAttendance(data) {
    let value = data.value;

    $('[id ^= "total_class_count_" ]').val(value);
}

function save_exam_result()
{
    let tr = $('tbody tr');
    let rowData = [];
    for(let i = 0; i<tr.size(); i++) {
        rowData.push(prepareSaveResultData(tr[i].innerHTML));
        

    }
    let studentList = [];
    let sData = $('[id ^= "row_s_id"]');
    for(let i = 0; i<sData.size(); i++) {
        studentList.push(sData[i].id.substr('row_s_id_'.length));
    }

    let course_id = $('#select_course_id').val();
    let session_id = $('#exam_session').val();

   

        $.ajax({
            url: "save_course_result.php",
            method:"POST",
            datatype:"text",
            data:{
             
                course_id: course_id,
                session: session_id,
                 s_id: studentList,
                 data : rowData,
    
              },
            success:function(data){
               console.log('Data Saved Successfully');
    
            }
        
          });
}





function prepareSaveResultData(data)
{

    let returndata = '{';
    let splitedData = data.split('</td>');
    let s_id ='_';
    splitedData.forEach((dt) => {
        dt = dt.trim().substr(3);
        let dd = dt.trim().split('>');

   if(dd.length>1){

   
           if(dd[0] == "" && dd[1] != "")
           {
            returndata = returndata + 's_id:'+ dd[1] + "|";
            s_id = s_id + dd[1];
           }
           else if(dd[0] != "" && dd[1] != "")
           {
            returndata = returndata + dd[0] +':'+ dd[1] + "|";
           }
        }
        
        
    });
    returndata = returndata.replace(/id="/g, "").replace(new RegExp(s_id, "g"), "");
     returndata = returndata + '}';
     return returndata;

}

// prepare exam section end



//prepare seat plan here start

function prepareSeatPlan()
{
    let session = $('#exam_session').val();
    let cls = $('#exam_class').val();
    let grp = $('#exam_program').val();
    let course_code = $('#select_course_id').val();
    $.ajax({
        url: "prepare_seatplan_ajax.php",
        method:"POST",
        data:{
          session: session,
          cls: cls,
          grp: grp,
          course_code: course_code,
        },
        datatype:"text",
        success:function(data){      
            let jsonResporse = phpPrinterObjectToJson(data);
            cnt = 0;
            response = '';
            cntFlag = false;
            jsonResporse.forEach((dt) => {
                cntFlag = true;
               
                    response = response + '<tr style="border:1px solid #dddddd">';
                    response = response + '<td>'+dt['s_id']+'</td><th>'+dt['s_name']+'</th><th>A</th><th>Science</th><td>2019</td><td><input type = "text" style="max-width:100px;" id= "seat_rm_'+dt['s_id']+'" onchange="changeSeat(this)"></td><td><input type = "text" style="max-width:100px;" ></td></tr>';
               

            });
            if(cntFlag)  { response = response + '</tr>';}
            $('#seat_plan_id').html(response);
        }
    });
}


// prepare seat plan end



$('#view_salary').click(()=>{
    let session = $('#exam_session').val();
    let cls = $('#exam_class').val();
    let year = $('#year').val();
    let s_id = $('#s_id').val();

    if(!(session && cls && year && s_id)){
        alert('Insert data correctly');
        return;
    }

    
    $.ajax({
        url: "check_salary_students.php",
        method:"POST",
        datatype:"text",
        data:{

             s_id: s_id,
             year : year,

          },
        success:function(data){
           let respon = phpPrinterObjectToJson(data);

           console.log(respon);

           respon.forEach((dt)=>{
               console.log(dt.month);


               if(dt.month == '1'){
                    $('#jan').html('<button class="btn btn-success" onclick="viewSalaryDetail(1)">View Details</button>');
               }
               else if(dt.month == '2'){
                $('#feb').html('<button class="btn btn-success" onclick="viewSalaryDetail(2)">View Details</button>');
               }
               else if(dt.month == '3'){
                $('#mar').html('<button class="btn btn-success" onclick="viewSalaryDetail(3)">View Details</button>'); 
            }
            else if(dt.month == '4'){
                $('#apr').html('<button class="btn btn-success" onclick="viewSalaryDetail(4)">View Details</button>');
            }
            else if(dt.month == '5'){
                $('#may').html('<button class="btn btn-success" onclick="viewSalaryDetail(5)">View Details</button>');
            }
            else if(dt.month == '6'){
                $('#jun').html('<button class="btn btn-success" onclick="viewSalaryDetail(6)">View Details</button>');
            }
            else if(dt.month == '7'){
                $('#jul').html('<button class="btn btn-success" onclick="viewSalaryDetail(7)">View Details</button>');
            }
            else if(dt.month == '8'){
                $('#aug').html('<button class="btn btn-success" onclick="viewSalaryDetail(8)">View Details</button>');
            }
            else if(dt.month == '9'){
                $('#sep').html('<button class="btn btn-success" onclick="viewSalaryDetail(9)">View Details</button>');
            }
            else if(dt.month == '10'){
                $('#auc').html('<button class="btn btn-success" onclick="viewSalaryDetail(10)">View Details</button>');
            }
            else if(dt.month == '11'){
                $('#nov').html('<button class="btn btn-success" onclick="viewSalaryDetail(11)">View Details</button>'); 
            }
            else if(dt.month == '12'){
                $('#dec').html('<button class="btn btn-success" onclick="viewSalaryDetail(12)">View Details</button>');  
            }
           })
           $('#salary_paid_panel').show();

        }
    
      });

});



$('#view_salary_teacher').click(()=>{
    let t_id = $('#teacher').val();
    let year = $('#year').val();
    let status;
    if(window.location.href.indexOf('type=stuff') != -1)
    {
        status = '3';  
    }
    else
    {
        status = '2';
    }


    if(!(t_id &&year )){
        alert('Insert data correctly');
        return;
    }

    
    $.ajax({
        url: "check_salary_teacher.php",
        method:"POST",
        datatype:"text",
        data:{

            t_id: t_id,
             year : year,
             status: status

          },
        success:function(data){
            console.log(data);
           let respon = phpPrinterObjectToJson(data);

           respon.forEach((dt)=>{
    


               if(dt.month == '1'){
                    $('#jan').html('<button class="btn btn-success" onclick="viewSalaryDetail(1)">View Details</button>');
               }
               else if(dt.month == '2'){
                $('#feb').html('<button class="btn btn-success" onclick="viewSalaryDetail(2)">View Details</button>');
               }
               else if(dt.month == '3'){
                $('#mar').html('<button class="btn btn-success" onclick="viewSalaryDetail(3)">View Details</button>'); 
            }
            else if(dt.month == '4'){
                $('#apr').html('<button class="btn btn-success" onclick="viewSalaryDetail(4)">View Details</button>');
            }
            else if(dt.month == '5'){
                $('#may').html('<button class="btn btn-success" onclick="viewSalaryDetail(5)">View Details</button>');
            }
            else if(dt.month == '6'){
                $('#jun').html('<button class="btn btn-success" onclick="viewSalaryDetail(6)">View Details</button>');
            }
            else if(dt.month == '7'){
                $('#jul').html('<button class="btn btn-success" onclick="viewSalaryDetail(7)">View Details</button>');
            }
            else if(dt.month == '8'){
                $('#aug').html('<button class="btn btn-success" onclick="viewSalaryDetail(8)">View Details</button>');
            }
            else if(dt.month == '9'){
                $('#sep').html('<button class="btn btn-success" onclick="viewSalaryDetail(9)">View Details</button>');
            }
            else if(dt.month == '10'){
                $('#auc').html('<button class="btn btn-success" onclick="viewSalaryDetail(10)">View Details</button>');
            }
            else if(dt.month == '11'){
                $('#nov').html('<button class="btn btn-success" onclick="viewSalaryDetail(11)">View Details</button>'); 
            }
            else if(dt.month == '12'){
                $('#dec').html('<button class="btn btn-success" onclick="viewSalaryDetail(12)">View Details</button>');  
            }
           })
           $('#salary_paid_panel').show();

        }
    
      });

})




// salary panel end


function changeSeat(data)
{
    let dataval = $('#'+data.id).val();


    $.ajax({
        url: "find_room.php",
        method:"POST",
        datatype:"text",
        data:{

            rm_name: dataval,

          },
        success:function(dt){
            let respon = phpPrinterObjectToJson(dt);
            if(respon.length == 0)
            {
                alert('Room '+dataval+ 'is not exist');
            }
            else
            {  
                alert('Room '+ dataval + 'have ' + respon[0].capacity + ' capacity');
                let capacity = Number( respon[0].capacity);

               
                let s_id = data.id.substr("seat_rm_".length);
     
                 let roomData = $('input[id ^="seat_rm_"]');
                 for(let i = 0;i<Math.min(roomData.length,capacity); i++) {
                     let id = roomData[i].id;
                     let s_id_t = id.substr("seat_rm_".length);
                     if(s_id_t > s_id) {
                     $('#'+id).val(dataval);
             }
     
        

            }
           }
        }
    
      });



    
    
}


function viewSalaryDetail(month)
{
    let status;
    let session,e_id;
    let url = window.location.href;
    if(url.indexOf('type=teacher') != -1)
    {
        status = '2';
       e_id = $('#teacher').val(); 
    }

    if(url.indexOf('type=stuff') != -1)
    {
        status = '3';
        e_id = $('#teacher').val(); 
    }

    if(status == undefined)
    {
        status = '1';
        session = $('#exam_session').val();
        e_id = $('#s_id').val();
    }
    let year = $('#year').val();



    
    $.ajax({
        url: "view_salary_details.php",
        method:"POST",
        datatype:"text",
        data:{
            status: status,
            session: session,
            e_id: e_id,
            year: year,
            month: month



          },
        success:function(dt){
            let respon = phpPrinterObjectToJson(dt);

            let res_str = '';
            for(let i = 0; i<respon.length; i++)
            {
                if(i == 0)
                {
                    $('#salaray_detail_title').text('Salary Details of '+ getMonth(respon[i]['month'])+' - '+ respon[i]['year']);
                }
                res_str = res_str + '<tr>';
                res_str = res_str + '<td>'+respon[i]['date_of_payment']+'</td>';
                res_str = res_str + '<td>'+respon[i]['amount']+'</td>';
                res_str = res_str +'</tr>';

            }
            $('#salary_detail').html(res_str);
            
            $('#salary_detail_panel').show();
        }
    
      });




}



function getMonth(index)
{
    if(index == '1')
    {
        return 'Jan';
    }
    else if( index == '2')
    {
        return 'Feb'
    }
    else if( index == '3')
    {
        return 'Mar'
    }
    else if( index == '4')
    {
        return 'Apr'
    }
    else if( index == '5')
    {
        return 'May'
    }
    else if( index == '6')
    {
        return 'Jun'
    }
    else if( index == '7')
    {
        return 'Jul'
    }
    else if( index == '8')
    {
        return 'Aug'
    }
    else if( index == '9')
    {
        return 'Sep'
    }
    else if( index == '10')
    {
        return 'Oct'
    }
    else if( index == '11')
    {
        return 'Nov'
    }
    else if( index == '12')
    {
        return 'Dec'
    }

}