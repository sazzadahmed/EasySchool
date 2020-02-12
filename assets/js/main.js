function get_total(id) {

  var s_id = $("#s_id"+id).val();
  var sname = $("#same"+id).val();
  var attend = $("#attend"+id).val();
  var ct = $("#ct"+id).val();
  var quiz = $("#quiz"+id).val();
  var assignment = $("#assignment"+id).val();
  var presentation = $("#presentation"+id).val();
  var final_exam = $("#final_exam"+id).val();
  var absent = $("#absent"+id).val();
  var sum = (1*attend)+(1*ct)+(1*quiz)+(1*assignment)+(1*presentation)+(1*final_exam);
  var data1 = sum.toFixed(1);
  
  var color="green";
  $("#total"+id).val(data1);

  if(data1 >= 80 && data1 <= 100) { 
    $("#gpa"+id).val("4.00");
    $("#grade"+id).val("A+");
  } else if(data1 >= 75 && data1 <= 79) { 
    $("#gpa"+id).val("3.75");
    $("#grade"+id).val("A");
  } else if(data1 >= 70 && data1 <= 74) { 
    $("#gpa"+id).val("3.50");
    $("#grade"+id).val("A-");
  } else if(data1 >= 65 && data1 <= 69) { 
    $("#gpa"+id).val("3.25");
    $("#grade"+id).val("B+");
  } else if(data1 >= 60 && data1 <= 64) { 
    $("#gpa"+id).val("3.00");
    $("#grade"+id).val("B");
  } else if(data1 >= 55 && data1 <= 59) { 
    $("#gpa"+id).val("2.75");
    $("#grade"+id).val("C+");
  } else if(data1 >= 50 && data1 <= 54) { 
    $("#gpa"+id).val("2.50");
    $("#grade"+id).val("C");
  } else if(data1 >= 45 && data1 <= 49) { 
    $("#gpa"+id).val("2.25");
    $("#grade"+id).val("D+");
  } else if(data1 >= 40 && data1 <= 44) { 
    $("#gpa"+id).val("2.00");
    $("#grade"+id).val("D");
  } else {
    $("#gpa"+id).val("0.00");
    $("#grade"+id).val("F");
  }

}

function insert_data(id) {

  let sss = '';

  var sid = $(".id"+id).val();
  var s_id = $(".s_id"+id).val();
  var attend = $(".attend"+id).val();
  var ct = $(".ct"+id).val();
  var quiz = $(".quiz"+id).val();
  var assignment = $(".assignment"+id).val();
  var presentation = $(".presentation"+id).val();
  var final_exam = $(".final_exam"+id).val();
  var absent = $(".absent"+id).val();
  var sum = (1*attend)+(1*ct)+(1*quiz)+(1*assignment)+(1*presentation)+(1*final_exam);
  var data1 = sum.toFixed(1);
  var color="green";
  $(".total"+id).val(data1);

     var gpa = $(".gpa"+id).val();
     var lg = $(".grade"+id).val();

     var sem= $("#select_section_sem").val();
     //var year= $("#year"+id).val();
     var course= $("#select_course_id").val();

     var saveBT = $("#save_button"+id).val();


     

//var saveB=saveBT+id;
    
    //alert(saveBT);
    //alert(s_id);
    //alert(attend);
    //alert(ct);
    //alert(quiz);
    //alert(assignment);
    //alert(presentation);
    //alert(final_exam);
    
    //alert(year);
    

    $.ajax({
    method:'POST',
    url:'modify_marks_records.php',
    data:{
    saveData:saveBT,
    row_sid: s_id,
    row_attend:attend,
    row_ct:ct,
    row_quiz:quiz,
    row_assignment:assignment,
    row_presentation:presentation,
    row_final_exam:final_exam,
    row_data1:data1,  
    row_gpa:gpa,
    row_lg: lg,
    row_ab: absent,
    row_co: color,
    row_sem:sem,
    //row_year:year,
    row_course:course
    },
    success:function(response) {
      console.log(response);
      if(response=="success") {
          alert("Data Inserted Succesfully");
        $(msg).hide(3000);
      } else {
        alert("Data not Inserted");
      }
    }
  });

}


function getCourseList(sem_id) {
  $.ajax({
    url: "course_list_dropdown.php",
    method:"POST",
    data:{
      sem_id:sem_id
    },
    datatype:"text",
    success:function(data){
      $('#course_id').html(data);
    }

  });
}

//get courses list
function getParentCourses() {

    $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {parent: "parent"},
        success: function (data) {
            $('#parent_dropdown').html(data)
        }
    });
}
//getParentCourses();






///js function



function take_course(id) {


     var course1= $(".course_offer_id"+id).val();
      //var c= $('.course_offer_id+id:checked').serialize();
    
     

//var saveB=saveBT+id;
    
    //alert(saveBT);
    //alert(s_id);
    //alert(attend);
    //alert(ct);
    //alert(quiz);
    //alert(assignment);
    //alert(presentation);
    //alert(final_exam);
    

    alert(course1);
    //alert(c);
    

    $.ajax({
    method:'POST',
    url:'check_course_records.php',
    data:{
    row_course:course1
    },
    success:function(response) {
      if(response=="success") {
          alert("You are eligible");
          $(".course_offer_id"+id).prop('checked', true);
          console.log(response);
        //$(msg).hide(3000);
      } else {
        alert("You are not eligible");
        $(".course_offer_id"+id).prop('checked', false);
        console.log(response);
      }
    }
  });

}


function getAllCourseList( val)
{
  let group = $('#exam_program').val();
if(group == null){
  group = '';
}
 
  $.ajax({
    method:'POST',
    url:'find_specefic_course.php',
    data:{
    classId: val,
    group: group
    },
    success:function(response) {
      $('#select_course_id').html(response);
      console.log(response);
    }
  });
}

function getAllCourseByProgram(group) {
  let classId = $('#exam_course').val();
  if(classId == null){
    classId = '';
  }
   
    $.ajax({
      method:'POST',
      url:'find_specefic_course.php',
      data:{
      classId: classId,
      group: group
      },
      success:function(response) {
        $('#select_course_id').html(response);
        console.log(response);
      }
    });
}


function getSectionList(val) {
  let classId = $('#select_class_id').val();

  $.ajax({
    method:'POST',
    url:'find_specific_section.php',
    data:{
    classId: classId,
    course : val
    },
    success:function(response) {
      $('#select_section_id').html(response);
     
    }
  });

}

function clearFormSession() {
  $.ajax({
    method:'POST',
    url:'claer_result_form_session.php',
    data:{
    },
    success:function(response) {
     
    }
  });
}


function getAllResultOfAllStudets(s_id, rowIndex) { 
  $.ajax({
    method:'POST',
    url:'find_all_result_data.php',
    data:{
      semester: $('#select_section_sem').val(),
      course: $('#select_course_id').val(),
      s_id : s_id
    },
    success:function(response) {
      let cnt = 0;
        for(let i = 0;i<response.length;i++) {
          if(response[i] == '{') {cnt = i+1; break;}
        }


      response = response.substring(cnt, response.length-1);


        var arr = [];
        var finalArr = [];
        var p = response.split(',');
        p.forEach((data)=> {
           let polash = data.split(':');
           polash.forEach((dt) => {
              arr.push(dt);
           });
        });

        for(let j = 0;j< arr.length; j = j + 2) {
            let first,last;

            for( let k = 0; k< arr[j].length; k ++){
              if(first == undefined)
              {
                if(arr[j][k]== '\"')
                {
                  first = k;
                }
              }
              else
              {
                if(arr[j][k]== '\"')
                {
                  last = k;
                  break;
                }
              }
            }


          let index = arr[j].substring(first+1,last);

          first = undefined;
          last = undefined;
          for( let k = 0; k< arr[j+1].length; k ++){
            if(first == undefined)
            {
              if(arr[j+1][k]== '\"')
              {
                first = k;
              }
            }
            else
            {
              if(arr[j+1][k]== '\"')
              {
                last = k;
                break;
              }
            }
          }
          let data = arr[j+1].substring(first+1,last);
          if(data == 'null')
          {
            finalArr[index] = '';
          }
          else
          {
            finalArr[index] = data;
          }


        }

        console.log(finalArr);
        
        $('#attend'+rowIndex).val(finalArr['attend']);
        $('#ct'+rowIndex).val(finalArr['ct']);
        $('#quiz'+rowIndex).val(finalArr['quize']);
        $('#assignment'+rowIndex).val(finalArr['assignment']);
        $('#presentation'+rowIndex).val(finalArr['presentation']);
        $('#final_exam'+rowIndex).val(finalArr['final_exam']);
        $('#total'+rowIndex).val(finalArr['total']);
        $('#gpa'+rowIndex).val(finalArr['gp']);
        $('#grade'+rowIndex).val(finalArr['lg']);
        

    }
  });
}


$(document).ready(() => {


  //getAllResultOfAllStudets(s_id)




 let classId = $('#select_class_id').val();
 let course = $('#select_course_id').val();
 getAllCourseList(classId);
 getSectionList(course);
 let s_idList = $("input[id^='s_id']");

 for(let i = 1; i<=s_idList.length; i++)
 {
   getAllResultOfAllStudets($('#s_id'+i).val(),i);
 }

 clearFormSession();

});



// salary panel start

$('#students_salary_submit').click((e) => {
  let cls = $('#exam_class').val();
  let session = $('#exam_session').val();
  let pgrm = $('#exam_program').val();
  let month = $('#month').val();
  let year = $('#year').val();

if(!(cls && session && pgrm && month && year))
{
  alert('Enter data correctly');
  return;
}

  $.ajax({
      url: "salary_student_ajax.php",
      method:"POST",
      datatype:"text",
      data:{
       
       cls:cls,
       session:session,
       pgrm:pgrm,

        },
      success:function(data){
        
        let responseData = phpPrinterObjectToJson(data);
        let responsestr = "";


        for(let i=0;1; i++)
        {
          if(responseData[0][i] == undefined) break;
          responsestr = responsestr + '<tr id="s_id_'+responseData[0][i]+'"><td>'+responseData[0][i]+'</td><td id="salar_paid_'+responseData[0][i]+'"><input type="checkbox"disabled id="cb_paid_'+responseData[0][i]+'"></td><td><input type="number" id ="amount_'+responseData[0][i]+'"/></td><td> <button class="btn btn-success" id="save_salary_'+responseData[0][i]+'" onclick = "saveSalary('+responseData[0][i]+')">Save</button></td></tr>';
        }

        $('#student_salary_payment').html(responsestr);


        updateSalaryTable();
      }
  
    });


});


function saveSalary(data)
{
  let month = $('#month').val();
  let year = $('#year').val();
  let s_id = data;
  let amount = $('#amount_'+ s_id).val();
  let link = window.location.href.indexOf('stuff');
  let type = $('#stuff_type').val();
  $.ajax({
    url: "save_salary_ajax.php",
    method:"POST",
    datatype:"text",
    data:{
     
      month : month,
      year : year,
      s_id  :s_id,
      amount : amount,
      stuff: link,
      type : type,
      submittingMode: submittingMode

      },
    success:function(data){
      
     alert(data);
    }

  });


}

function updateSalaryTable()
{


  let cls = $('#exam_class').val();
  let session = $('#exam_session').val();
  let pgrm = $('#exam_program').val();
  let year = $("#year").val();
  let month = $("#month").val();

  $.ajax({
    url: "salary_of_month.php",
    method:"POST",
    datatype:"text",
    data:{
     
      month : month,
      year : year,

      },
    success:function(data){
      
      let dt = phpPrinterObjectToJson(data);
      dt.forEach( d => {
       
        $('#cb_paid_'+ d.en_id).prop('checked', true);
        $('#amount_'+ d.en_id).val(d.amount);


      });
    }

  });

}

var submittingMode = false;

$('#teacher_salary_submit,#update_mode').click(()  => {

  $('#gl_update').show();
  $('#gl_create').hide();


  let month = $('#month').val();
  let year = $('#year').val();
  let type = $('#stuff_type').val();

if(!( month && year))
{
  alert('Enter data correctly');
  return;
}
submittingMode = false;

  $.ajax({
      url: "salary_teacher_ajax.php",
      method:"POST",
      datatype:"text",
      data:{
      
        type: type
        },
      success:function(data){
        
        let responseData = phpPrinterObjectToJson(data);
        let responsestr ="";

        responseData.forEach((dt) => {
          if(dt.status == "1")
          {
            responsestr = responsestr + '<tr id="t_id_'+dt.id+'"><td>'+dt.username+'</td><td><input type="number" id ="amount_'+dt.id+'"/></td><td> <button class="btn btn-success" id="save_salary_'+dt.id+'" onclick = "saveSalary('+dt.id+')">Save</button></td></tr>';
    
          }
          else{
            // responsestr = responsestr + '<tr id="t_id_'+dt.id+'"><td>'+dt.username+'</td><td><input type="number" disabled id ="amount_'+dt.id+'"/></td><td> </td></tr>';
    
          }
          
        });




    
        $('#student_salary_payment').html(responsestr);
        updateTeacherSalaryTable();



      }
  
    });


});




function updateTeacherSalaryTable()
{


  let cls = $('#exam_class').val();
  let session = $('#exam_session').val();
  let pgrm = $('#exam_program').val();
  let year = $("#year").val();
  let month = $("#month").val();
  let type = $('#stuff_type').val();

  $.ajax({
    url: "salary_of_month_teacher.php",
    method:"POST",
    datatype:"text",
    data:{
     
      month : month,
      year : year,
      type:type

      },
    success:function(data){
      
      let dt = phpPrinterObjectToJson(data);
      dt.forEach( d => {
       
        $('#amount_'+ d.en_id).val(d.amount);


      });
    }

  });

}

function getAllCourseListAdmin(){

  let group = $('#exam_program').val();
  let cls = $('#exam_class').val();

 
  $.ajax({
    method:'POST',
    url:'find_specefic_course.php',
    data:{
    classId: cls,
    group: group
    },
    success:function(response) {
      $('#select_course_id').html(response);
      console.log(response);
    }
  });

}

function changeMonthSalary(){
  $('#student_salary_payment').empty();
}

$('#session_semester_ch').change(() => {

  let session = $('#session_semester_ch').val(); 
  $.ajax({
    method:'POST',
    url:'chanage_semester_ajax.php',
    data:{
      session: session,
    },
    success:function(data) {
   
let response = phpPrinterObjectToJson(data)[0];

let semesterOprion = '';

if(response.active_semester == 1) { 

  semesterOprion = semesterOprion + '<option value = "1" Selected>1st year First Semester</option>';
  semesterOprion = semesterOprion + '<option value = "2" >1st year 2nd Semester</option>';
}
else if (response.active_semester == 2){
  semesterOprion = semesterOprion + '<option value = "1" disabled>1st year First Semester</option>';
  semesterOprion = semesterOprion + '<option value = "2" Selected>1st year 2nd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "3">1st year Final Semester</option>';

}
else if (response.active_semester == 3){
  semesterOprion = semesterOprion + '<option value = "1" disabled>First Semester</option>';
  semesterOprion = semesterOprion + '<option value = "2" disabled>2nd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "3" Selected>1st year Final Semester</option>';
  semesterOprion = semesterOprion + '<option value = "4" >2nd year 1st Semester</option>';
  
}
else if (response.active_semester == 4){
  semesterOprion = semesterOprion + '<option value = "1" disabled>1st year First Semester</option>';
  semesterOprion = semesterOprion + '<option value = "2" disabled>1st year 2nd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "3" disabled>1st year Final Semester</option>';
  semesterOprion = semesterOprion + '<option value = "4" Selected>2nd year 1st Semester</option>';
  semesterOprion = semesterOprion + '<option value = "5" >2nd year 2nd Semester </option>';
  
}
else if (response.active_semester == 5){
  semesterOprion = semesterOprion + '<option value = "1" disabled>First Semester</option>';
  semesterOprion = semesterOprion + '<option value = "2" disabled>2nd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "3" disabled>3rd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "4"  disabled>2nd year 1st Semester</option>';
  semesterOprion = semesterOprion + '<option value = "5" Selected >2nd year 2nd Semester </option>';
  semesterOprion = semesterOprion + '<option value = "6" >2nd year Final Semester </option>';
}
else if (response.active_semester == 6){
  semesterOprion = semesterOprion + '<option value = "1" disabled>First Semester</option>';
  semesterOprion = semesterOprion + '<option value = "2" disabled>2nd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "3" disabled>3rd Semester</option>';
  semesterOprion = semesterOprion + '<option value = "4"disabled >2nd year 1st Semester</option>';
  semesterOprion = semesterOprion + '<option value = "5"disabled >2nd year 2nd Semester </option>';
  semesterOprion = semesterOprion + '<option value = "6" Selected>2nd year Final Semester </option>';
  semesterOprion = semesterOprion + '<option value = "7" >Close Session </option>';
}



$('#actuve_semester').html(semesterOprion);

    }
  });
});

$('#change_semseter_submit').click(()=> {

let session = $('#session_semester_ch').val();
let newSeme = $('#actuve_semester').val();
if(!(session && newSeme))
{
return;
}

$.ajax({
  method:'POST',
  url:'update_semester_ajax.php',
  data:{
    session: session,
    newseme:newSeme
  },
  success:function(data) {
    if(data == 'success')
    {
      alert('Semester Updated Successfully');
    }
    else if(data ='success_year_up')
    {
      alert('Semester and year Migration successfully Updated Successfully');
    }
  }
});

});

$('#rm_search, #rm_capasity').keyup((e)=> {

 
  if(e.target.id == 'rm_search')
  {
    let dataVal = $('#'+e.target.id).val();
      let allRm = $("td[id^='rm_name_']");
      if(allRm.length == 0) return;

      
      for(let i = 0;i<allRm.length;i++){
        let rowIndex = allRm[i].id.substring('rm_name_'.length);
        let data = $('#'+allRm[i].id).text().search(dataVal);
        if(data != -1)
        {
          $('#rm_row'+rowIndex).show();
        }
        else{
          $('#rm_row'+rowIndex).hide();
        }

      }
  }
  else
  {
    let dataVal = $('#rm_capasity').val();

    let allRm = $("td[id^='rm_capasity_']");
    if(allRm.length == 0) return;

    
    for(let i = 0;i<allRm.length;i++){
      let rowIndex = allRm[i].id.substring('rm_capasity_'.length);
      let data = $('#'+allRm[i].id).text().search(dataVal);
      if(data != -1)
      {
        $('#rm_row'+rowIndex).show();
      }
      else{
        $('#rm_row'+rowIndex).hide();
      }

    }
  }

});


$('#create_mode').click(()=> {
  $('#gl_update').hide();
  $('#gl_create').show();
  submittingMode = true;
  let a = $('input[id ^="amount_"]');
  for(let i= 0;i<a.length;i++)
  {
    $('#'+a[i].id).val('');
  }

});

$('#other_salary').click((e)=>{
 let fromDate = $('#from_date').val();
 let toDate = $('#to_date').val();

if(fromDate == '' || toDate == '')
{
  alert('Enter Data Correctly');
  return;
}

$.ajax({
  method:'POST',
  url:'get_all_other_salary_ajax.php',
  data:{
    fromDate: fromDate,
    toDate:toDate
  },
  success:function(data) {
   let processedData = phpPrinterObjectToJson(data);
   let renderHtml = '';
   for(let i = 0; i<processedData.length; i++){
     renderHtml = renderHtml +'<tr><td>'+ processedData[i].date_of_payment +'</td><td>'+ processedData[i].description +'</td><td>'+ processedData[i].amount +'</td><td><a href="edit_other_cost.php?id='+processedData[i].id+'">Edit</a></td></tr>'; 
   }

   $('#other_salary_payment').html(renderHtml);
  }
});



});