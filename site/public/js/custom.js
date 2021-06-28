// Owl Carousel Start..................

$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:80,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});


// Owl Carousel End..................

// contact Send

$('#contactSendBtnId').click(function(){
    var contactName=$('#contactNameId').val();
    var contactMobile=$('#contactMobileId').val();
    var contatEmail=$('#contactEmailId').val();
    var contactMsg=$('#contactMsgId').val();
    SendContact(contactName,contactMobile,contatEmail,contactMsg);
});
function SendContact(contact_name,contact_mobile,contact_email,contact_message){
    if(contact_name.length==0){
        $('#contactSendBtnId').html('Write Your Name');
        setTimeout(function(){
            $('#contactSendBtnId').html('Send');
        },2000)
    }
    else if(contact_mobile.length==0){
        $('#contactSendBtnId').html('Write Your Mobile No')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send');
        },2000)
    }
    else if(contact_email.length==0){
        $('#contactSendBtnId').html('Write Your Email')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send');
        },2000) 
    }
    else if(contact_message.length==0){
        $('#contactSendBtnId').html('Write Your Message')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send');
        },2000)  
    }else{
        $('#contactSendBtnId').html('Sending...');
        axios.post('/contactSend',{
            contact_name:contact_name,
            contact_mobile:contact_mobile,
            contact_email:contact_email,
            contact_message:contact_message
        })
        .then(function(response){
        if(response.status==200){
            if(response.data==1){
                $('#contactSendBtnId').html('Your Request is succesfully sent')
                setTimeout(function(){
                    $('#contactSendBtnId').html('Send');
                   
                    $('#conForm').trigger("reset");
                },2000)
               
            }
            else{
                $('#contactSendBtnId').html('Your Request is cancelled.Try again Later')
                setTimeout(function(){
                   
                },2000)  
                
            }
           
        }
        else{
            $('#contactSendBtnId').html('Your Request is cancelled.Try again Later')
            setTimeout(function(){
                $('#contactSendBtnId').html('Send');
            },2000)  
        }


        }).catch(function(){
            $('#contactSendBtnId').html('Try Again')
            setTimeout(function(){
                $('#contactSendBtnId').html('Send');
            },2000)  
    
        })
    }


}





