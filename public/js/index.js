function acivateHospital(countySel){
    countySelVal = $(countySel).val();
    if (countySelVal != '') {
        $.ajax({url: "feedback/fillHospital", data: {county: countySelVal}, success: function(result){
             var hospitalObj = jQuery.parseJSON(result);
             $.each(hospitalObj, function (i, hospital) {
                $('#hospital').append($('<option>', { 
                    value: hospital.hospital_id,
                    text : hospital.hospital 
                }));
            });
            $('#hospital').prop('disabled', false);
        }});
    } else {
        $('#hospital').prop('disabled', true);
        $('#hospital option').each(function() {
            if ($(this).val() != '' ) {
                $(this).remove();
            }
        });
        
        $('#station').prop('disabled', true);
        $('#station option').each(function() {
            if ($(this).val() != '' ) {
                $(this).remove();
            }
        });
    }
}

function acivateStation(hospitalSel){
    hospitalSelVal = $(hospitalSel).val();
    if (hospitalSelVal != '') {
        $.ajax({url: "feedback/fillStation", data: {hospital: hospitalSelVal}, success: function(result){
             var stationObj = jQuery.parseJSON(result);
             $.each(stationObj, function (i, station) {
                $('#station').append($('<option>', { 
                    value: station.station_id,
                    text : station.station 
                }));
            });
            $('#station').prop('disabled', false);
        }});
    } else {
        $('#station').prop('disabled', true);
        $('#station option').each(function() {
            if ($(this).val() != '' ) {
                $(this).remove();
            }
        });
    }
}

function startQuestionnaire(station) {
    stationVal = $(station).val();
    questionnaireVal = $('#questId').val();
    if (stationVal != '') {        
        $.ajax({url: "feedback/setStation", data: {station: stationVal, questionnaire: questionnaireVal}, success: function(result){
             $('#currentStep').val('start');
             $('#feedbackForm').submit();
        }});
    }
    
}

function goToNextPage(step) {
    if (step === 'start') {
        $('#currentStep').val('selectStation');
    }  else if (step === 'finalize') {
        $('#currentStep').val('thankyou');
    } 
        
    $('#feedbackForm').submit();
}