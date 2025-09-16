// next prev
var divs = $('.show-section section');
// alert(divs);
var now = 0; // currently shown div
divs.hide().first().show(); // hide all divs except first
var questionCount = $('#questionCount').val();
//show active step
function showActiveStep()
{
     // Remove show class from all steps
     $(".step-single").removeClass('show');
    
     // Add active and show classes to the current step
     if (now < questionCount && now >= 0) {
         $(".step-single").eq(now).addClass('active show');
     }
    
}


function next()
{
    divs.eq(now).hide();
    now = (now + 1 < questionCount) ? now + 1 : 0;
    divs.eq(now).show(); // show next
    console.log(now);
    // alert('1');
    showActiveStep();
}
$(".prev").on('click', function()
{

    $('.radio-field').addClass('bounce-left');
    $('.radio-field').removeClass('bounce-right');
    $(".step-single.show").removeClass('active')
    divs.eq(now).hide();
    now = (now > 0) ? now - 1 : questionCount - 1;
    divs.eq(now).show(); // show previous
    console.log(now);
    // alert('2');
    showActiveStep();

})
// Next button click handler
$(".next").on('click', function() {
    next();
});
// timer


// Convert questionCount to total seconds (questionCount * 60)
var totalSeconds = questionCount * 60;

var interval = setInterval(function() {
    if(totalSeconds <= 0) {
        clearInterval(interval);
        document.getElementById("countdown-timer").innerHTML = "00:00";
    } else {
        totalSeconds = totalSeconds - 1;
        
        // Calculate minutes and seconds
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;
        
        // Format minutes and seconds to always have two digits
        var formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
        var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;
        
        // Display in format MM:SS
        document.getElementById("countdown-timer").innerHTML = formattedMinutes + ":" + formattedSeconds;
    }
}, 1000);

// quiz validation
var checkedradio = false;

function radiovalidate(stepnumber)
{
    var checkradio = $("#step"+stepnumber+" input").map(function()
    {
    if($(this).is(':checked'))
    {
        return true;
    }
    else
    {
        return false;
    }
    }).get();

    checkedradio = checkradio.some(Boolean);
}




// form validation
