$(document).ready(() => {
    calculateStudentsResult();
   
});

function calculateStudentsResult() {
    $.ajax({
        method:'POST',
        url:'individual_result_ajax.php',
        data:{
        
        },
        success:function(data) {
          if(data )
          {
            let process_data = phpPrinterObjectToJson(data);
            console.log(process_data);
            calculateNumberOfCourse(process_data);
            let finalData = {};
            process_data.forEach(dt => {
              let couse_id = dt.course;
              let semester = dt.samester;
              let originalData = dt.result.substr(1,dt.result.length-3).split('|').forEach((ddd) => {
               let splitedData = ddd.split(':');
               let dt1 = '',dt2='';

               for(let i = 0;i<splitedData[0].length;i++) {
                 if(splitedData[0][i]!='"'){
                   dt1= dt1 + splitedData[0][i];
                 }
               }

               for(let i = 0;i<splitedData[1].length;i++) {
                if(splitedData[1][i]!='"'){
                  dt2= dt2 + splitedData[1][i];
                }
              }
           

               finalData[dt1] = dt2;
              });
              let finalWritten = finalData._fin_written;
              let finalMCQ = finalData.fin_mcq;
              let finalPractical = finalData._fin_practical;
              if(semester == 3 || semester == 6){
                $("#s_wrt_"+semester+"_"+couse_id).text(finalMCQ);
                $("#s_mcq_"+semester+"_"+couse_id).text(finalPractical);
              }
              else
              {
                $("#s_wrt_"+semester+"_"+couse_id).text(finalWritten);
              }
             
              if(semester != 3 && semester != 6){
                $("#w_mcq_"+semester+"_"+couse_id).text(finalMCQ);
              }
             
              let ct_mark = 0;
              if(finalData.qf)
              {
                ct_mark = ct_mark + Number(finalData.qf);
              }

              if(finalData.ctf)
              {
                ct_mark = ct_mark + Number(finalData.ctf);
              }
              
              if(finalData.mf)
              {
                ct_mark = ct_mark + Number(finalData.mf);
              }
              if(finalData.atten)
              {
                ct_mark = ct_mark + Number(finalData.atten);
              }
              $("#mt"+semester+"_"+couse_id).text(ct_mark);

              if(semester == 3 || semester == 6)
              {
                $("#mt"+semester+"_"+couse_id).text(finalWritten);
                $('#s'+semester+'_total_'+couse_id).text(Number(finalPractical)+ Number(finalMCQ) + Number(finalWritten));
                $('#gpa_s'+semester+'_'+couse_id).text(calculatGPA(Number(finalPractical)+ Number(finalMCQ) + Number(finalWritten)));
              }
              else {
                $('#s'+semester+'_total_'+couse_id).text(Number(ct_mark)+ Number(finalMCQ) + Number(finalWritten));
                $('#gpa_s'+semester+'_'+couse_id).text(calculatGPA(Number(ct_mark)+ Number(finalMCQ) + Number(finalWritten)));
          
              }
             
            });
          }
        }
      });
      
    } 
    
    
  function calculateNumberOfCourse(data) {
      let course = [];

      data.forEach((dt) => {
        let flag = false;
        for(let i = 0;i<course.length;i++) {
          if(course[i] == dt.course)
          {
            flag = true;
            break;
          }
        }
        if(!flag)
        {
          course.push(dt.course);
          let dtSrt = '';
          if(dt.samester <= 3){
          dtSrt = dtSrt + '<tr id ="data_row_'+dt.course+'"><td id ="course_Name'+dt.course+'" class="table-bordered">qwe </td>';
          dtSrt = dtSrt + '<td id ="mt1_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="s_wrt_1_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="w_mcq_1_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="s1_total_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="gpa_s1_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="mt2_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="s_wrt_2_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="w_mcq_2_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="s2_total_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="gpa_s2_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="mt3_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="s_wrt_3_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="s_mcq_3_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td> </td>';
          dtSrt = dtSrt + '<td> </td>';
          dtSrt = dtSrt + '<td id ="s3_total_'+dt.course+'"  class="table-bordered"> </td>';
          dtSrt = dtSrt + '<td id ="gpa_s3_'+dt.course+'"  class="table-bordered"> </td></tr>';
          } else {

            dtSrt = dtSrt + '<tr id ="data_row_'+dt.course+'"><td id ="course_Name'+dt.course+'" class="table-bordered">qwe </td>';
            dtSrt = dtSrt + '<td id ="mt4_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="s_wrt_4_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="w_mcq_4_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="s4_total_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="gpa_s4_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="mt5_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="s_wrt_5_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="w_mcq_5_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="s5_total_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="gpa_s5_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="mt6_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="s_wrt_6_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="s_mcq_6_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td> </td>';
            dtSrt = dtSrt + '<td> </td>';
            dtSrt = dtSrt + '<td id ="s6_total_'+dt.course+'"  class="table-bordered"> </td>';
            dtSrt = dtSrt + '<td id ="gpa_s6_'+dt.course+'"  class="table-bordered"> </td></tr>';


          }
          if(dt.samester<=3)
          {
            $('#individual_student').append(dtSrt);
          }
          else
          {
            $('#individual_student_2').append(dtSrt);
          }

          if( $('#individual_student tr').length == 0)
          {
            $('#individual_student').append('<tr><td colspan="19">No data available</td></tr>');
          }
         
         
          courseMapper(dt.course);
        }
      
      });
     
  }


  function courseMapper(course_code)
  {
    $.ajax({
      method:'POST',
      url:'course_code_mapper_ajax.php',
      data:{
        course_code: course_code
      },
      success:function(data) {
        if(data )
        {
          let process_data = phpPrinterObjectToJson(data);
          if(data)
          {
            $('#course_Name'+course_code).text(process_data[0].course_title);
          }
          else
          {
            $('#course_'+course_code).text('Bangla');
          }
        
        }
      }
    });
  }

  function showFirstYearResult() {
$('#1stYearResult').show();
$('#2ndYearResult').hide();

  }

  function showSecondYearResult() {
    if( $('#individual_student_2 tr').length == 0)
    {
      $('#individual_student_2').append('<tr><td colspan="19">No data available</td></tr>');
    }
    $('#1stYearResult').hide();
    $('#2ndYearResult').show();

  }


  function calculatGPA(mark)
  {
    if(mark>=80)
    {
      return 5.00;
    }
    else if(mark>=70 && mark< 80)
    {
        return 4.00 + (mark-70)*.1;
    }
    else if(mark>=60 && mark< 70)
    {
      return 3.50 + (mark-60)*.05;
    }
    else if(mark>=50 && mark< 60)
    {
      return 3.00 + (mark-50)*.05;
    }
    else if(mark>=40 && mark< 50)
    {
      return 2.00 + (mark-40)*.1;
    }
    else if(mark>=33 && mark< 40)
    {
      return 2.00 + (mark-30)*.1;
    }
    else
    {
      return 0.00;
    }
  }


  $('#daily_atten').click(()=>{
     
  });

  $('#monthly_atten').click(() => {
  
  });

  function attenValueChange(dt)
  {
    if(dt == 1 )
    {
      $('#date_atte_allo').show();
      $('#daily_check_icon').show();
      $('#daily_month_icon').hide();

      $('#monthly_panel').hide();
      $('#daily_panel').show();

    
    }
    else
    {
      $('#date_atte_allo').hide();
      $('#daily_check_icon').hide();
      $('#daily_month_icon').show();
      $('#monthly_panel').show();
      $('#daily_panel').show();
    }
  }

  function submit_attedance(){

let year = $('#year_attn').val();
let month = $('#month_att').val();
let day = $('#date').val();

if($('#daily_month_icon').css('display') == 'none'){
  if(day == ''){
    alert('Enter Data Correctly');
    return;
  }
}
else
{
  if(year == '' || month == '')
  {
    alert('Enter data Correcly');
    return;
  }

}



    $.ajax({
      method:'POST',
      url:'get_attendance_data_ajax.php',
      data:{
        year:year,
        month:month,
        day:day
      },
      success:function(data) {
      data = phpPrinterObjectToJson(data);

      let renderHtml = '';

    if($('#daily_month_icon').css('display') == 'none'){
        for(let i = 0; i<data.length;i++)
        {
          if(i == 0)
          {
            renderHtml = renderHtml + '<tr><td>'+new Date(data[i].time).toLocaleDateString()+'</td><td>'+ new Date(data[i].time).toLocaleTimeString()+ '</td>';
          }
          if(i == 0 && data.length == 1)
          {
            renderHtml = renderHtml + '<td>Log Out Error</td></tr>';
          }
          if(data.length > 1 && i == data.length-1)
          {
            renderHtml = renderHtml + '<td>'+new Date(data[i].time).toLocaleTimeString()+'</td></tr>';
          }
        }
        $('#single_date_att').html(renderHtml);



        }
        else{
              let dt = [];
              for(let i = 0;i<data.length;i++)
              {
                let da_te = (new Date(data[i].time)).toLocaleDateString();
                let time = (new Date(data[i].time)).toLocaleTimeString();
                let pp = {
                  dte: da_te,
                  time : time
                };
              dt.push(pp);
              }
              let duplicateDate = [];
              let finalDateTimeData = [];
              for(let j = 0;j<dt.length; j++)
              {
                  let dt_str = dt[j].dte;
                  if(duplicateDate.indexOf(dt[j].dte) == -1)
                  {
                    finalDateTimeData[dt[j].dte] = {bgn:dt[j].time,ex: null};
                    duplicateDate.push(dt[j].dte);
                  }
                  else
                  {
                    finalDateTimeData[dt[j].dte].ex = dt[j].time;
                  }
              }
              console.log(finalDateTimeData);
              for(let i = 0; i<duplicateDate.length;i++)
              {
              
                  renderHtml = renderHtml + '<tr><td>'+duplicateDate[i]+'</td><td>'+finalDateTimeData[duplicateDate[i]].bgn+'</td><td>'+finalDateTimeData[duplicateDate[i]].ex+'</td></tr>';
                
              }
              $('#single_date_att').html(renderHtml);
        }
    }
    });
    
  }