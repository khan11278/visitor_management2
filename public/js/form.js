// function display(){
//     alert("hello I am Roshan Khan");
//     console.log(11);
// }
// $(document).ready(function(){
//     $("#depart-dd").change(function(){
//     // alert("The text has been changed.");
//     // console.log(11);
//     $department=$(this).val();

//     $.ajax({
//         type:'POST',
//         // url:url('visitor_meet'),
//         url: "{{url('visitor_meet')}}",
//         dataType:"json",
//         data:$department,
//         data: {
//             country:$department,
//             _token: '{{csrf_token()}}'
//         },
//         success: function (result) {
//         //    $("#msg").html(data.msg);
//         console.log(result.dept);
//         }
//      });
//   });
// });
// $(function(){
//     $('#depart-dd').on('change', function () {
//         // var dept = $(this).val();
//         // $("#visitor_meet").html('');
//         alert("The paragraph was clicked.");
//         // $.ajax({
//         //     url: "{{url('visitor_meet')}}",
//         //     type: "POST",
//         //     data: {
//         //         deptName1: dept,
//         //         _token: '{{csrf_token()}}'
//         //     },
//         //     dataType: 'json',
//         //     success: function (result) {
//         //         // $('#visitor_meet').html('<option value="">Select State</option>');
//         //         $.each(result.dept, function (key, value) {
//         //             // $("#visitor_dept").append('<option value="' + value
//         //             //     .id + '">' + value.name + '</option>');
//         //             $("#visitor_dept").append('<option value="' + value
//         //                 .contact_person + '">' + value.contact_person + '</option>');
//         //         });
//         //         // console.log("hello roshan");
//         //         // $('#city-dd').html('<option value="">Select City</option>');
//         //     }
//         // });
//     })
//     });

// var id = $(this).val();

//        $.ajax({
//             url: baseUrl+"/get-cities/",
//             method: "POST",
//             data:{id:id},
//             success:function(data){
//                  $('#show_cities').html(data);
//            }

//        });
